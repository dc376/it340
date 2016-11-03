<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Command Subsystem'); ?></li>
</ul>

<script type="text/javascript">
var EDITING;

$(document).ready(function() {

    $('#next-run').datetimepicker({
        timeFormat: "HH:mm:ss"
    });

    $('.edit').click(function() {
        var id = $(this).data('id');
        EDITING = id;

        // Grab the information on the system job before showing modal
        $.post(site_url+'api/system/get_job_by_id', { id: id }, function(data) {

            var freq = data.readable_frequency.split(' ');
            if (freq[1].substr(freq[1].length - 1) != 's') {
                freq[1] += 's';
            }

            // Update modal information
            $('.editing').html('<strong>' + data.id + '</strong><br/>(<?php echo _("Runs"); ?> ' + data.command + ')');
            $('#frequency').val(freq[0]);
            $('#freq-type').val(freq[1]);
            $('#next-run').val(data.readable_run_time);

        });

        $('#edit-system-job').modal('show');
    });

    $('.update-job').click(function() {

        var datetime = $('#next-run').val();
        var date = new Date(datetime);
        var timestamp = date.getTime() / 1000;

        var frequency = $('#frequency').val();
        var freqtype = $('#freq-type').val();
        var multi = 0;

        switch (freqtype) {
            case "seconds":
                multi = 1;
                break;
            case "minutes":
                multi = 60;
                break;
            case "hours":
                multi = 60*60;
                break;
            case "days":
                multi = 60*60*24;
                break;
        }
        
        frequency = frequency * multi;

        // Write these values to the job
        $.post(site_url+'api/system/update_job', { 'job[id]': EDITING, 'job[frequency]': frequency, 'job[run_time]': timestamp }, function(data) {
            $('#edit-system-job').modal('hide');
            location.reload();
        });

    });

    $('.force-reset').click(function() {
        if (confirm("<?php echo _('Resetting the subsystem jobs will set all jobs back to the default settings. This should only be done if the jobs have become stuck or one of the 5 standard jobs are missing. Would you like to continue?'); ?>")) {
            return true;
        } else {
            return false;
        }
    });

});
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _("Command Subsystem"); ?></h2>
                <p><?php echo _("The command subsystem runs all the jobs that are scheduled for backup, maintenance, and checks. It also runs occasional jobs that are required by other sections of the program."); ?><br/><?php echo _("Other jobs use the command subsystem to run but are not listed here. System jobs that are in <strong>waiting</strong> status are normal."); ?></p>

                <?php if (!empty($reset)) { ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo _("Subsystem jobs have been reset."); ?>
                </div>
                <?php } ?>

                <h4 style="margin-top: 20px;"><?php echo _("System Jobs"); ?> <a href="<?php echo site_url('admin/reset_subsystem'); ?>" class="force-reset btn btn-default btn-mini" style="margin-left: 10px;"><i class="fa fa-exclamation-triangle"></i> <?php echo _("Reset All Jobs"); ?></a></h4>
                <table class="table table-striped table-bordered" style="max-width: 1200px;">
                    <thead>
                        <tr>
                            <th><?php echo _("Job ID"); ?></th>
                            <th><?php echo _("Job Status"); ?></th>
                            <th><?php echo _("Last Run Status"); ?></th>
                            <th><?php echo _("Last Run Time"); ?></th>
                            <th><?php echo _("Frequency"); ?></th>
                            <th><?php echo _("Next Run Time"); ?></th>
                            <th><?php echo _("Type"); ?></th>
                            <th style="width: 60px; text-align: center;"><?php echo _("Actions"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($globals as $g) { ?>
                        <tr>
                            <td><?php echo $g['_id']; ?></td>
                            <td><?php echo ucfirst($g['_source']['status']); ?></td>
                            <td><?php if (!empty($g['_source']['last_run_status'])) { echo $g['_source']['last_run_status']; } else { echo "-"; } ?></td>
                            <td><?php if (!empty($g['_source']['last_run_time'])) { echo date("m/d/Y H:i:s", strtotime($g['_source']['last_run_time'])); } else { echo _("Never"); } ?></td>
                            <td><?php echo humanize_time($g['_source']['frequency']); ?></td>
                            <td><?php echo date("m/d/Y H:i:s", $g['_source']['run_time']); ?></td>
                            <td><?php echo ucfirst($g['_source']['type']); ?></td>
                            <td style="text-align: center;">
                                <i class="fa fa-pencil"></i> <a data-id="<?php echo $g['_id']; ?>" class="edit"><?php echo _("Edit"); ?></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<div id="edit-system-job" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3><?php echo _("Edit System Job"); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo _("You can update the frequency (the amount of time the job will wait between the runs) and the time you want the next scheduled run to be. Setting a run time of less than the current time will force the job to be ran almost instantly. Once a job has been run it will re-schedule itself using the frequency time."); ?></p>
        <div class="form-horizontal">
            <div class="control-group" style="margin: 30px 0 20px 0;">
                <label class="control-label" style="padding: 0;"><?php echo _("Editing job"); ?></label>
                <div class="controls">
                    <span class="editing"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="frequency"><?php echo _("Frequency"); ?></label>
                <div class="controls">
                    <input type="text" id="frequency" value="" style="display: inline-block; width: 30px;">
                    <select id="freq-type" style="display: inline-block; width: 100px;">
                        <option value="seconds"><?php echo _("seconds"); ?></option>
                        <option value="minutes"><?php echo _("minutes"); ?></option>
                        <option value="hours"><?php echo _("hours"); ?></option>
                        <option value="days"><?php echo _("days"); ?></option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="next-run"><?php echo _("Next Run Time"); ?></label>
                <div class="controls">
                    <input type="text" id="next-run" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo _("Close"); ?></button>
        <button class="btn btn-primary update-job"><?php echo _("Update"); ?></button>
    </div>
</div>

<?php echo $footer; ?>