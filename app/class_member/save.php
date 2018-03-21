<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require_once "../../models/Helper.php";
    require_once "../../models/Lesson.php";
    require_once "../../models/Member.php";

    $schedule_id = filter_input(INPUT_POST, 'schedule', FILTER_VALIDATE_INT);
    $member_id = filter_input(INPUT_POST, 'member', FILTER_VALIDATE_INT);
	
    $schedule = Schedule::get($schedule_id);
    $member = Member::get($member_id);
    if(!$schedule || !$member){
        $_SESSION["error"] = "Wrong member or schedule";
        header("Location:" . Helper::baseurl() . "app/members/show.php?member=".$member_id);
        exit;
    }
	
	
	$result = $member->enroll($schedule_id);
	
	if(!$result->result->enroll){
		$_SESSION["error"] = "User's schedule incorrectly enrolled.";
	}
	else{
		$_SESSION["success"] = "User's schedule correctly enrolled.";
	}
    
    
    
	header("Location:" . Helper::baseurl() . "app/members/show.php?member=".$member_id);
?>