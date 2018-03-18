<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Crear clase</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
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
    
    <div class="container">
        <div class="col-lg-12">
            <h2 class="text-center text-primary">Edit class</h2>
            <form action="<?php echo Helper::baseurl() ?>app/classes/update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $lesson->id ?>" />
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="<?php echo $lesson->name ?>" required>
                </div>
                <div class="form-group">
                    <label for="branch_id">Trainer</label>
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
                <div class="form-group">
                    <label for="capacity">Capacity</label>
                    <input class="form-control" type="number" min="5" max="30" step="1" name="capacity" id="capacity" value="<?php echo $lesson->capacity ?>">
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Edit class" />
                <a href="<?php echo Helper::baseurl() ?>app/classes/index.php"><button class="btn btn-danger">Cancel</button></a>
            </form>
            
        </div>
    </div>
</body>
</html>