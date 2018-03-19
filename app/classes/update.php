<?php
	session_start();
    require_once "../../models/Helper.php";
    require_once "../../models/Lesson.php";
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
	$args = array(
	    'id'        => FILTER_VALIDATE_INT,
	    'name'  => FILTER_SANITIZE_STRING,
        'capacity'  => FILTER_VALIDATE_INT,
        'trainer_id'  => FILTER_VALIDATE_INT
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

	if( $post->id === false ){
	    header("Location:" . Helper::baseurl() . "app/classes/index.php");
	}
	
	if(!$post->capacity || !$post->trainer_id){ // check that they are integers
		$_SESSION["error"] = "Invalid input, the capacity and the trainer id must be integers.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if($post->duration > 30 || $post->duration < 5){ // check that duraation is higher or equal to 30 and lower or equal to 120
		$_SESSION["error"] = "Invalid input, the capacity must be an integer between 5 and 30.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$lesson = new Lesson;
	$lesson->setAttributes($post->id, $post->name, $post->capacity, $post->trainer_id);
    $result = $lesson->update();
	
	if($result->result)
		$_SESSION["success"] = "Class correctly saved.";
	else
		$_SESSION["error"] = "Operation failed. ".$result->error;
	
	header("Location:" . Helper::baseurl() . "app/classes/show.php?lesson=".$lesson->id);
?>