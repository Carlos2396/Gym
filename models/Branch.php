<?php
    require_once("../../db/Database.php");
    require_once("../../interfaces/IBranch.php");
    require_once("../../models/Trainer.php");

    class Branch implements IBranch {
        private $con;
        public $id;
        public $name;
        public $address;
        public $opening;

    	public function __construct(){
            $this->con = new Database;  		
    	}

        public function setAttributes($id, $name, $address, $opening){
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
            $this->opening = $opening;
        }

    	//obtenemos clases de una tabla con postgreSql
    	public static function all(){
    		try{
                $con = new Database;
                $query = $con->prepare('SELECT * FROM branches ORDER BY id');
                $query->execute();
                $con->close();
                
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                $branches = array();
                if(!empty($results)){
                    foreach($results as $result){
                        $temp = new Branch;
                        $temp->setAttributes($result->id, $result->name, $result->address, $result->opening);
                        array_push($branches, $temp);
                    }
                }

                return $branches;
    		}
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
        }
        
        public static function get($branch_id){
    		try{
                if(is_int($branch_id)){
                    $con = new Database;
                    $query = $con->prepare('SELECT * FROM branches WHERE id = ?');
                    $query->bindParam(1, $branch_id, PDO::PARAM_INT);
                    $query->execute();
                    $con->close();
                    
                    $result = $query->fetch(PDO::FETCH_OBJ);

                    if(!empty($result)){
                        $branch = new Branch;
                        $branch->setAttributes($result->id, $result->name, $result->address, $result->opening);
                        return $branch;
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
        
        public function trainers(){
            try{
                if(is_int($this->id)){
                    $con = new Database;
                    $query = $con->prepare('SELECT * FROM trainers WHERE branch_id = ?');
                    $query->bindParam(1, $branch_id, PDO::PARAM_INT);
                    $query->execute();
                    $con->close();
                    
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    
                    $trainers = array();
                    if(!empty($result)){
                        foreach($results as $temp){
                            $temp = new Trainer;
                            $temp->setAttributes($result->id, $result->name, $result->address, $result->opening);
                            array_push($trainers, $temp);
                        }
                    }

                    return $trainers;
                }
                else{
                    echo "Error, id is not a integer.";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
?>