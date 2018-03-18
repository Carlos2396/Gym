<?php
    require_once("../../db/Database.php");
    require_once("../../interfaces/ISchedule.php");
    require_once("../../models/Helper.php");
    require_once("../../models/Lesson.php");

    class Schedule implements ISchedule {
        /*              Attributes               */
        private $con;
        public $id;
        public $start_time;
        public $end_time;
        public $lesson_id;
        
        /*              Static init and constructor               */
    	public function __construct(){
            $this->con = new Database; 		
    	}

        /*              Setters               */
        public function setAttributes($id, $start_time, $end_time, $lesson_id){
            $this->id = $id;
            $this->start_time = $start_time;
            $this->end_time = $end_time;
            $this->lesson_id = $lesson_id;
        }

    	/*              Static methods               */
    	public static function all(){
    		try{
                $con = new Database;
                $query = $con->prepare('SELECT * FROM schedules');
                $query->execute();
                $con->close();
                
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                $schedules = array();
                if(!empty($results)){
                    foreach($results as $result){
                        $temp = new Schedule;
                        $temp->setAttributes($result->id, $result->start_time, $result->end_time, $result->class_id);
                        array_push($schedules, $temp);
                    }
                }
                
                return $schedules;
            }
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
        }
        
        public static function get($schedule_id){
    		try{
                if(is_int($schedule_id)){
                    $con = new Database;
                    $query = $con->prepare('SELECT * FROM schedules WHERE id = ?');
                    $query->bindParam(1, $schedule_id, PDO::PARAM_INT);
                    $query->execute();
                    $con->close();

                    $result = $query->fetch(PDO::FETCH_OBJ);

                    if(!empty($result)){
                        $schedule = new Schedule;
                        $schedule->setAttributes($result->id, $result->start_time, $result->end_time, $result->class_id);
                        return $schedule;
                    }
                    else
                        return NULL;
                }
                else{
                    echo "Error, id is not an integer.";
                }
    		}
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
        }

        public static function checkSchedule($schedule_id) {
            $schedule = Schedule::get($schedule_id);
            if(!$schedule) {
                header("Location:" . Helper::baseurl() . "app/classes/index.php");
            }
        }
        
        /*              Class methods               */
    	public function save() {
    		try{
    			$query = $this->con->prepare('INSERT INTO schedules (start_time, end_time, class_id) values (?,?,?)');
                $query->bindParam(1, $this->start_time, PDO::PARAM_STR);
                $query->bindParam(2, $this->end_time, PDO::PARAM_INT);
                $query->bindParam(3, $this->lesson_id, PDO::PARAM_INT);
    			$query->execute();
    			$this->con->close();
    		}
            catch(PDOException $e) {
    	        echo  $e->getMessage();
    	    }
        }
        
        public function delete(){
            try{
                $query = $this->con->prepare('DELETE FROM schedules WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }

        public function lesson(){
            return Lesson::get($this->lesson_id);
        }
    }
?>