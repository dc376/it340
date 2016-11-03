<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Linux File Source Setup'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/linux_files.png'); ?>" class="logo-small"><?php echo _("Linux File Setup"); ?></h2>
            <hr class="logo-divider">
            <div class="setup-container">
                <h4><?php echo _("Install Rsyslog"); ?></h4>
                <p style="margin:10px"><?php echo _("If you haven't already installed rsyslog follow the "); ?> <a href="<?php echo site_url('source-setup/linux'); ?>"><?php echo _("Linux Source Setup"); ?></a>. <?php echo _(" It is required to finish this setup."); ?></p>
            </div>
            <div class="setup-container">
                <div class="tabbable" style="margin-top:10px;">
                    <h4><?php echo _("Choose Configuration Method"); ?></h4>
                    <ul class="nav nav-tabs" style="padding-left:20px;">
                        <li class="active"><a href="#script" data-toggle="tab"><i class="fa fa-file-code-o" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Script"); ?></a></li>
                        <li><a href="#manual" data-toggle="tab"><i class="fa fa-terminal" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Manual"); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="script">
                            <h3><i class="fa fa-file-code-o" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Script Setup"); ?></h3>
                            <p></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("This is the script section of the setup, to run this setup manually navigate to the Manual setup tab above.  This may allow for more cusomization."); ?></p>
                            </div>
                            <p style="margin:10px"><?php echo _("Run the script below to automatically configure your syslog daemon."); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums"><?php echo $step2; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step2; ?></textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("You will need to replace the "); ?><b>/path/to/file</b><?php echo _(" to be the path to the file you are monitoring. Replace "); ?><b>FILE_TAG</b><?php echo _(" with a tag to identify logs from the file. It is used for the 'program' field in Log Server."); ?></p>
                        </div>
                        <div class="tab-pane" id="manual">
                            <h3><i class="fa fa-terminal" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Manual Setup"); ?></h3>
                            <p><h5 style="margin:10px"><?php echo _("To configure the syslog daemon manually follow the directions below."); ?></h5></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("If you already completed the Script setup then this section is not necessary.  This will allow for better configuration such as custom log message template for example."); ?></p>
                            </div>
                            <p style="margin:10px"><?php echo _("Put the following in your terminal window to verify the rsyslog spool directory and that the rsyslog.d folder exists.  The second line will give you the path you will need to add in the next section for \$WorkDirectory in the configuration. Then it will open the rsyslog.conf file."); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums"><?php echo $step3; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step3; ?></textarea>
                                </div>
                            </div>
                            <br>
                            <h4><?php echo _("Setup the Rsyslog Configuration File"); ?></h4>
                            <p style="margin:10px"><?php echo _("Add the following to the configuration file you just opened.  Look for the 'begin forwarding rule.'"); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums"><?php echo $step4; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step4; ?></textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("Replace each variable "); ?><b>FILE_PATH</b><?php echo _(" with the unique file name you want to monitor and each "); ?><b>FILE_TAG</b><?php echo _(" with an application name or nickname for the file."); ?></p>
                            <div style="margin:10px;padding-left:25px;">
                                <p><i><?php echo _("Replace the following above: "); ?></i></p>
                                <p><?php echo _("FILE_PATH:  The absolute path to the file itself."); ?></p>
                                <p><?php echo _("FILE_TAG:  A tag to identify logs from the file. It is used for the 'program' field in Log Server."); ?></p>
                                <p><?php echo _("FILE_ID:  An identifier for this file. This must be unique on the host. Spaces are not allowed."); ?></p>
                            </div>
                            <p style="margin:10px"><?php echo _("You will also need to replace "); ?><b>$WorkDirectory</b><?php echo _(" with the unique file path of the rsyslog spool directory.  This was displayed from the command on line 2 of the previous codeblock.  If this isn't set correctly the rsyslog service will error on restart."); ?></p>
                            <p style="margin:10px"><?php echo _("Example:  \$WorkDirectory /var/lib/rsyslog"); ?></p>
                        </div>
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
                        <a href="<?php echo site_url('source-setup/linux'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_LinuxNB.png'); ?>" class="logo-small"><p><?php echo _("Linux Setup"); ?></p></a>
                    </div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/apache'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_ApacheNB.png'); ?>" class="logo-small"><p><?php echo _("Apache Setup"); ?></p></a>
                    </div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/mysql'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MYSQLNB.png'); ?>" class="logo-small"><p><?php echo _("MySQL Setup"); ?></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>
