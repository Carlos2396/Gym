<?php
    require_once "../../models/Helper.php";
    require_once "../../models/Schedule.php";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	if (empty($_POST['submit'])){
	      header("Location:" . Helper::baseurl() . "app/classes.php");
	      exit;
    }

	$args = array(
	    'start'  => FILTER_SANITIZE_STRING,
        'end'  => FILTER_SANITIZE_STRING,
        'lesson_id' => FILTER_VALIDATE_INT
	);

	$post = (object)filter_input_array(INPUT_POST, $args);
	$lesson = new Schedule();
	$lesson->setAttributes(NULL, $post->start, $post->end, $post->lesson_id);
    $lesson->save();
    
	header("Location:" . Helper::baseurl() . "app/classes/show.php?lesson=".$post->lesson_id);

?>