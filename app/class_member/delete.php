<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require_once "../../models/Helper.php";
    require_once "../../models/Lesson.php";

	$id = filter_input(INPUT_GET, 'lesson', FILTER_VALIDATE_INT);
    
	if($id){
        Lesson::checkLesson($id);
        $lesson = Lesson::get($id);
        $lesson->delete();
        $_SESSION["success"] = "Class correctly deleted.";
    }
    
	header("Location:" . Helper::baseurl() . "app/classes/index.php");
?>