<?php
    require_once("../../db/Database.php");
    require_once("../../interfaces/IMembership.php");
    require_once("../../models/Helper.php");

    class Membership implements IMembership {
        private $con;
        public $id;
        public $type;

    	public function __construct(){
            $this->con = new Database;  		
        }
        
        public function setAttributes($id, $type){
            $this->id = $id;
            $this->type = $type;
        }


    	//obtenemos clases de una tabla con postgreSql
    	public static function all(){
    		try{
                $index = 0;
                $con = new Database;
                $query = $con->prepare('SELECT unnest(enum_range(null::membership_type))');
                $query->execute();
                $con->close();
                
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                $memberships = array();

                if(!empty($results)){
                    foreach($results as $result){
                        $temp = new Membership;
                        $temp->setAttributes($index, $result->unnest);
                        $index = $index+1;
                        array_push($memberships, $temp);
                    }
                }

                return $memberships;
    		}
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
        }
        
    }
?>