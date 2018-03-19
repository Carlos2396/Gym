<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require_once "../../models/Helper.php";
    require_once "../../models/Schedule.php";
 
	$id = filter_input(INPUT_GET, 'schedule', FILTER_VALIDATE_INT);
    
	if($id){
        Schedule::checkSchedule($id);
        $schedule = Schedule::get($id);
        $schedule->delete();
        $_SESSION["success"] = "Scheduled correctly deleted.";
    }
    
	header("Location:" . Helper::baseurl() . "app/classes/show.php?lesson=".$schedule->lesson()->id);
?>