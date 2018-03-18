<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Show class</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        require_once "../../models/Helper.php";
        require_once "../../models/Lesson.php";

        use Carbon;
        
        $id = filter_input(INPUT_GET, 'lesson', FILTER_VALIDATE_INT);
        if( !$id )
            header("Location:" . Helper::baseurl() . "app/classes/index.php");

        Lesson::checkLesson($id);
        $lesson = Lesson::get($id);
    ?>
    
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Information of the class</h2>
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Trainer</th>
                    <th>Branch</th>
                </tr>
                    <tr>
                        <td><?php echo $lesson->id ?></td>
                        <td><?php echo $lesson->name ?></td>
                        <td><?php echo $lesson->capacity ?></td>
                        <td><?php echo Lesson::get($lesson->id)->trainer()->name ?> <?php echo Lesson::get($lesson->id)->trainer()->last_name ?></td>
                        <td><?php echo Lesson::get($lesson->id)->trainer()->branch()->name ?></td>
                    </tr>
            </table>
            <a class="btn btn-info" href="<?php echo Helper::baseurl() ?>app/classes/index.php">Return</a>
            <a class="btn btn-primary" href="<?php echo Helper::baseurl() ?>app/classes/edit.php?lesson=<?php echo $lesson->id ?>">Edit</a> 
        </div>
        
        <?php include "../schedules/create.php" ?>

        <?php include "../schedules/index.php" ?>
    </div>
</body>
</html>