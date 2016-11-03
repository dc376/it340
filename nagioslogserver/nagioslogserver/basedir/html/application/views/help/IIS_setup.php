<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a><span class="divider">/</span></li><li class="active"><?php echo _('IIS Source Setup'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/Log_server_Logos_IISNB.png'); ?>" class="logo-small"><?php echo _("IIS Web Server Setup"); ?></h2>
            <hr class="logo-divider">
            <div class="setup-container">
                <h4><?php echo _("Install Nxlog"); ?></h4>
                <p style="margin:10px"><?php echo _("If you haven't already installed Nxlog follow the "); ?> <a href="<?php echo site_url('source-setup/windows'); ?>"><?php echo _("Windows Source Setup"); ?></a>.</p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Monitor Your IIS Web Server Logs"); ?></h4>
                <p style="margin:10px"><?php echo _("You can monitor a specific IIS Web Server log file by adding a new input field into your nxlog configuration file, usually in C:\Program Files (x86)\\nxlog\conf\\nxlog.conf"); ?></p>
                <div id="tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="<?php echo _("Selected!"); ?>"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy to clipboard"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="<?php echo _("Copied!"); ?>"></a><?php echo _("Copy"); ?></button>
                        <code id="code" class="prettyprint linenums"><?php echo $step2; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step2; ?></textarea>
                    </div>
                </div>
                <p style="margin:10px"><?php echo _("You will need to rename "); ?><b>iis_log1</b><?php echo _(" to the name of the file you desire to monitor.  This must be unique."); ?></p>
                <p style="margin:10px"><?php echo _("You will also need to specify the path of the IIS file you desire to monitor.  Add this path to " ); ?><b><?php echo _("File"); ?></b><?php echo _(" inside of single quotes just like the above example.  This will be unique to your IIS web server setup."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Send the Log Data to Nagios Log Server"); ?></h4>
                <p style="margin:10px"><?php echo _("Once you add the Input you will need to add to the route section for the input we just added which will pass the log data to Nagios Log Server."); ?></p>
                <div id="tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="<?php echo _("Selected!"); ?>"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="<?php echo _("Copied!"); ?>"></a><?php echo _("Copy"); ?></button>
                        <code id="code" class="prettyprint linenums"><?php echo $step3; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step3; ?></textarea>
                    </div>
                </div>
                <p style="margin:10px"><?php echo _("Again, You will need to rename "); ?><b>iis_log1</b><?php echo _(" to the name of the file you desire to monitor."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Log Verification"); ?></h4>
                <p style="margin:10px"><?php echo _("To Verify that you are receiving logs after you have configured this source go the the "); ?><a href="<?php echo site_url('dashboard'); ?>"><?php echo _("Dashboard"); ?></a><?php echo _(" page.  You should see logs displayed in the graph and log table."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Set Up More Sources"); ?></h4>
                <p style="margin:10px"><?php echo _("Continue to set up other sources for your Nagios Log Server with the guides below."); ?></p>
                <div class="row-fluid">
                    <div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/windows'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_WindowsNB.png'); ?>" class="logo-small"><?php echo _("Windows Setup"); ?></a>
                        </div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/mssql'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MSSQLNB.png'); ?>" class="logo-small"><?php echo _("MS SQL Setup"); ?></a>
                        </div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/network'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_NetworkDeviceNB.png'); ?>" class="logo-small"><?php echo _("Network Device"); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>