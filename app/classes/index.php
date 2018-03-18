<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado de clases</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            require_once "../../models/Helper.php";
            require_once "../../models/Lesson.php";
            $lessons = Lesson::all();
        ?>
        <div class="container">
            <div class="col-lg-12">
                <h2 class="text-center text-primary">Clases List</h2>
                <div class="col-lg-1 pull-right" style="margin-bottom: 10px">
                    <a class="btn btn-success" href="<?php echo Helper::baseurl() ?>app/classes/create.php">Add class</a>
                </div>
                <?php if(!empty($lessons)) { ?>
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th>Trainer</th>
                            <th>Branch</th>
                            <th>Actions</th>
                        </tr>
                        <?php foreach( $lessons as $lesson ) { ?>
                            <tr>
                                <td><?php echo $lesson->id ?></td>
                                <td><?php echo $lesson->name ?></td>
                                <td><?php echo $lesson->capacity ?></td>
                                <td><?php echo Lesson::get($lesson->id)->trainer()->name ?> <?php echo Lesson::get($lesson->id)->trainer()->last_name ?></td>
                                <td><?php echo Lesson::get($lesson->id)->trainer()->branch()->name ?></td>
                                <td>
                                    <a class="btn btn-info" href="<?php echo Helper::baseurl() ?>app/classes/show.php?lesson=<?php echo $lesson->id ?>">Show</a>
                                    <a class="btn btn-primary" href="<?php echo Helper::baseurl() ?>app/classes/edit.php?lesson=<?php echo $lesson->id ?>">Edit</a> 
                                    <a class="btn btn-danger" href="<?php echo Helper::baseurl() ?>app/classes/delete.php?lesson=<?php echo $lesson->id ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-danger" style="margin-top: 100px">There are no classes registered.</div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>