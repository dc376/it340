<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _("Administration"); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('configure'); ?>"><?php echo _("Configuration Editor"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Configuration Snapshots'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _("Configuration Snapshots"); ?></h2>
                <p><?php echo _("Save your configurations for later. Configurations for <em>all</em> instances are saved. When a snapshot is restored it will restore <em>all</em> configurations on <em>all</em> instances. Snapshots are stored in <strong>/usr/local/nagioslogserver/snapshots</strong>"); ?></p>

                <?php if (!empty($snapshot_success)) { ?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $snapshot_success; ?>
                </div>
                <?php } ?>

                <?php echo form_open('configure/create_snapshot', array("style" => "margin-bottom: 15px;")); ?>
                    <input type="text" name="snapshot_name" style="margin: 0 10px 0 0; width: 300px;" placeholder="<?php echo _("Snapshot name &amp; description"); ?>"><button type="submit" class="btn btn-default"><?php echo _("Create"); ?></button>
                <?php echo form_close(); ?>

                <table class="table table-striped table-bordered" style="width: 60%; min-width: 500px;">
                    <thead>
                        <tr>
                            <th><?php echo _("Name & Description"); ?></th>
                            <th style="width: 200px;"><?php echo _("Filename"); ?></th>
                            <th style="width: 220px;"><?php echo _("Creation Date"); ?></th>
                            <th style="width: 70px; text-align: center;"><?php echo _("Actions"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($snapshots) > 0) {
                        foreach ($snapshots as $snapshot) {
                        ?>
                        <tr>
                            <td><?php echo $snapshot['name']; ?></td>
                            <td><?php if (!empty($snapshot['filename'])) { echo $snapshot['filename']; } else { echo '<span id="ss-'.$snapshot['id'].'"><img style="width: 16px; height: 16px;" src="'.base_url('media/images/ajax-loader.gif').'"> '._("Creating..."); } ?></td>
                            <td><?php if (!empty($snapshot['created'])) { echo date("r", $snapshot['created']); } else { echo '<span id="ss-time-'.$snapshot['id'].'"></span>'; } ?></td>
                            <td style="font-size: 14px; text-align: center;">
                                <a href="<?php echo site_url('configure/download_snapshot/'.$snapshot['filename']); ?>" title="<?php echo _("Download the .tar.gz file"); ?>"><i class="fa fa-download"></i></a> &nbsp; 
                                <a data-name="<?php echo $snapshot['name']; ?>" data-id="<?php echo $snapshot['id']; ?>" class="restore" title="<?php echo _("Restore instances to this configuration"); ?>"><i class="fa fa-history"></i></a> &nbsp; 
                                <a href="<?php echo site_url('configure/delete_snapshot/'.$snapshot['id']); ?>" title="<?php echo _("Remove"); ?>"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php }
                        } else { ?>
                        <tr>
                            <td colspan="9"><?php echo _("No snapshots have been created yet."); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <h4><?php echo _("Auto-Created Snapshots"); ?></h4>
                <table class="table table-striped table-bordered" style="width: 60%; min-width: 500px;">
                    <thead>
                        <th><?php echo _("Name & Description"); ?></th>
                        <th style="width: 200px;"><?php echo _("Filename"); ?></th>
                        <th style="width: 220px;"><?php echo _("Creation Date"); ?></th>
                        <th style="width: 70px; text-align: center;"><?php echo _("Actions"); ?></th>
                    </thead>
                    <tbody>
                        <?php
                        if (count($auto_snapshots) > 0) {
                        foreach ($auto_snapshots as $snapshot) {
                        ?>
                        <tr>
                            <td><?php echo $snapshot['name']; ?></td>
                            <td><?php if (!empty($snapshot['filename'])) { echo $snapshot['filename']; } else { echo '<span id="ss-'.$snapshot['id'].'"><img style="width: 16px; height: 16px;" src="'.base_url('media/images/ajax-loader.gif').'"> '._("Creating..."); } ?></td>
                            <td><?php if (!empty($snapshot['created'])) { echo date("r", $snapshot['created']); } else { echo '<span id="ss-time-'.$snapshot['id'].'"></span>'; } ?></td>
                            <td style="font-size: 14px; text-align: center;">
                                <a href="<?php echo site_url('configure/archive_auto_snapshot/'.$snapshot['id']); ?>" title="<?php echo _("Archive this snapshot in the regular snapshots section"); ?>"><i class="fa fa-archive"></i></a> &nbsp; 
                                <a href="<?php echo site_url('configure/download_snapshot/'.$snapshot['filename']); ?>" title="<?php echo _("Download the .tar.gz file"); ?>"><i class="fa fa-download"></i></a> &nbsp; 
                                <a data-name="<?php echo $snapshot['name']; ?>" data-id="<?php echo $snapshot['id']; ?>" class="restore" title="<?php echo _("Restore instances to this configuration"); ?>"><i class="fa fa-history"></i></a>
                            </td>
                        </tr>
                        <?php }
                        } else { ?>
                        <tr>
                            <td colspan="9"><?php echo _("No automatic snapshots have been created yet. You probably haven't run an apply command."); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Verify restore modal -->
<div id="restore-confirm" class="modal hide fade" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3><?php echo _("Are You Sure?"); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo _("Are you sure you want to restore to snapshot"); ?> <strong id="restore-snapshot-name"></strong> <em><strong><?php echo _("to all instances"); ?></strong></em></p>
        <div><?php echo _("All running logstash services will be restarted on each instance. This may take a couple minutes to restore the database and files on all instances. If a instance does not have a snapshot it will NOT be updated."); ?></div>
    </div>
    <div class="modal-footer">
        <a href="<?php echo site_url('configure/restore_snapshot'); ?>" id="restore-link" class="btn btn-primary"><?php echo _("Yes, Restore Now"); ?></a>
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo _("Cancel"); ?></button>
    </div>
</div>

<script>
var UPDATE;
var UPDATE_ID = '<?php echo $cmd_id; ?>';
var SNAPSHOT_ID = '<?php echo $snapshot_id; ?>';

$(document).ready(function() {
    if (UPDATE_ID != '') {
        UPDATE = setInterval(check_if_completed, 1000);
    }

    // Restore a node... just checking if they want to
    $('.restore').click(function() {
        var id = $(this).data('id');
        $('#restore-snapshot-name').html($(this).data('name'));
        $('#restore-link').attr('href', $('#restore-link').attr('href') + "/" + id);
        $('#restore-confirm').modal({backdrop:"static"});
    });

});

function check_if_completed()
{
    $.get('<?php echo site_url("api/system/get_cmd_info"); ?>', { cmd_id: UPDATE_ID }, function(data) {
        if (data.status == "completed") {
            clearInterval(UPDATE);
            $.get('<?php echo site_url("api/system/get_snapshot_info"); ?>', { snapshot_id: SNAPSHOT_ID }, function(data) {
                $('#ss-'+SNAPSHOT_ID).html(data.filename);
                $('#ss-time-'+SNAPSHOT_ID).html(data.created_readable);
            });
        }
    }, 'json');
}
</script>

<?php echo $footer; ?>