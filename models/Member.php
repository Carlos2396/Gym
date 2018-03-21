<?php
    require_once("../../db/Database.php");
    require_once("../../interfaces/IMember.php");
    require_once("../../models/Helper.php");
    require_once("../../models/Branch.php");
    require_once("../../models/Schedule.php");
    use Carbon\Carbon;

    class Member implements IMember {
        /*              Attributes               */
        private $con;
        public $id;
        public $branch_id;
        public $membership;
        public $name;
        public $last_name;
        public $birthdate;
        public $recommended_by;
        public $created_at;
        public $last_payment;
        
        /*              Static init and constructor               */
    	public function __construct(){
            $this->con = new Database; 		
    	}

        /*              Setters               */
        public function setAttributes($id, $branch_id, $membership, $name, $last_name, $birthdate, $recommended_by, $created_at, $last_payment){
            $this->id = $id;
            $this->branch_id = $branch_id;
            $this->membership = $membership;
            $this->name = $name;
            $this->last_name = $last_name;
            $this->birthdate = $birthdate;
            $this->recommended_by = $recommended_by;
            $this->created_at = date('m-d-Y H:i:s');
            $this->last_payment = $last_payment;
        }

    	/*              Static methods               */
    	public static function all(){
    		try{
                $con = new Database;
                $query = $con->prepare('SELECT * FROM members ORDER BY id');
                $query->execute();
                $con->close();
                
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                $members = array();
                if(!empty($results)){
                    foreach($results as $result){
                        $temp = new Member;
                        $temp->setAttributes($result->id, $result->branch_id, $result->membership, $result->name, $result->last_name, $result->birthdate, $result->recommended_by, $result->created_at, $result->last_payment);
                        array_push($members, $temp);
                    }
                }
                
                return $members;
            }
            catch(PDOException $e){
    	        echo  $e->getMessage();
    	    }
        }
        
        public static function get($member_id){
    		try{
                if(is_int($member_id)){
                    $con = new Database;
                    $query = $con->prepare('SELECT * FROM members WHERE id = ?');
                    $query->bindParam(1, $member_id, PDO::PARAM_INT);
                    $query->execute();
                    $con->close();

                    $result = $query->fetch(PDO::FETCH_OBJ);

                    if(!empty($result)){
                        $member = new Member;
                        $member->setAttributes($result->id, $result->branch_id, $result->membership, $result->name, $result->last_name, $result->birthdate, $result->recommended_by, $result->created_at, $result->last_payment);
                        return $member;
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

        public function save() {
            $data = (object) [
                'result' => false,
                'error' => null
            ];
            
    		try{
    			$query = $this->con->prepare('INSERT INTO members (membership, name, last_name, birthdate, created_at, last_payment, branch_id, recommended_by) values (?,?,?,?,?,?,?,?)');
                $query->bindParam(1, $this->membership, PDO::PARAM_STR);
                $query->bindParam(2, $this->name, PDO::PARAM_STR);
                $query->bindParam(3, $this->last_name, PDO::PARAM_STR);
                $query->bindParam(4, $this->birthdate, PDO::PARAM_STR);
                $created_at = Carbon::now('America/Mexico_City')->toDateTimeString();
                $query->bindParam(5, $created_at, PDO::PARAM_STR);
                $query->bindParam(6, $created_at, PDO::PARAM_STR);
                $query->bindParam(7, $this->branch_id, PDO::PARAM_INT);
                $query->bindParam(8, $this->recommended_by, PDO::PARAM_INT);
                $data->result = $query->execute();
                $this->con->close();

                if(!$data->result){
                    $data->error = $query->errorInfo();
                    $data->error = $data->error[2];
                }
    		}
            catch(PDOException $e) {
    	        $data->error = $e->getMessage();
            }

            return $data;
    	}

        public function update(){
            $data = (object) [
                'result' => false,
                'error' => null
            ];
            
    		try{
    			$query = $this->con->prepare('UPDATE members SET membership = ?, name = ?, last_name = ?, birthdate = ?, last_payment = ?, branch_id = ?, recommended_by = ? WHERE id = ?');
                $query->bindParam(1, $this->membership, PDO::PARAM_INT);
                $query->bindParam(2, $this->name, PDO::PARAM_STR);
                $query->bindParam(3, $this->last_name, PDO::PARAM_STR);
                $query->bindParam(4, $this->birthdate, PDO::PARAM_STR);
                $query->bindParam(5, $this->last_payment, PDO::PARAM_STR);
                $query->bindParam(6, $this->branch_id, PDO::PARAM_INT);
                $query->bindParam(7, $this->recommended_by, PDO::PARAM_INT);
                $query->bindParam(8, $this->id, PDO::PARAM_INT);
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

        public function delete(){
            $data = (object) [
                'result' => false,
                'error' => null
            ];

            try{
                $query = $this->con->prepare('DELETE FROM members WHERE id = ?');
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

        public function schedules(){
            try{
                $con = new Database;
                $query = $con->prepare('SELECT * FROM member_schedule ms, schedules s WHERE ms.member_id = ? AND s.id = ms.schedule_id ORDER BY id;');
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

        public function enroll($schedule_id){
            $data = (object) [
                'result' => false,
                'error' => null
            ];

            try{
                $query = $this->con->prepare('SELECT enroll(?, ?)');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->bindParam(2, $schedule_id, PDO::PARAM_INT);
                $data->result = $query->execute();
                $this->con->close();

                if(!$data->result){
                    $data->error = $query->errorInfo();
                    $data->error = $data->error[2];   
                }
                $data->result = $query->fetchAll(PDO::FETCH_OBJ);

            }
            catch(PDOException $e){
    	        $data->error = $e->getMessage();
            }
            
            return $data;
        }

        public function unsubscribe($schedule_id){
            $data = (object) [
                'result' => false,
                'error' => null
            ];

            try{
                $query = $this->con->prepare('SELECT unsubscribe(?, ?)');
                $query->bindParam(1, $this->id, PDO::PARAM_INT);
                $query->bindParam(2, $schedule_id, PDO::PARAM_INT);
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

    }
?>