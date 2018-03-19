<?php
    if(isset($_SESSION["success"])) {
?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" style="margin-right: 30px;">&times;</button>
        <strong>Success!</strong> <?php echo $_SESSION["success"] ?>
    </div>
<?php
        session_unset($_SESSION["success"]);
    }
?>