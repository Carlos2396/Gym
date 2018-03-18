<?php
    require_once("../../db/Database.php");
    require_once("../../interfaces/ITrainer.php");
    require_once("../../models/Helper.php");
    require_once("../../models/Branch.php");

    class Trainer implements ITrainer {
        /*              Attributes               */
        private $con;
        public $id;
        public $name;
        public $last_name;
        public $hired_at;
        public $branch_id;
        
        /*              Static init and constructor               */
    	public function __construct(){
            $this->con = new Database; 		
    	}

        /*              Setters               */
        public function setAttributes($id, $name, $last_name, $hired_at, $branch_id){
            $this->id = $id;
            $this->name = $name;
            $this->last_name = $last_name;
            $this->hired_at = $hired_at;
            $this->branch_id = $branch_id;
        }

    	/*              Static methods               */
    	public static function all(){
    		try{
                $con = new Database;
                $query = $con->prepare('SELECT * FROM trainers');
                $query->execute();
                $con->close();
                
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                $trainers = array();
                if(!empty($results)){
                    foreach($results as $result){
                        $temp = new Trainer;
                        $temp->setAttributes($result->id, $result->name, $result->last_name, $result->hired_at, $result->branch_id);
                        array_push($trainers, $temp);
                    }
                }
                
                return $trainers;
            }
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
        }
        
        public static function get($trainer_id){
    		try{
                if(is_int($trainer_id)){
                    $con = new Database;
                    $query = $con->prepare('SELECT * FROM trainers WHERE id = ?');
                    $query->bindParam(1, $trainer_id, PDO::PARAM_INT);
                    $query->execute();
                    $con->close();

                    $result = $query->fetch(PDO::FETCH_OBJ);

                    if(!empty($result)){
                        $trainer = new Trainer;
                        $trainer->setAttributes($result->id, $result->name, $result->last_name, $result->hired_at, $result->branch_id);
                        return $trainer;
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
        
        /*              Class methods               */
        public function branch(){
            return Branch::get($this->branch_id);
        }
    }
?>