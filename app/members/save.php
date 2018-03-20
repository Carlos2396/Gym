<?php
	session_start();
    require_once "../../models/Helper.php";
	require_once "../../models/Member.php";
	require '../../vendor/autoload.php';
	use Carbon\Carbon;

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	$args = array(
        'membership'  => FILTER_VALIDATE_INT,
        'name' => FILTER_SANITIZE_STRING,
        'last_name' => FILTER_SANITIZE_STRING,
        'birthdate' => FILTER_SANITIZE_STRING,
        'created_at' => FILTER_SANITIZE_STRING,
        'last_payment' => FILTER_SANITIZE_STRING,
        'branch_id'  => FILTER_VALIDATE_INT,
        'recommended_by'  => FILTER_VALIDATE_INT,
    );
    
    $args->created_at = date('m-d-Y H:i:s');

	$post = (object)filter_input_array(INPUT_POST, $args);

    if(!$post->branch_id){ // check that they are integers
		$_SESSION["error"] = "ERROR: ".$post->branch_id."Invalid input, branch id must be an integer.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
    }
    
    if(!is_int($post->recommended_by)){ // check that they are integers
		$_SESSION["error"] = "ERROR: ".$post->recommended_by." Invalid input, recommended by must be integer.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
    }

    if($post->recommended_by<0){
        $_SESSION["error"] = "ERROR: ".$post->recommended_by." Invalid input, recommended by must be integer.";
	    header('Location: ' . $_SERVER['HTTP_REFERER']);
	    exit;
    }

    if($post->recommended_by===0){
        $post->recommended_by = null;
    }
    
    if(!is_int($post->membership)){ // check that they are integers
		$_SESSION["error"] = "ERROR: ".$post->membership."Invalid input, membership type must be integer.";
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
    }

    if($post->membership < 0){
        
    }

	header("Location:" . Helper::baseurl() . "app/members/show");
?>