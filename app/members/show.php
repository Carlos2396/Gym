<!DOCTYPE html>
<html>
    <head>
        <title>Show member</title>
        <meta charset="utf-8">

        <?php include '../layouts/head.php' ?>
    </head>

    <body>
        <?php
            session_start();
            ini_set('display_errors', 1);
            require_once "../../models/Helper.php";
            require_once "../../models/Member.php";
            require_once "../../models/Schedule.php";
            use Carbon\Carbon;
            
            $id = filter_input(INPUT_GET, 'member', FILTER_VALIDATE_INT);
            if( !$id )
                header("Location:" . Helper::baseurl() . "app/members/index.php");

            $member = Member::get($id);
            if(!$member){
                header("Location:" . Helper::baseurl() . "app/members/index.php");
            }

            $schedules = Schedule::all();       
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
                                
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Information of the member</h4>
                                        <p class="category"></p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Branch</th>
                                            <th>Membership</th>
                                            <th>Birthdate</th>
                                            <th>Member since</th>
                                            <th>Last payment</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td><?php echo $member->id ?></td>
                                                <td><?php echo $member->name ?></td>
                                                <td><?php echo $member->last_name ?></td>
                                                <td><?php echo Member::get($member->id)->branch()->name ?></td>
                                                <td><?php echo $member->membership ?></td>
                                                <td><?php echo $member->birthdate ?></td>
                                                <td><?php echo $member->created_at ?></td>
                                                <td><?php echo $member->last_payment ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a class="btn btn-info" href="<?php echo Helper::baseurl() ?>app/members/index.php">Return</a>
                                        <a class="btn btn-primary" href="<?php echo Helper::baseurl() ?>app/members/edit.php?member=<?php echo $member->id ?>">Edit</a> 
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Enroll in class</h4>
                                        <p class="category">Select a schedule to enroll this member </p>
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo Helper::baseurl() ?>app/class_member/save.php" method="POST">
                                            <input type="hidden" value="<?php echo $id ?>" id="member" name="member">
                                            <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="schedule">Class</label>
                                                        <select class="form-control" name="schedule" id="schedule" required>
                                                            <?php
                                                                foreach($schedules as $schedule){
                                                                    echo '<option value="'.$schedule->id.'">'.$schedule->lesson()->name." | ".$schedule->start_time->format('l h:i:s A')."-".$schedule->end_time->format('l h:i:s A').'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary pull-right">Enroll</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Classes list</h4>
                                        <p class="category">Classes of current member </p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <?php if(!empty($member->schedules())) { ?>
                                        
                                            <table class="table">
                                                <thead class="text-primary">
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Capacity</th>
                                                    <th>Trainer</th>
                                                    <th>Branch</th>
                                                    <th>Starts</th>
                                                    <th>Ends</th>
                                                    <th>Actions</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach( $member->schedules() as $schedule ) { ?>
                                                        <tr>
                                                            <td><?php echo $schedule->lesson()->id ?></td>
                                                            <td><?php echo $schedule->lesson()->name ?></td>
                                                            <td><?php echo $schedule->lesson()->capacity ?></td>
                                                            <td><?php echo Lesson::get($schedule->id)->trainer()->name ?> <?php echo Lesson::get($schedule->id)->trainer()->last_name ?></td>
                                                            <td><?php echo Lesson::get($schedule->id)->trainer()->branch()->name ?></td>
                                                            <td><?php echo $schedule->start_time ?></td>
                                                            <td><?php echo $schedule->end_time ?></td>
                                                            <td>
                                                                <a class="btn btn-danger" href="<?php echo Helper::baseurl() ?>app/class_member/delete.php?schedule=<?php echo $schedule->id ?>&member=<?php echo $member->id ?>">Delete</a>
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