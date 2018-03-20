<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    require_once "../../models/Helper.php";
    require_once "../../models/Member.php";

	$id = filter_input(INPUT_GET, 'member', FILTER_VALIDATE_INT);
    
	if($id){
        $member = Member::get($id);
        if($member){
            $member->delete();
        }
        $_SESSION["success"] = "Member correctly deleted.";
    }
    
	header("Location:" . Helper::baseurl() . "app/members/index.php");
?>