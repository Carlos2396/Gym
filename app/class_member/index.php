<!DOCTYPE html>
<html>
    <head>
        <title>Enrolled members</title>
        <meta charset="utf-8">

        <?php include '../layouts/head.php' ?>
    </head>

    <body>
        <?php
            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            require_once "../../models/Helper.php";
            require_once "../../models/Lesson.php";
            require_once "../../models/Member.php";
            
            $lessons = Lesson::all();
            $members = Member::all();
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
                                <?php include '../layouts/error.php' ?>

                                <a class="btn btn-success" href="<?php echo Helper::baseurl() ?>app/classes/create.php">Create class</a>
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Classes list</h4>
                                        <p class="category">Classes of all branches</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <?php if(!empty($lessons)) { ?>
                                        
                                            <table class="table">
                                                <thead class="text-primary">
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Capacity</th>
                                                    <th>Trainer</th>
                                                    <th>Branch</th>
                                                    <th>Actions</th>
                                                </thead>
                                                <tbody>
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
                                                </tbody>
                                            </table>
                                        <?php } else { ?>
                                            <div class="alert alert-danger" style="margin-top: 100px">There are no classes registered.</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div> <!-- col-md-12 -->
                        </div> <!-- row -->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>
            
            <?php include '../layouts/footer.php' ?>
        </div> <!-- wrapper -->
    </body>
    
    <?php include '../layouts/scripts.php' ?>
</html>