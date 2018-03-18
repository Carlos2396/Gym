<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear clase</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <?php 
        require_once "../../models/Helper.php";
        require_once "../../models/Lesson.php";
        require_once "../../models/Branch.php";
        require_once "../../models/Trainer.php";
        $trainers = Trainer::all();
    ?>
    
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Create class</h2>
            <form action="<?php echo Helper::baseurl() ?>app/classes/save.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="branch_id">Trainer</label>
                    <select class="form-control" name="trainer_id" id="trainer_id" required>
                        <?php
                            foreach($trainers as $trainer){
                                echo '<option value="'.$trainer->id.'">'.$trainer->name.' '.$trainer->last_name.' | '.Trainer::get($trainer->id)->branch()->name.'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="capacity">Capacity</label>
                    <input class="form-control" type="number" min="5" max="30" value="5" step="1" name="capacity" id="capacity">
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Add class" />
                <a href="<?php echo Helper::baseurl() ?>app/classes/index.php"><button class="btn btn-danger">Cancel</button></a>
            </form>
        </div>
    </div>
</body>
</html>