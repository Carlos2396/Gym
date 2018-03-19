<!DOCTYPE html>
<html>
    <head>
        <title>Create class</title>
        <meta charset="utf-8">

        <?php include '../layouts/head.php' ?>
    </head>
    <body>
        <?php 
            require_once "../../models/Helper.php";
            require_once "../../models/Lesson.php";
            require_once "../../models/Branch.php";
            require_once "../../models/Trainer.php";
            $trainers = Trainer::all();
        ?>

        <div class="wrapper">
            <?php include '../layouts/sidebar.php' ?>

            <!-- Main content -->
            <div class="main-panel">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php include '../layouts/error.php' ?>
                                
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Create class</h4>
                                        <p class="category">Fill the data of the new class</p>
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo Helper::baseurl() ?>app/classes/save.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="name">Name</label>
                                                        <input class="form-control" type="text" name="name" id="name" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="branch_id">Trainer</label>
                                                        <select class="form-control" name="trainer_id" id="trainer_id" required>
                                                            <?php
                                                                foreach($trainers as $trainer){
                                                                    echo '<option value="'.$trainer->id.'">'.$trainer->name.' '.$trainer->last_name.' | '.Trainer::get($trainer->id)->branch()->name.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="capacity">Capacity</label>
                                                        <input class="form-control" type="number" min="5" max="30" value="5" step="1" name="capacity" id="capacity">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary pull-right">Add class</button>
                                                    <a class="btn btn-danger pull-right" href="<?php echo Helper::baseurl() ?>app/classes/index.php">Cancel</a>
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