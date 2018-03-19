<?php
	session_start();
    require_once "../../models/Helper.php";
	require_once "../../models/Schedule.php";
	require '../../vendor/autoload.php';
	use Carbon\Carbon;

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	$args = array(
	    'start'  => FILTER_SANITIZE_STRING,
        'duration'  => FILTER_VALIDATE_INT,
        'lesson_id' => FILTER_VALIDATE_INT
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

	if(!$post->duration || !$post->lesson_id){ // check that they are integers
		$_SESSION["error"] = "Invalid input, the duration and lesson id must be integers.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	
	if($post->duration > 120 || $post->duration < 30){ // check that duraation is higher or equal to 30 and lower or equal to 120
		$_SESSION["error"] = "Invalid input, the duration must be an integer between 30 and 120.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	
	try{
		$start = new Carbon($post->start, 'America/Mexico_City');
		$schedule = new Schedule();
		$schedule->setAttributes(NULL, $start->toDateTimeString(), $start->addMinutes($post->duration)->toDateTimeString(), $post->lesson_id);
		$result = $schedule->save();
		
		
		if($result->result)
			$_SESSION["success"] = "Scheduled correctly saved.";
		else
			$_SESSION["error"] = "Operation failed. ".$result->error;	
	}
	catch(Exception $e){
		echo "Hola2";
		$_SESSION["error"] = "Invalid input, enter a valid date and time.";
		header("Location:" . Helper::baseurl() . "app/classes/show.php?lesson=".$post->lesson_id);
		exit;
	}
	echo "Hola3";

	header("Location:" . Helper::baseurl() . "app/classes/show.php?lesson=".$post->lesson_id);
?>