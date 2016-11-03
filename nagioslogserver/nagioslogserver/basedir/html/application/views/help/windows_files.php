<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Windows Files Source Setup'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/windows_files.png'); ?>" class="logo-small"><?php echo _("Windows Files Setup"); ?></h2>
            <p>
            <hr class="logo-divider">
            <div class="setup-container">
                <h4><?php echo _("Install Nxlog"); ?></h4>
                <p style="margin:10px"><?php echo _("If you haven't already installed Nxlog follow the "); ?> <a href="<?php echo site_url('source-setup/windows'); ?>"><?php echo _("Windows Source Setup"); ?></a>.</p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Monitor a Windows File"); ?></h4>
                <p style="margin:10px"><?php echo _("You can monitor a specific Windows file using Nagios Log Server. Copy the following Input and add it into the nxlog.conf file on the host where the file is located.  This is usually located in C:\Program Files (x86)\\nxlog\conf\\nxlog.conf.  You can have multiple inputs, but be sure they are all included in the route section which is covered in the next section"); ?></p>
                <div id="tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy to clipboard"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code id="code" class="prettyprint linenums"><?php echo $step2; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step2; ?></textarea>
                    </div>
                </div>
                <p style="margin:10px"><?php echo _("You will need to rename "); ?><b>windowsfile</b><?php echo _(" to the name of the file you desire to monitor.  This must be unique."); ?></p>
                <p style="margin:10px"><?php echo _("You will need to rename "); ?><b>'C:\path\to\target\file'</b><?php echo _(" to the path of the file you desire to monitor.  They must be inside single quotes."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Send the File to Nagios Log Server"); ?></h4>
                <p style="margin:10px"><?php echo _("While adding the Input and filename of the file you are monitoring you will need to add to the route section in the configuration right under the input section above."); ?></p>
                <div id="tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code id="code" class="prettyprint linenums"><?php echo $step3; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step3; ?></textarea>
                    </div>
                </div>
                <p style="margin:10px"><?php echo _("Again, You will need to rename "); ?><b>windowsfile</b><?php echo _(" to the name of the file you desire to monitor."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Log Verification"); ?></h4>
                <p style="margin:10px"><?php echo _("To Verify that you are receiving logs after you have configured this source go the the "); ?><a href="<?php echo site_url('dashboard'); ?>"><?php echo _("Dashboard"); ?></a><?php echo _(" page.  You should see logs displayed in the graph and log table."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Set Up More Sources"); ?></h4>
                <p style="margin:10px"><?php echo _("Continue to set up other sources for your Nagios Log Server with the guides below."); ?></p>
                <div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/windows'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_WindowsNB.png'); ?>" class="logo-small"><p><?php echo _("Windows Setup"); ?></p></a>
                    </div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/mssql'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MSSQLNB.png'); ?>" class="logo-small"><p><?php echo _("MS SQL Setup"); ?></p></a>
                    </div>
                    <div class="quick-link-icon">                                       
                        <a href="<?php echo site_url('source-setup/IIS'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_IISNB.png'); ?>" class="logo-small"><p><?php echo _("IIS Server Setup"); ?></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>