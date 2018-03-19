<?php
    require_once("../../db/Database.php");
    require_once("../../interfaces/ISchedule.php");
    require_once("../../models/Helper.php");
    require_once("../../models/Lesson.php");
    require '../../vendor/autoload.php';
    use Carbon\Carbon;

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
            $this->start_time = new Carbon($start_time, 'America/Mexico_City');
            $this->end_time = new Carbon($end_time, 'America/Mexico_City');
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
                        $temp->setAttributes($result->id, $result->start_time->toDateTimeString(), $result->end_time->toDateTimeString(), $result->class_id);
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

        public static function copyDate($date, $new){
            $date->year = $new->year;
            $date->month = $new->month;
            $date->day = $new->day;
            return $date;
        }
        
        /*              Class methods               */
    	public function save() {
            $data = (object) [
                'result' => false,
                'error' => null
            ];
            
    		try{
                //Inicia la transacción
                $this->con->beginTransaction();
                $this->con->exec('LOCK TABLE schedules IN EXCLUSIVE MODE');
                $this->con->exec('LOCK TABLE trainers IN EXCLUSIVE MODE');
                $trainer = $this->lesson()->trainer();

                $overlap = false;
                foreach($trainer->schedules() as $schedule){
                    if($this->start_time->dayOfWeek == $schedule->start_time->dayOfWeek || $this->end_time->dayOfWeek == $schedule->end_time->dayOfWeek){
                        $schedule->start_time = Schedule::copyDate($schedule->start_time, $this->start_time);
                        $schedule->end_time = Schedule::copyDate($schedule->end_time, $this->end_time);

                        if($schedule->start_time->between($this->start_time, $this->end_time) || $schedule->end_time->between($this->start_time, $this->end_time)){
                            $overlap = true;
                            break;
                        }
                    }
                }

                if($overlap){
                    $data->error = "The schedule overlaps with another lesson given by the trainer.";
                    return $data;
                }

    			$query = $this->con->prepare('INSERT INTO schedules (start_time, end_time, class_id) values (?,?,?)');
                $query->bindParam(1, $this->start_time->toDateTimeString(), PDO::PARAM_STR);
                $query->bindParam(2, $this->end_time->toDateTimeString(), PDO::PARAM_STR);
                $query->bindParam(3, $this->lesson_id, PDO::PARAM_INT);
                $data->result = $query->execute();

                if(!$data->result){
                    $data->error = $query->errorInfo();
                    $data->error = $data->error[2];
                    $this->con->rollback();
                }
                else{
                    $this->con->commit();
                }
                $this->con->close();
    		}
            catch(PDOException $e){
    	        $data->error = $e->getMessage();
            }
            
            return $data;
        }
        
        public function delete(){
            $data = (object) [
                'result' => false,
                'error' => null
            ];
            
            try{
                $query = $this->con->prepare('DELETE FROM schedules WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $data->result = $query->execute();
                $this->con->close();

                if(!$data->result){
                    $data->error = $query->errorInfo();
                    $data->error = $data->error[2];
                }
            }
            catch(PDOException $e){
    	        $data->error = $e->getMessage();
            }

            return $data;
        }

        /*              Relations               */
        public function lesson(){
            return Lesson::get($this->lesson_id);
        }
    }
?>