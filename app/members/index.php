<!DOCTYPE html>
<html>
    <head>
        <title>Members</title>
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
            require_once "../../models/Member.php";
            
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

                                <a class="btn btn-success" href="<?php echo Helper::baseurl() ?>app/members/create.php">Create member</a>
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Member list</h4>
                                        <p class="category">Members of all branches</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <?php if(!empty($members)) { ?>
                                            <table class="table">
                                                <thead class="text-primary">
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Last Name</th>
                                                    <th>Branch</th>
                                                    <th>Membership</th>
                                                    <th>Birthdate</th>

                                                </thead>
                                                <tbody>
                                                    <?php foreach( $members as $member ) { ?>
                                                        <tr>
                                                            <td><?php echo $member->id ?></td>
                                                            <td><?php echo $member->name ?></td>
                                                            <td><?php echo $member->last_name ?></td>
                                                            <td><?php echo $member->branch()->name ?></td>
                                                            <td><?php echo $member->membership ?></td>
                                                            <td><?php echo $member->birthdate ?></td>
                                                            <td>
                                                                <a class="btn btn-info" href="<?php echo Helper::baseurl() ?>app/members/show.php?member=<?php echo $member->id ?>">Manage classes</a>
                                                                <a class="btn btn-primary" href="<?php echo Helper::baseurl() ?>app/members/edit.php?member=<?php echo $member->id ?>">Edit</a> 
                                                                <a class="btn btn-danger" href="<?php echo Helper::baseurl() ?>app/members/delete.php?member=<?php echo $member->id ?>">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } else { ?>
                                            <div class="alert alert-danger" style="margin-top: 25px">There are no members registered.</div>
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