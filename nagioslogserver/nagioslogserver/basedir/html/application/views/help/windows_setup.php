<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Windows Source Setup'); ?></li>
</ul>

<div class="container">
	<div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/Log_server_Logos_WindowsNB.png'); ?>" class="logo-small"><?php echo _("Windows Setup"); ?></h2>
            <hr class="logo-divider">
            <div class="setup-container">
                <h4><?php echo _("Install Nxlog"); ?></h4>
                <p style="margin:10px"><?php echo _("We recommend using Nxlog to send Windows Event log data to Nagios Log Server.  You can download "); ?><a href="<?php echo base_url('scripts/nxlog-ce-latest.msi'); ?>"><?php echo _("Nxlog here"); ?>.</a></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Configure Windows Event Logs using Nxlog"); ?></h4>
                <p style="margin:10px"><?php echo _("Save the entire contents below to your nxlog.conf file usually located in C:\Program Files (x86)\\nxlog\conf\\nxlog.conf"); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="code prettyprint linenums"><?php echo $step2; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step2; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Start the Nxlog Service"); ?></h4>
                <p style="margin:10px"><?php echo _("The Nxlog service must be started to start sending the eventlog data."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="code prettyprint linenums">net start nxlog</code>
                        <textarea class="copy-target" style="display:none">net start nxlog</textarea>
                    </div>
                </div>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Log Verification"); ?></h4>
                <p style="margin:10px"><?php echo _("To Verify that you are receiving logs after you have configured this source go the the "); ?><a href="<?php echo site_url('dashboard'); ?>"><?php echo _("Dashboard"); ?></a><?php echo _(" page.  You should see logs displayed in the graph and log table."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Set Up More Sources "); ?></h4>
                <p style="margin:10px"><?php echo _("Continue to set up other sources for your Nagios Log Server with the guides below."); ?></p>
                <div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/windows-files'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_WindowsNB.png'); ?>" class="logo-small"><p><?php echo _("Windows Files"); ?></p></a>
                    </div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/mssql'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MSSQLNB.png'); ?>" class="logo-small"><p><?php echo _("MS SQL Setup"); ?></p></a>
                    </div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/network'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_NetworkDeviceNB.png'); ?>" class="logo-small"><p><?php echo _("Network Device"); ?></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>