<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a><span class="divider">/</span></li><li class="active"><?php echo _('MS SQL Source Setup'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MSSQLNB.png'); ?>" class="logo-small"><?php echo _("MS SQL Setup"); ?></h2>
            <hr class="logo-divider">
            <div class="setup-container">
                <h4><?php echo _("Install Nxlog"); ?></h4>
                <p style="margin:10px"><?php echo _("If you haven't already installed Nxlog follow the "); ?><a href="<?php echo site_url('source-setup/windows'); ?>" target="_new"><?php echo _("Windows Source Setup"); ?></a>.</p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("You're Done!"); ?></h4>
                <p style="margin:10px"><?php echo _("MSSQL logs will automatically be sent through Windows event logs.  Follow the configuration in the Windows Source Setup above and verify you are receiving logs."); ?> </p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Log Verification"); ?></h4>
                <p style="margin:10px"><?php echo _("To Verify that you are receiving logs after you have configured this source go the the "); ?><a href="<?php echo site_url('dashboard'); ?>" target="_new"><?php echo _("Dashboard"); ?></a><?php echo _(" page.  You should see logs displayed in the graph and log table."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Set Up More Sources "); ?></h4>
                <p style="margin:10px"><?php echo _("Continue to set up other sources for your Nagios Log Server with the guides below."); ?></p>
                <div class="row-fluid">
                    <div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/windows-files'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/windows_files.png'); ?>" class="logo-small"><?php echo _("Windows Files"); ?></a>
                        </div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/mysql'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MYSQLNB.png'); ?>" class="logo-small"><?php echo _("MySQL Setup"); ?></a>
                        </div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/IIS'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_IISNB.png'); ?>" class="logo-small"><?php echo _("IIS Setup"); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>