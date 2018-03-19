<?php
    if(isset($_SESSION["error"])) {
?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" style="margin-right: 30px;">&times;</button>
        <strong>Error!</strong> <?php echo $_SESSION["error"] ?>
    </div>
<?php
        session_unset($_SESSION["error"]);
    }
?>