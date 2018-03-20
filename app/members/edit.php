<!DOCTYPE html>
<html>
    <head>
        <title>Edit member</title>
        <meta charset="utf-8">

        <?php include '../layouts/head.php' ?>
    </head>
    <body>
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            require_once "../../models/Helper.php";
            require_once "../../models/Member.php";
            require_once "../../models/Branch.php";
            require_once "../../models/Membership.php";
            $branches = Branch::all();
            $members = Member::all();
            $memberships = Membership::all();

            $id = filter_input(INPUT_GET, 'member', FILTER_VALIDATE_INT);
            if( !$id )
                header("Location:" . Helper::baseurl() . "app/members/index.php");

            $member = Member::get($id);

            if(!$member){
                header("Location:" . Helper::baseurl() . "app/members/index.php");
            }
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
                                        <h4 class="title">Create member</h4>
                                        <p class="category">Fill the data of the new member</p>
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo Helper::baseurl() ?>app/members/update.php" method="POST">
                                            <input type="hidden" name="created_at" id="created_at" value="<?php echo $member->created_at ?>">
                                            <input type="hidden" name="id" value="<?php echo $member->id ?>" />
                                            <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="name">Name</label>
                                                        <input class="form-control" type="text" value="<?php echo $member->name ?>" name="name" id="name" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="last_name">Last Name</label>
                                                        <input class="form-control" type="text" value="<?php echo $member->last_name ?>" name="last_name" id="last_name" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="branch_id">Branch</label>
                                                        <select class="form-control" name="branch_id" id="branch_id" required>
                                                            <?php
                                                                foreach($branches as $branch){
                                                                    echo '<option value="'.$branch->id.'">'.$branch->name.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="membership">Membership type</label>
                                                        <select class="form-control" name="membership" id="membership" required>
                                                            <?php
                                                                foreach($memberships as $membership){
                                                                    if($membership->type == $member->membership){
                                                                        echo '<option value="'.$membership->id.'" selected>'.$membership->type.'</option>';
                                                                    }
                                                                    else{
                                                                        echo '<option value="'.$membership->id.'">'.$membership->type.'</option>';
                                                                    }
                                                                    
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="recommended_by">Recommended by</label>
                                                        <select class="form-control" name="recommended_by" id="recommended_by" required>
                                                        <option value="0">None</option>
                                                            <?php
                                                                foreach($members as $member1){
                                                                    if($member->recommended_by != null && $member1->id == $member->recommended_by){
                                                                        echo '<option value="'.$member->id.'" selected>'.$member->name." ".$member->last_name.'</option>';
                                                                    }
                                                                    else{
                                                                        echo '<option value="'.$member->id.'">'.$member->name." ".$member->last_name.'</option>';
                                                                    }
                                                                    
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="birthdate">Birthdate</label>
                                                        <input type="date" value="<?php echo $member->birthdate ?>" name="birthdate" id="birthdate" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="last_payment">Last payment</label>
                                                        <input type="date" value="<?php echo $member->last_payment ?>"name="last_payment" id="last_payment" required>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary pull-right">Add member</button>
                                                    <a class="btn btn-danger pull-right" href="<?php echo Helper::baseurl() ?>app/members/index.php">Cancel</a>
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