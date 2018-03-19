<?php
	session_start();
    require_once "../../models/Helper.php";
	require_once "../../models/Schedule.php";
	require '../../vendor/autoload.php';
	use Carbon\Carbon;

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	if (empty($_POST['submit'])){
	      header("Location:" . Helper::baseurl() . "app/classes.php");
	      exit;
    }

	$args = array(
	    'start'  => FILTER_SANITIZE_STRING,
        'duration'  => FILTER_VALIDATE_INT,
        'lesson_id' => FILTER_VALIDATE_INT
	);

	$post = (object)filter_input_array(INPUT_POST, $args);
	
	try{
		$start = new Carbon($post->start, 'America/Mexico_City');
		
		$schedule = new Schedule();
		$schedule->setAttributes(NULL, $start->toDateTimeString(), $start->addMinutes($post->duration)->toDateTimeString(), $post->lesson_id);
		$schedule->save();
		$_SESSION["success"] = "Scheduled correctly saved.";
	}
	catch(Exception $e){
		echo "Failed";
		die();
	}

	header("Location:" . Helper::baseurl() . "app/classes/show.php?lesson=".$post->lesson_id);
?>