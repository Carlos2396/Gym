<div class="col-lg-12">
    <hr>
    <h2 class="text-center text-primary">Schedules of this class</h2>
    <div class="row">
        <h3>Add Schedule</h3>
        <form action="<?php echo Helper::baseurl() ?>app/schedules/save.php" method="POST">
            <input type="hidden" name="lesson_id" value="<?php echo $lesson->id ?>" />
            
            <div class="form-group col-md-4">
                <label for="start">Begining</label>
                <input class="form-control" type="datetime-local" name="start" id="start" required>
            </div>

            <div class="form-group col-md-4">
                <label for="end">Ending</label>
                <input class="form-control" type="datetime-local" name="end" id="end" required>
            </div>

            <div class="form-group col-md-4">
                <input type="submit" name="submit" class="btn btn-success" value="Add schedule" style="margin-top: 25px;"/>
            </div>
        </form>
    </div>
</div>