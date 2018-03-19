<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../../models/Trainer.php");
    $trainer = Trainer::get(1);
    echo json_encode($trainer->schedules());
?>