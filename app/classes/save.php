<?php
    require_once "../../models/Helper.php";
    require_once "../../models/Lesson.php";

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	if (empty($_POST['submit'])){
	      header("Location:" . Helper::baseurl() . "app/classes.php");
	      exit;
	}

	$args = array(
	    'name'  => FILTER_SANITIZE_STRING,
        'trainer_id'  => FILTER_VALIDATE_INT,
        'capacity' => FILTER_VALIDATE_INT
	);

	$post = (object)filter_input_array(INPUT_POST, $args);

	$lesson = new Lesson();
	$lesson->setAttributes(NULL, $post->name, $post->capacity, $post->trainer_id);
	$lesson->save();
	header("Location:" . Helper::baseurl() . "app/classes/index.php");

?>