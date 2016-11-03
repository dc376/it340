<?php echo $header; ?>

<script type="text/javascript">
$(document).ready(function() {
    $('.ls-pop').popover();
});
</script>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Backup &amp; Maintenance'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('Backup &amp; Maintenance'); ?></h2>

                <?php if ($msg) { ?>
                <div class="alert alert-<?php echo $msg_type; ?>" style="margin-bottom: 15px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $msg; ?>
                </div>
                <?php } ?>

                <div id="workspace">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="grid" style="margin-top: 0;">
                                <div class="grid-title">
                                    <div class="pull-left">
                                        <div class="table-title"><i class="fa fa-wrench"></i></div>
                                        <span><?php echo _("Maintenance Settings"); ?></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="maintenance" class="grid-content overflow">
                                <?php echo form_open('admin/backup'); ?>
                                    <table class="table table-striped table-hover table-bordered center-table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo _("Optimize Indexes older than"); ?>
                                                    <?php echo question_tooltip(_('Performs a Lucene forceMerge on indexes where no new data will be ingested. Set to 0 to disable.')); ?>
                                                </td>
                                                <td>
                                                    <input name="maintenance_settings[optimize_time]" type="text" class="span3" value="<?php echo $maintenance_settings['optimize_time']; ?>" /> <?php echo _('days'); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo _("Close indexes older than"); ?>
                                                    <?php echo question_tooltip(_('Marks indexes older that this value as closed. Closed indices do not take any system resources other than disk space, however are not searchable unless re-opened. Set to 0 to disable.')); ?>
                                                </td>
                                                <td>
                                                    <input name="maintenance_settings[close_time]" type="text" class="span3" value="<?php echo $maintenance_settings['close_time']; ?>" /> <?php echo _('days'); ?> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php echo _("Delete indexes older than"); ?>
                                                    <?php echo question_tooltip(_('Deletes indexes older than this value, freeing resources. This is permanant, the only way to restore a deleted index is from an archived snapshot. Set to 0 to disable.')); ?>
                                                </td>
                                                <td>
                                                    <input name="maintenance_settings[delete_time]" type="text" class="span3" value="<?php echo $maintenance_settings['delete_time']; ?>" /> <?php echo _('days'); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Repository to store backups in"); ?></td>
                                                <?php if(!empty($repositories)): ?>
                                                <td><select name="maintenance_settings[repository]" class="span6">
                                                    <option value=""></option>
                                                    <?php foreach ($repositories as $name => $respsitory) { ?>
                                                    <option value="<?php echo $name; ?>" <?php if ($maintenance_settings['repository'] == $name) { echo 'selected'; } ?>><?php echo $name; ?></option>
                                                    <?php } ?>
                                                    </select> <?php echo question_tooltip(_('Repository to store index snapshots.')); ?></td>
                                                <?php else: ?>
                                                <td><?php echo _('You must first create a repository on the right.'); ?></td>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Delete backups older than"); ?></td>
                                                <td>
                                                <?php if(!empty($repositories)): ?>
                                                    <input name="maintenance_settings[delete_snapshot_time]" type="text" class="span3" value="<?php echo (isset($maintenance_settings['delete_snapshot_time'])) ? $maintenance_settings['delete_snapshot_time'] : '720'; ?>" /> <?php echo _('days'); ?> <?php echo question_tooltip(_('Number of days before backup snapshots are deleted.')); ?>
                                                <?php else: ?>
                                                    <?php echo _('You must first create a repository on the right.'); ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Enable Maintenance and Backups"); ?> <?php echo question_tooltip(_('Enable or disable processing of all scheduled maintenance jobs.')); ?></td>
                                                <td>
                                                    <label class="radio"><?php echo _('Yes'); ?> <input type="radio" name="maintenance_settings[active]" value="1" <?php if ($maintenance_settings['active']) { echo "checked"; } ?>></label>
                                                    <label class="radio"><?php echo _('No'); ?> <input type="radio" name="maintenance_settings[active]" value="0" <?php if (!$maintenance_settings['active']) { echo "checked"; } ?>></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><button <?php if ($demo_mode) { echo 'disabled'; } ?> type="submit" value="1" name="maintenance" class="btn btn-primary"><?php echo _('Save Settings'); ?></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php echo form_close(); ?>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="grid" style="margin-top: 0;">
                                <div class="grid-title">
                                    <div class="pull-left" style="max-width: 150px">
                                        <div class="table-title"><i class="fa fa-hdd-o"></i></div>
                                        <span><?php echo _("Repositories"); ?></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="pull-right">
                                        <span><button style="margin: 5px 5px 0 0;" class="btn btn-small" name="saveglobals" value="1" type="submit" onclick="$('#repo_form').toggle();$('input[name=\'repository_name\']').focus();"><?php echo _("Create Repository"); ?></button></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="grid-content overflow">
                                    <table class="table table-striped table-hover table-bordered center-table">
                                        <tbody>
                                            <tr>
                                                <th><?php echo _("Name"); ?></th>
                                                <th><?php echo _("Location"); ?></th>
                                                <th><?php echo _("Type"); ?></th>
                                                <th style="width: 80px;"><?php echo _("Actions"); ?></th>
                                            </tr>
                                            <?php
                                            if (count($repositories) > 0) {
                                            foreach ($repositories as $name => $respsitory): ?>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $respsitory['settings']['location']; ?></td>
                                                <td><?php if ($respsitory['type'] == 'fs') { echo _("Filesystem"); } else { echo $respsitory['type']; } ?></td>
                                                <td><button class="btn btn-mini delete-repository" type="button"><input type="hidden" value="<?php echo $name; ?>"/><i class="fa fa-times-circle"></i> <?php echo _("delete"); ?></button></td>
                                            </tr>
                                            <?php endforeach;
                                            } else { ?>
                                            <tr>
                                                <td colspan="9"><?php echo _("No repositories have been created."); ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="clear"></div>
                                </div>
                                <div id="repo_form" class="form-horizontal" <?php if (empty($repo)) { ?>style="display: none;"<?php } ?>>
                                    <?php echo form_open('admin/backup'); ?>
                                    <div style="margin: 0 10px 10px 10px;">
                                    
                                    <table class="table table-striped table-hover table-bordered center-table">
                                        <tbody>
                                            <tr>
                                                <td style="width: 160px; vertical-align: middle;"><?php echo _('Repository Name'); ?>:</td>
                                                <td><input name="repository_name" type="text" class="input-medium" value="<?php if (!empty($repo['name'])) { echo $repo['name']; } ?>" /></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 160px; vertical-align: middle;"><?php echo _('Repository Location'); ?>:</td>
                                                <td><input name="repository_location" type="text" class="input-medium" value="<?php if (!empty($repo['location'])) { echo $repo['location']; } ?>" /> <?php echo question_tooltip(_('This location MUST be a shared filesystem accessible to all data instances in the cluster or either backups or restoration can fail.')); ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><button <?php if ($demo_mode) { echo 'disabled'; } ?> type="submit" value="1" name="addrepo" class="btn btn-primary"><?php echo _('Add Repository'); ?></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($repositories as $name => $respsitory): ?>
                            <div class="grid">
                                <div class="grid-title">
                                    <div class="pull-left">
                                        <div class="table-title"><i class="fa fa-archive"></i></div>
                                        <span><?php echo $name. " " . _("Snapshots"); ?></span>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="grid-content overflow">
                                    <table class="table table-striped table-hover table-bordered center-table">
                                        <tbody>
                                            <tr>
                                                <th><?php echo _("Created / Name"); ?> (<?php echo ('Click'); ?> <i class="fa fa-info-circle"></i>)</th>
                                                <th><?php echo _("State"); ?></th>
                                                <th><?php echo _("Indexes"); ?></th>
                                                <th><?php echo _("Actions"); ?></th>
                                            </tr>
                                            <?php
                                            foreach ($respsitory['snapshots'] as $snapshot):
                                                $created = 'N/A';
                                                $t = strtotime(str_replace('curator-', '', $snapshot['snapshot']).' GMT');
                                                if ($t) {
                                                    $created = date('m-d-Y H:i:s', $t);
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo $created; ?> <i class="fa fa-info-circle ls-pop" data-content="<?php echo $snapshot['snapshot']; ?>"></i></td>
                                                <td><?php echo $snapshot['state']; ?></td>
                                                <td><?php echo implode($snapshot['indices'], '<br>'); ?></td>
                                                <td><button class="btn btn-mini restore-snapshot" data-repo="<?php echo $name; ?>" data-snapshot="<?php echo $snapshot['snapshot']; ?>" data-created="<?php echo $created; ?>" type="button"><input name="repository" type="hidden" value="<?php echo $name; ?>"/><input name="snapshot" type="hidden" value="<?php echo $snapshot['snapshot']; ?>"/><i class="fa fa-refresh"></i> <?php echo _("restore"); ?></button> <button class="btn btn-mini delete-snapshot" type="button"><input name="repository" type="hidden" value="<?php echo $name; ?>"/><input name="snapshot" type="hidden" value="<?php echo $snapshot['snapshot']; ?>"/><i class="fa fa-trash-o"></i> <?php echo _("delete"); ?></button></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal hide fade" id="restore-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?php echo _('Select Indices to Restore'); ?></h3>
    </div>
    <div class="modal-body">
        <div>
            <?php echo _('Restoring form'); ?> <b><span class="restore-sh"></span></b> <?php echo _('created at'); ?> <b><span class="restore-created"></span></b>
        </div>
        <div style="margin-top: 5px;">
            <span style="width: 29px; text-align: right; display: inline-block;"><input type="checkbox" style="margin: 0 4px 0 0;" id="checkall"></span>
            <label for="checkall" style="font-size: 10px; display: inline-block;"><?php echo _('Toggle all checkboxes') ?></label>
        </div>
        <div>
            <table class="table table-condensed table-striped table-hover" style="margin: 5px 0 0 0;">
                <tbody class="restore-indices">
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" class="restore-repo">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo _('Close'); ?></button>
        <button class="btn btn-primary" id="do-restore" data-loading-text="<?php echo _('Restoring'); ?>..."><?php echo _('Restore Indices'); ?></button>
    </div>
</div>

<?php echo $footer; ?>