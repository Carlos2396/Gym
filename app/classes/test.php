<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once("../../models/Lesson.php");
    $lessons = Lesson::all();
    $lesson = Lesson::get(1);

    echo json_encode($lesson->schedules());
?>