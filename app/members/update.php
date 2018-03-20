<?php
	session_start();
    require_once "../../models/Helper.php";
	require_once "../../models/Member.php";
	require '../../vendor/autoload.php';
	use Carbon\Carbon;

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	$args = array(
        'membership'  => FILTER_SANITIZE_STRING,
        'name' => FILTER_SANITIZE_STRING,
        'last_name' => FILTER_SANITIZE_STRING,
        'birthdate' => FILTER_SANITIZE_STRING,
        'last_payment' => FILTER_SANITIZE_STRING,
        'branch_id'  => FILTER_VALIDATE_INT,
        'recommended_by'  => FILTER_VALIDATE_INT,
        'id' => FILTER_VALIDATE_INT
    );
    

    $post = (object)filter_input_array(INPUT_POST, $args);

    if(!$post->branch_id){ // check that they are integers
		$_SESSION["error"] = "ERROR: ".$post->branch_id."Invalid input, branch id must be an integer.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
    }

    if(!is_int($post->id) || $post->id <= 0){ // check that they are integers
		$_SESSION["error"] = "ERROR: ".$post->id." Invalid input, id must be a positive integer.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
    }
    
    if(!is_int($post->recommended_by)){ // check that they are integers
		$_SESSION["error"] = "ERROR: ".$post->recommended_by." Invalid input, recommended by must be integer.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
    }

    if($post->recommended_by<0){
        $_SESSION["error"] = "ERROR: ".$post->recommended_by." Invalid input, recommended by must be integer.";
	    header('Location: ' . $_SERVER['HTTP_REFERER']);
	    exit;
    }

    if($post->recommended_by===0){
        $post->recommended_by = null;
    }

    try{
        $start = new Carbon($post->birthdate, 'America/Mexico_City');
        $payment = new Carbon($post->last_payment, 'America/Mexico_City');
        $member = Member::get($post->id);

        if(!$member){
            $_SESSION["error"] = "ERROR: ".$post->recommended_by." Invalid member.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    
        
		$member->setAttributes($member->id, $post->branch_id, $post->membership, $post->name, $post->last_name, $start->toDateTimeString(), $post->recommended_by, NULL, $payment->toDateTimeString());

        $result = $member->update();

		if($result->result)
			$_SESSION["success"] = "Member correctly saved.";
		else
            $_SESSION["error"] = "Operation failed. ".$result->error;
	}
	catch(Exception $e){
		$_SESSION["error"] = "Invalid input, enter a valid date and time.";
		header("Location:" . Helper::baseurl() . "app/members/index.php");
		exit;
	}


	header("Location:" . Helper::baseurl() . "app/members/index.php");
?>