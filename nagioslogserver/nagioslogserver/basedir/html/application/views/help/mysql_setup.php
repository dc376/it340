<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a><span class="divider">/</span></li><li class="active"><?php echo _('MySQL Source Setup'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MYSQLNB.png'); ?>" class="logo-small"><?php echo _("MySQL Setup"); ?></h2>
            <span class="logo-divider"><hr class="logo-divider"></span>
            <div class="setup-container">
                <h4><?php echo _("Install Rsyslog"); ?></h4>
                <p style="margin:10px"><?php echo _("If you haven't already installed rsyslog follow the "); ?> <a href="<?php echo site_url('source-setup/linux'); ?>"><?php echo _("Linux Source Setup"); ?></a>. <?php echo _(" It is required to finish this setup."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Setup Nagios Log Server Filter"); ?></h4>
                <p style="margin:10px"><?php echo _("Copy the filters below and paste it into the Filter field of the Global Configuration section"); ?><?php if ($is_admin): ?> <a href="<?php echo site_url('configure/instance/global'); ?>"><b><?php echo _("Located Here"); ?></b></a><?php endif; ?>.<?php echo _(" Make sure to add it into the Filter field, Verify the filter, Save and then Apply.  This will allow Nagios Log Server to match the mysql message contents and replace the log type with mysql_log."); ?></p>
                <div id="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code id="code" class="prettyprint linenums"><?php echo $step1; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step1; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="setup-container">
                <div class="tabbable" style="margin-top:10px;">
                    <h4><?php echo _("Choose Configuration Method"); ?></h4>
                    <ul class="nav nav-tabs" style="padding-left:20px;">
                        <li class="active"><a href="#script" data-toggle="tab"><i class="fa fa-file-code-o" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Script"); ?></a></li>
                        <li><a href="#manualfile" data-toggle="tab"><i class="fa fa-terminal" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Manual (File)"); ?></a></li>
                        <li><a href="#manualsyslog" data-toggle="tab"><i class="fa fa-terminal" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Manual (Syslog)"); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="script">
                            <h3><i class="fa fa-file-code-o" style="margin-right:5px;color:#4d89f9;"></i><?php echo _("Script Setup"); ?></h3>
                            <p></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("This is the script section of the setup, to run this setup manually navigate to the Manual setup tab above.  This may allow for more customization."); ?></p>
                            </div>              
                            <p style="margin:10px"><?php echo _("Run the script below to automatically configure your syslog daemon to send MySQL log files to Nagios Log Server."); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums"><?php echo $step2; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step2; ?></textarea>
                                </div>
                            </div>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("The file path for the mysqld.log file may depend on your Linux distribution. This example was done using CentOS 6.5 so you may need to verify the location of your mysql log file."); ?></p>
                            </div>   
                        </div>
                        <div class="tab-pane" id="manualfile">
                            <h3><i class="fa fa-terminal" style="margin-right:5px;color:#4d89f9;"></i><?php echo _("Manual Setup - File"); ?></h3>
                            <p><h5 style="margin:10px"><?php echo _("To configure the syslog daemon manually follow the directions below."); ?></h5></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("If you already completed the Script setup then this section is not necessary.  This will allow for better configuration such as custom log message template for example."); ?></p>
                            </div>
                            <p style="margin:10px"><?php echo _("Put the following in your terminal window to verify the rsyslog spool directory and that the rsyslog.d folder exists.  The second line will give you the path you will need to add in the next section for \$WorkDirectory in the configuration. Then it will open the rsyslog.conf file."); ?></p>
                            <div class="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code class="prettyprint linenums"><?php echo $step3; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step3; ?></textarea>
                                </div>
                            </div>
                            <br>
                            <h4><?php echo _("Setup the Rsyslog Configuration File"); ?></h4>
                            <p style="margin:10px"><?php echo _("Add the following to the configuration file you just opened.  Look for the 'begin forwarding rule.'"); ?></p>                                          
                            <div class="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code class="prettyprint linenums"><?php echo $step4; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step4; ?></textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("You will also need to replace "); ?><b>$WorkDirectory</b><?php echo _(" with the unique file path of the rsyslog spool directory.  This was displayed from the command on line 2 of the previous codeblock.  If this isn't set correctly the rsyslog service will error on restart."); ?></p>
                            <p style="margin:10px"><?php echo _("Example:  \$WorkDirectory /var/lib/rsyslog"); ?></p>
                        </div>
                        <div class="tab-pane" id="manualsyslog">
                            <h3><i class="fa fa-terminal" style="margin-right:5px;color:#4d89f9;"></i><?php echo _("Manual Setup - Syslog"); ?></h3>
                            <p><h5 style="margin:10px"><?php echo _("To configure the syslog daemon manually follow the directions below."); ?></h5></p>
                            <p style="margin:10px"><?php echo _("First we need to tell MySQL to send logs through syslog.  All you will need to do is simply add the following line into the mysqld in the init.d folder."); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums">vi /etc/init.d/mysqld</code>
                                    <textarea class="copy-target" style="display:none">vi /etc/init.d/mysqld</textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("This may be different for non-RHEL distributions of Linux, but once you find the path to the file the configuration is the same.  Add the --syslog and --log-error flags into the \$exec command.  In this example it is on line 127.  Put this between the socket file and pid settings."); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums"><?php echo $step5; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step5; ?></textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("It should look like the configuration below:"); ?></p>
                            <img src="<?php echo base_url('media/images/mysqld_conf.png'); ?>" style="margin-left:15px;">
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
                <p><?php echo _("Continue to set up other sources for your Nagios Log Server with the guides below."); ?></p>
                <div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/linux-files'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/linux_files.png'); ?>" class="logo-small"><?php echo _("Linux Files"); ?></a>
                    </div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/apache'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_ApacheNB.png'); ?>" class="logo-small"><?php echo _("Apache Setup"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>