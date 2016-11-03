<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Global Settings'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('Global Settings'); ?></h2>
                <p><?php echo _('Edit default global settings for your Nagios Log Server install.'); ?></p>
                <?php if (!empty($success)) { ?><div class="alert alert-success"><?php echo $success; ?></div><?php } ?>
                <?php if ($error) { ?><div class="alert alert-error"><?php echo $error; ?></div><?php } ?>

                <?php echo form_open('admin/globals', array("class" => "form-horizontal")); ?>
                <div class="well" style="float: left; padding: 30px 60px 10px 20px;">
                    <div class="control-group">
                        <label class="control-label" for="language"><?php echo _("Default Language"); ?></label>
                        <div class="controls">
                            <select id="language" name="language" class="input-medium">
                            <?php foreach ($languages as $l) { ?>
                            <option value="<?php echo $l; ?>" <?php if ($global_language == $l) { echo 'selected'; } ?>><?php echo get_language_name($l); ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="hostname">
                            <?php echo _("Cluster Hostname"); ?>
                            <?php echo question_tooltip(_('The cluster hostname can be utilized if you have a load balancer or round robin DNS setup for your cluster. This will modify all of the setup instructions to point to this host name.')); ?>
                        </label>
                        <div class="controls">
                            <input id="hostname" name="cluster_hostname" type="text" class="input-large" value="<?php echo $cluster_hostname; ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="interface_url">
                            <?php echo _("Interface URL"); ?>
                            <?php echo question_tooltip(_('The interface URL is what is displayed in alerts for the view in dashboard URL.')); ?>
                        </label>
                        <div class="controls">
                            <input id="interface_url" name="interface_url" type="text" class="input-large" value="<?php echo $interface_url; ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="log_user_queries">
                            <?php echo _("Log User Queries"); ?>
                            <?php echo question_tooltip(_('Allows you to log all user queries to show in the Admin Security report.')); ?>
                        </label>
                        <div class="controls">
                            <label class="radio" style="float: left; padding-top: 5px;">
                                <input type="radio" name="log_user_queries" value="1" <?php if ($log_user_queries == 1) { echo "checked"; } ?>> <?php echo _('Yes'); ?>
                            </label>
                            <label class="radio" style="float: left; padding: 5px 0 0 35px;">
                                <input type="radio" name="log_user_queries" value="0" <?php if (!$log_user_queries) { echo "checked"; } ?>> <?php echo _('No'); ?>
                            </label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="backup_rotation">
                            <?php echo _("Backup Retention"); ?>
                            <?php echo question_tooltip(_('The amount of days to keep backup system data. This is ONLY for system data, NOT log data. Setting this to 0 will stop backups from being created.')); ?>
                        </label>
                        <div class="controls">
                            <input id="backup_rotation" name="backup_rotation" type="text" class="input-small" value="<?php if (empty($backup_rotation)) { echo '0'; } else { echo $backup_rotation; } ?>" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="disable_update_check">
                            <?php echo _("Disable Update Check"); ?>
                            <?php echo question_tooltip(_('Log Server update checks are performed every 24 hours, you can disable the check.')); ?>
                        </label>
                        <div class="controls">
                            <label class="radio" style="float: left; padding-top: 5px;">
                                <input type="radio" name="disable_update_check" value="1" <?php if ($disable_update_check == 1) { echo "checked"; } ?>> <?php echo _('Yes'); ?>
                            </label>
                            <label class="radio" style="float: left; padding: 5px 0 0 35px;">
                                <input type="radio" name="disable_update_check" value="0" <?php if (!$disable_update_check) { echo "checked"; } ?>> <?php echo _('No'); ?>
                            </label>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="disable_update_check">
                            <?php echo _("Cluster Timezone"); ?>
                            <?php echo question_tooltip(_('Will set the timezone of all systems in the cluster. May take up to a minute to complete.')); ?>
                        </label>
                        <div class="controls">
                            <select name="timezone" style="min-width: 300px;">
                                <?php
                                $cur_timezone = get_current_timezone();
                                if (!empty($set_timezone)) { $cur_timezone = $set_timezone; }
                                foreach (get_timezones() as $name => $val) {
                                ?>
                                <option value="<?php echo $val; ?>" <?php if ($val == $cur_timezone) { echo 'selected'; } ?>><?php echo $name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div>
                    <button <?php if ($demo_mode) { echo 'disabled'; } ?> type="submit" value="1" name="saveglobals" class="btn btn-primary"><?php echo _('Save Settings'); ?></button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>