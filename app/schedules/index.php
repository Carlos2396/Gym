<?php
    require '../../vendor/autoload.php';
    use Carbon\Carbon;
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Schedules of this class</h4>
            <p class="category"></p>
        </div>
        <div class="card-content table-responsive">
            <?php if( !empty($schedules = $lesson->schedules())) { ?>
            
                <table class="table">
                    <thead class="text-primary">
                        <th>Id</th>
                        <th>Sart</th>
                        <th>End</th>
                        <th>Subscribed members</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php foreach($schedules as $i=>$schedule) { ?>
                            <tr>
                                <td><?php echo $i+1 ?></td>
                                <td><?php echo $schedule->start_time->format('l h:i:s A') ?></td>
                                <td><?php echo $schedule->end_time->format('l h:i:s A') ?></td>
                                <td>10</td>
                                <td>
                                    <a class="btn btn-danger" href="<?php echo Helper::baseurl() ?>app/schedules/delete.php?schedule=<?php echo $schedule->id ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-danger" style="margin-top: 15px">There are no schedules registered for this class.</div>
            <?php } ?>
        </div>
    </div>
</div> <!-- col-md-12 -->
