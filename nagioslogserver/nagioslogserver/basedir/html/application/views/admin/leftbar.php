        <div class="lside admin-leftbar">
            <div class="well" style="padding: 10px 0; margin-bottom: 10px;">
                <ul class="nav nav-list">
                    <li class="nav-header"><?php echo _("Configuration Editor"); ?></li>
                    <?php if ($tab == "apply") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('configure/apply'); ?>"><i class="fa fa-external-link"></i> <?php echo _("Apply Configuration"); ?></a></li>
                    <?php if ($tab == "snapshots") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('configure/snapshots'); ?>"><i class="fa fa-clock-o"></i> <?php echo _("Config Snapshots"); ?></a></li>
                    <li class="nav-header"><?php echo _("Global"); ?></li>
                    <?php if ($tab == "global") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('configure/instance/global'); ?>"><i class="icon-globe"></i> <?php echo _("Global Configuration"); ?></a></li>
                    <li class="nav-header nodes-toggle-advanced"><i class="fa <?php if (strlen($tab) < 10) { $show = 'no-display'; echo "fa-caret-up"; } else { $show = ''; echo "fa-caret-down"; } ?> nodes-icon"></i> <?php echo _("Per Instance (Advanced)"); ?></li>
                    <?php foreach ($nodes as $n) {
                            if ($n['_id'] == $tab) { echo '<li class="nodes active '.$show.'">'; }
                            else { echo '<li class="nodes '.$show.'">'; }

                            // Default icons
                            $icon = array('title' => _("This instance is currently not running either logstash or elasticsearch"),
                                          'icon' => "fa-circle-o");

                            // Check if it's been updated recently
                            if (time() - $n['_source']['last_updated'] > 60*5) {
                                $icon['title'] = _("This instance may not be running... It hasn't checked in for over 5 minutes.");
                            } else {
                                // Check if elasticsearch and logstasg is currently running
                                $ls_bool = ($n['_source']['logstash']['status'] == "running");
                                $es_bool = ($n['_source']['elasticsearch']['status'] == "running");
                                if ($ls_bool && $es_bool) {
                                    $icon['icon'] = "fa-circle";
                                    $icon['title'] = _("This instance is OK.");
                                } else if (!$es_bool) {
                                    $icon['icon'] = "fa-adjust";
                                    $icon['title'] = _("This instance is not running elasticsearch.");
                                } else if (!$ls_bool) {
                                    $icon['icon'] = "fa-adjust";
                                    $icon['title'] = _("This instance is not running logstash.");
                                }
                            }

                            // Add icon to html...
                            $icon['html'] = '<i class="fa '.$icon['icon'].'"></i>';
                            ?>
                            <a href="<?php echo site_url('configure/instance/'.$n['_id']); ?>" title="<?php echo _("Instance UUID") . ": " . $n['_id']; ?>">
                                <span class="config-editor-icon" title="<?php echo $icon['title']; ?>"><?php echo $icon['html']; ?></span>
                                <?php if ($_SERVER['SERVER_ADDR'] == $n['_source']['address']) { ?>
                                <span class="config-editor-icon" title="<?php echo _("This is the server you're currently logged into."); ?>"><i class="fa fa-asterisk"></i></span>
                                <?php } ?>
                                <?php echo $n['_source']['hostname']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="well"  style="padding: 10px 0; margin: 0;">
                <ul class="nav nav-list">
                    <li class="nav-header"><?php echo _("Reports"); ?></li>
                    <?php if ($tab == "audit") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/report#/dashboard/file/reports.json'); ?>"><i class="fa fa-files-o"></i> <?php echo _("Audit Reports"); ?></a></li>
                    <li class="nav-header"><?php echo _("System"); ?></li>
                    <?php if ($tab == "cluster") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/cluster'); ?>"><i class="fa fa-cogs"></i> <?php echo _("Cluster Status"); ?></a></li>
                    <?php if ($tab == "is_status") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/instance_status'); ?>"><i class="fa fa-cog"></i> <?php echo _("Instance Status"); ?></a></li>
                    <?php if ($tab == "in_status") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/index_status'); ?>"><i class="fa fa-database"></i> <?php echo _("Index Status"); ?></a></li>
                    <?php if ($tab == "backup") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/backup'); ?>"><i class="fa fa-hdd-o"></i> <?php echo _("Backup &amp; Maintenance"); ?></a></li>
                    <?php if ($tab == "system") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/system'); ?>"><i class="fa fa-flag"></i> <?php echo _("System Status"); ?></a></li>
                    <?php if ($tab == "subsystem") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/subsystem'); ?>"><i class="fa fa-cube"></i> <?php echo _("Command Subsystem"); ?></a></li>
                    <li class="nav-header"><?php echo _("General"); ?></li>
                    <?php if ($tab == "globals") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/globals'); ?>"><i class="fa fa-globe"></i> <?php echo _("Global Settings"); ?></a></li>
                    <?php if ($tab == "mail") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/mail'); ?>"><i class="fa fa-envelope"></i> <?php echo _("Mail Settings"); ?></a></li>
                    <?php if ($tab == "users") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/users'); ?>"><i class="fa fa-user"></i> <?php echo _("User Management"); ?></a></li>
                    <?php if ($tab == "auth") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/auth_servers'); ?>"><i class="fa fa-database"></i> <?php echo _('LDAP/AD Integration'); ?></a></li>
                    <!--<?php if ($tab == "wizards") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/wizards'); ?>"><i class="fa fa-magic"></i> <?php echo _("Wizard Management"); ?></a></li>-->
                    <li class="nav-header"><?php echo _("Licensing"); ?></li>
                    <?php if ($tab == "license") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('admin/license'); ?>"><i class="fa fa-unlock-alt"></i> <?php echo _("Update License"); ?></a></li>
                </ul>
            </div>
        </div>