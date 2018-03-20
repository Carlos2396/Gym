<!DOCTYPE html>
<html>
    <head>
        <title>Create member</title>
        <meta charset="utf-8">

        <?php include '../layouts/head.php' ?>
    </head>
    <body>
        <?php 
            require_once "../../models/Helper.php";
            require_once "../../models/Member.php";
            require_once "../../models/Branch.php";
            require_once "../../models/Membership.php";
            $branches = Branch::all();
            $members = Member::all();
            $memberships = Membership::all();
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
                                        <form action="<?php echo Helper::baseurl() ?>app/members/save.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="name">Name</label>
                                                        <input class="form-control" type="text" name="name" id="name" required>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="last_name">Last Name</label>
                                                        <input class="form-control" type="text" name="last_name" id="last_name" required>
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
                                                                    echo '<option value="'.$membership->type.'">'.$membership->type.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="recommended_by">Recommended by</label>
                                                        <select class="form-control" name="recommended_by" id="recommended_by" required>
                                                        <option value="0" selected>None</option>
                                                            <?php
                                                                foreach($members as $member){
                                                                    echo '<option value="'.$member->id.'">'.$member->name." ".$member->last_name.'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label" for="birthdate">Birthdate</label>
                                                        <input type="date" name="birthdate" id="birthdate" required>
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