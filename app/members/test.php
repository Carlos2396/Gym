<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../../models/Membership.php");
    $memberships = Membership::all();
    echo json_encode($memberships);
?>