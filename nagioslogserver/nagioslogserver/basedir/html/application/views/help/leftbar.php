        <div class="lside config-editor-side">
            <div class="well">
                <ul class="nav nav-list">
                    <!-- Setup -->
                    <li class="nav-header"><?php echo _("Log Sources"); ?></li>
                    <li><a href="<?php echo site_url('source-setup'); ?>"><i class="fa fa-share"></i> <?php echo _("Add a Log Source"); ?></a></li>

                    
                    <!-- check for administrator priveleges-->
                    <?php if ($is_admin == true) { ?>
                    <li class="nav-header"><?php echo _("Administration"); ?></li>
                        <?php if ($tab == "admin") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="https://assets.nagios.com/downloads/nagios-log-server/guides/administrator/" target="_new"><?php echo _("Administration Guide"); ?></a></li>
                    <?php } ?>

                    <!-- Resources -->
                    <li class="nav-header"><?php echo _("Helpful Resources"); ?></li>
                    <?php if ($tab == "forum") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="https://support.nagios.com/forum/" target="_new"><?php echo _("Nagios Support Forum"); ?></a></li>
                    <?php if ($tab == "wiki") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="https://support.nagios.com/wiki/" target="_new"><?php echo _("Nagios Support Wiki"); ?></a></li>
                    <?php if ($tab == "library") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="https://library.nagios.com" target="_new"><?php echo _("Nagios Library"); ?></a></li>
                </ul>
            </div>
        </div>