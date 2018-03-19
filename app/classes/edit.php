<!DOCTYPE html>
<html>
    <head>
        <title>Create class</title>
        <meta charset="utf-8">

        <?php include '../layouts/head.php' ?>
    </head>
    <body>
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            require_once "../../models/Helper.php";
            require_once "../../models/Lesson.php";
            require_once "../../models/Branch.php";
            require_once "../../models/Trainer.php";
            
            $trainers = Trainer::all();
            
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
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Edit class</h4>
                                        <p class="category">Fill the data of the new class</p>
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo Helper::baseurl() ?>app/classes/update.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $lesson->id ?>" />
                                            <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="name">Name</label>
                                                        <input class="form-control" type="text" name="name" id="name" value="<?php echo $lesson->name ?>" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="trainer">Trainer</label>
                                                        <select class="form-control" name="trainer_id" id="trainer_id" required>
                                                            <?php
                                                                foreach($trainers as $trainer){
                                                                    if($trainer->id == $lesson->trainer_id)
                                                                        echo '<option value="'.$trainer->id.'" selected>'.$trainer->name.' '.$trainer->last_name.' | '.$trainer->branch()->name.'</option>';
                                                                    else
                                                                        echo '<option value="'.$trainer->id.'">'.$trainer->name.' '.$trainer->last_name.' | '.$trainer->branch()->name.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="capacity">Capacity</label>
                                                        <input class="form-control" type="number" min="5" max="30" step="1" name="capacity" id="capacity" value="<?php echo $lesson->capacity ?>">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary pull-right">Edit class</button>
                                                    <a href="<?php echo Helper::baseurl() ?>app/classes/index.php"><button class="btn btn-danger pull-right">Cancel</button></a>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- container -->
                </div> <!-- content -->
            </div>
            
            <?php include '../layouts/footer.php' ?>
        </div> <!-- wrapper -->
    </body>
    <?php include '../layouts/scripts.php' ?>
</html>