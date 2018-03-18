<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require_once("../../db/Database.php");
    require_once("../../interfaces/ILesson.php");
    require_once("../../models/Schedule.php");
    require_once("../../models/Helper.php");
    require_once("../../models/Trainer.php");

    class Lesson implements ILesson {
        /*              Attributes               */
        private $con;
        public $id;
        public $name;
        public $capacity;
        public $trainer_id;
        
        /*              Static init and constructor               */
    	public function __construct(){
            $this->con = new Database; 		
    	}

        /*              Setters               */
        public function setAttributes($id, $name, $capacity, $trainer_id){
            $this->id = $id;
            $this->name = $name;
            $this->capacity = $capacity;
            $this->trainer_id = $trainer_id;
        }

        /*              Static methods               */
    	public static function all(){
    		try{
                $con  = new Database;
                $query = $con->prepare('SELECT * FROM classes');
                $query->execute();
                $results =  $query->fetchAll(PDO::FETCH_OBJ);
                $con->close();

                $lessons = array();
                foreach($results as $result){
                    $temp = new Lesson();
                    $temp->setAttributes($result->id, $result->name, $result->capacity, $result->trainer_id);
                    array_push($lessons, $temp);
                }
                
                return $lessons;
    		}
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
        }
        
        public static function get($class_id){
    		try{
                if(is_int($class_id)){
                    $con  = new Database;
                    $query = $con->prepare('SELECT * FROM classes WHERE id = ?');
                    $query->bindParam(1, $class_id, PDO::PARAM_INT);
                    $query->execute();
        			$con->close();
                    
                    $result = $query->fetch(PDO::FETCH_OBJ);

                    if(!empty($result)){
                        $lesson = new Lesson();
                        $lesson->setAttributes($result->id, $result->name, $result->capacity, $result->trainer_id);
                        return $lesson;
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

        public static function checkLesson($lesson_id) {
            $lesson = Lesson::get($lesson_id);
            if(!$lesson) {
                header("Location:" . Helper::baseurl() . "app/classes/index.php");
            }
        }

        /*              Class methods               */
    	public function save() {
    		try{
    			$query = $this->con->prepare('INSERT INTO classes (name, capacity, trainer_id) values (?,?,?)');
                $query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->bindParam(2, $this->capacity, PDO::PARAM_INT);
                $query->bindParam(3, $this->trainer_id, PDO::PARAM_INT);
    			$query->execute();
    			$this->con->close();
    		}
            catch(PDOException $e) {
    	        echo  $e->getMessage();
    	    }
    	}

        public function update(){
    		try{
    			$query = $this->con->prepare('UPDATE classes SET name = ?, capacity = ?, trainer_id = ? WHERE id = ?');
    			$query->bindParam(1, $this->name, PDO::PARAM_STR);
                $query->bindParam(2, $this->capacity, PDO::PARAM_INT);
                $query->bindParam(3, $this->trainer_id, PDO::PARAM_INT);
                $query->bindParam(4, $this->id, PDO::PARAM_INT);
                $result = $query->execute();
    			$this->con->close();
    		}
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
    	}

        public function delete(){
            try{
                $query = $this->con->prepare('DELETE FROM classes WHERE id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->execute();
                $this->con->close();
            }
            catch(PDOException $e){
                echo  $e->getMessage();
            }
        }


        /*              Relations               */
        public function trainer(){
            return Trainer::get($this->trainer_id);
        }

        public function schedules(){
            try{
                $con = new Database;
                $query = $con->prepare('SELECT * FROM schedules WHERE class_id = ?');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
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
    }
?>