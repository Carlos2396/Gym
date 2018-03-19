<!DOCTYPE html>
<html>
    <head>
        <title>Show class</title>
        <meta charset="utf-8">

        <?php include '../layouts/head.php' ?>
    </head>

    <body>
        <?php
            session_start();
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
        
        <div class="wrapper">
            <?php include '../layouts/sidebar.php' ?>

            <!-- Main content -->
            <div class="main-panel">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php include '../layouts/success.php' ?>
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Information of the class</h4>
                                        <p class="category"></p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Capacity</th>
                                                <th>Trainer</th>
                                                <th>Branch</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $lesson->id ?></td>
                                                    <td><?php echo $lesson->name ?></td>
                                                    <td><?php echo $lesson->capacity ?></td>
                                                    <td><?php echo Lesson::get($lesson->id)->trainer()->name ?> <?php echo Lesson::get($lesson->id)->trainer()->last_name ?></td>
                                                    <td><?php echo Lesson::get($lesson->id)->trainer()->branch()->name ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a class="btn btn-info" href="<?php echo Helper::baseurl() ?>app/classes/index.php">Return</a>
                                        <a class="btn btn-primary" href="<?php echo Helper::baseurl() ?>app/classes/edit.php?lesson=<?php echo $lesson->id ?>">Edit</a> 
                                    </div>
                                </div>
                            </div> <!-- col-md-12 -->

                            <?php include '../schedules/create.php' ?>

                            <?php include "../schedules/index.php" ?>
                        </div> <!-- row -->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>
            
            <?php include '../layouts/footer.php' ?>
        </div> <!-- wrapper -->
    </body>
    
    <?php include '../layouts/scripts.php' ?>
</html>