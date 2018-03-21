<div class="col-md-12">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Add a new schedule</h4>
            <p class="category"></p>
        </div>
        <div class="card-content table-responsive">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form action="<?php echo Helper::baseurl() ?>app/schedules/save.php" method="POST">
                        <input type="hidden" name="lesson_id" value="<?php echo $lesson->id ?>" />
                        <div class="row">
                            <div class="form-group label-floating col-md-4">
                                <label for="start">Starting day and hour of the new schedule</label>
                                <input class="form-control" type="datetime-local" placeholder="yyyy-mm-dd hh-mm" name="start" id="start" required>
                            </div>

                            <div class="form-group label-floating col-md-4">
                                <label for="duration">Duration (in minutes)</label>
                                <input class="form-control" type="number" step="1" min="30" max="120" value="60" name="duration" id="duration" required>
                            </div>

                            <div class="form-group label-floating col-md-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Add schedule" style="margin-top: 20px;"/>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>