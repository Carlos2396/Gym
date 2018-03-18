<div class="col-lg-12">
    <div class="row">
        <h3>Current schedules</h3>
        <?php if( !empty($schedules = $lesson->schedules())) { ?>
            <table class="table table-striped">
                <tr>
                    <th>Id</th>
                    <th>Sart</th>
                    <th>End</th>
                    <th>Subscribed members</th>
                    <th>Actions</th>
                </tr>
                    <?php foreach($schedules as $i=>$schedule) { ?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td><?php echo $schedule->start_time ?></td>
                            <td><?php echo $schedule->end_time ?></td>
                            <td>10</td>
                            <td>
                                <a class="btn btn-danger" href="<?php echo Helper::baseurl() ?>app/schedules/delete.php?schedule=<?php echo $schedule->id ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
            </table>
        <?php } else { ?>
            <div class="alert alert-danger" style="margin-top: 15px">There are no schedules registered for this class.</div>
        <?php } ?>
    </div>
</div>