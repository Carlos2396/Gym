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