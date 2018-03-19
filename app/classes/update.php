<?php
	session_start();
    require_once "../../models/Helper.php";
    require_once "../../models/Lesson.php";
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	if (isset($_POST['submit'])){
	      header("Location:" . Helper::baseurl() . "app/classes/index.php");
	      exit;
    }
    
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

	$lesson = new Lesson;
	$lesson->setAttributes($post->id, $post->name, $post->capacity, $post->trainer_id);
    $lesson->update();
	$_SESSION["success"] = "Class correctly updated.";
	
	header("Location:" . Helper::baseurl() . "app/classes/show.php?lesson=".$lesson->id);
?>