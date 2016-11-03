<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _("Administration"); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('configure'); ?>"><?php echo _("Configuration Editor"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Apply Configuration'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _("Apply Configuration"); ?></h2>
                <?php
                if (!empty($cmd_ids)) {
                    // Let's display the actual configurations going on...
                ?>
                <p><?php echo _("The configuration is currently being applied... This may take a few minutes. Below is a list of all current instances and their status."); ?></p>
                
                <div class="apply-node-box">
                <?php
                foreach ($cmd_ids as $cmd) {
                    $hostname = "";
                    if ($cmd['address'] != $cmd['hostname']) { $hostname = " (".$cmd['hostname'].")"; }
                    echo '<div class="apply-node" id="'.$cmd['cmd_id'].'" data-status="waiting" data-checks="0"><strong>'.$cmd['address'].$hostname.'</strong> <span class="loader"><img width="16" height="16" src="'.base_url('media/images/ajax-loader.gif').'"></span> <span class="status">'._('Starting').'...</span></div>';
                }
                ?>
                </div>

                <a href="<?php echo site_url('configure'); ?>" class="btn btn-default"><?php echo _("Back"); ?></a>

                <?php
                } else {
                    // Display the standard page...
                ?>
                <p><?php echo _("This will verify and apply all configurations to each instance in your cluster."); ?></p>
                <p>
                    <button id="apply" class="btn btn-primary"><?php echo _("Apply"); ?></button>
                </p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<!-- Verify apply modal -->
<div id="apply-confirm" class="modal hide fade" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3><?php echo _("Are You Sure?"); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo _("Are you sure you want to apply the configurations <em><strong>to all instances</strong></em>?"); ?></p>
        <div><?php echo _("All running logstash services will be restarted on each instance. This may take a couple minutes to verify and restart with the new configuration."); ?></div>
    </div>
    <div class="modal-footer">
        <a href="<?php echo site_url('configure/apply_to_instances'); ?>" class="btn btn-primary"><?php echo _("Yes, Apply Now"); ?></a>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo _("Cancel"); ?></button>
    </div>
</div>

<script>
$(document).ready(function() {

    $('#apply').click(function(e) {
        $('#apply-confirm').modal({backdrop:"static"});
    });

    setInterval(check_apply_status, 1000);

});

// Checks the command to see if it has been ran yet and updates the display
// for when it does finish... if there is an error, like the command never gets ran, it will
// output hints after 15 seconds that there may be something wrong and after 55 seconds
// it outputs that the node may be offline and after 60 seconds it stops checking all together
function check_apply_status() {
    $('.apply-node').each(function() {
        var status = $(this).data('status');
        var id = $(this).attr('id');
        var block = $(this);
        var checks = $(this).data('checks');
        if ((status == "waiting" || status == "running") && checks < 60) {
            $.post("<?php echo site_url('api/system/get_cmd_info'); ?>", { cmd_id: id }, function(data) {
                checks = checks+1;
                block.data('checks', checks);
                block.data('status', data.status);
                if (data.status == "waiting") {
                    if (checks > 55) {
                        block.find('.loader').html('<img src="<?php echo base_url("media/icons/error.png"); ?>">');
                        block.find('.status').html("<?php echo _('The instance is likely offline, please check and try again'); ?>.");
                    } else if (checks > 20) {
                        block.find('.status').html("<?php echo _('The apply command hasn\'t started yet. The instance may not be online or is unreachable.'); ?>");
                    } else {
                        block.find('.status').html("<?php echo _('Starting'); ?>...");
                    }
                } else if (data.status == "running") {
                    block.find('.status').html("<?php echo _('Running'); ?>...");
                } else if (data.status == "completed") {
                    if (data.last_run_output == "failed") {
                        block.find('.loader').html('<img src="<?php echo base_url("media/icons/error.png"); ?>">');
                        block.find('.status').html("<?php echo _('The configuration could not be verified'); ?>.");
                    } else {
                        block.find('.loader').html('<img src="<?php echo base_url("media/icons/tick.png"); ?>">');
                        block.find('.status').html("<?php echo _('Completed'); ?>!");
                    }
                }
            }, 'json');
        }
    });
}

</script>

<?php echo $footer; ?>