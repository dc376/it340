<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a><span class="divider">/</span></li><li class="active"><?php echo _('PHP Source Setup'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/Log_server_Logos_PHPNB.png'); ?>" class="logo-small"><?php echo _("PHP Setup"); ?></h2>
            <span class="logo-divider"><hr class="logo-divider"></span>
            <div class="setup-container">
                <h4><?php echo _("Configure PHP"); ?></h4>
                <p style="margin:10px"><?php echo _("First, we will be using the PHP configuration file on the server you want to send log data from to perform the setup sections below.  Depending on the version of PHP your server is running the "); ?><b>php.ini</b><?php echo _(" file that we will need to edit may be in different locations.  For this example we are using PHP v5.3.3. To find the php configuration file on your server run this command:"); ?></p>
                <div id="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy to clipboard"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code id="code" class="prettyprint linenums">php --ini</code>
                        <textarea class="copy-target" style="display:none">php --ini</textarea>
                    </div>
                </div>
                <p style="margin:10px"><?php echo _("You should see output similar to the following:"); ?></p>
                <div id="code-tooltip">
                    <div style="position:relative;">
                        <code id="code" class="prettyprint linenums">Configuration File (php.ini) Path: /etc
Loaded Configuration File:         /etc/php.ini
Scan for additional .ini files in: /etc/php.d
Additional .ini files parsed:      /etc/php.d/curl.ini,
/etc/php.d/fileinfo.ini,
/etc/php.d/json.ini,
/etc/php.d/phar.ini,
/etc/php.d/zip.ini</code>
                        <textarea class="copy-target" style="display:none">Configuration File (php.ini) Path: /etc
Loaded Configuration File:         /etc/php.ini
Scan for additional .ini files in: /etc/php.d
Additional .ini files parsed:      /etc/php.d/curl.ini,
/etc/php.d/fileinfo.ini,
/etc/php.d/json.ini,
/etc/php.d/phar.ini,
/etc/php.d/zip.ini</textarea>
                    </div>
                </div>
                <p style="margin:10px"><?php echo _("We are looking for the "); ?><b><?php echo _("Loaded Configuration File"); ?></b><?php echo _(" line that shows the configuration file path that is being used by PHP.  This is the file that we will use for the setup sections below."); ?></p>
            </div>
            <div class="setup-container">
                <div class="tabbable" style="margin-top:10px;">
                    <h4><?php echo _("Choose Configuration Method"); ?></h4>
                    <ul class="nav nav-tabs" style="padding-left:20px;">
                        <li class="active"><a href="#syslog" data-toggle="tab"><i class="fa fa-sitemap" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Syslog"); ?></a></li>
                        <li><a href="#script" data-toggle="tab"><i class="fa fa-file-code-o" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Script"); ?></a></li>
                        <li><a href="#manualfile" data-toggle="tab"><i class="fa fa-terminal" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Manual"); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="syslog">
                            <h3><i class="fa fa-sitemap" style="margin-right:10px;color:#4d89f9;"></i><?php echo _("Syslog Setup"); ?></h3>
                            <p></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("You will need the location of the PHP configuration file in the last sections for this setup.  This is the syslog section of the setup, to run this setup manually or using the script navigate through the setup tabs above.  This may allow for more customization."); ?></p>
                            </div>
                            <p style="margin:10px"><?php echo _("To configure your syslog daemon to send PHP log files to Nagios Log Server we will need to edit the php.ini file so that it sends PHP logs through syslog."); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy to clipboard"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums">vi /etc/php.ini</code>
                                    <textarea class="copy-target" style="display:none">vi /etc/php.ini</textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("Find the line that has the "); ?><b>;error_log = syslog</b><?php echo _(" which will be commented out.  Uncomment this line to have php logs send through syslog.  With this version of PHP our configuration file looks like this after being edited: "); ?></p>
                            <center><img src="<?php echo base_url('media/images/php_configure_syslog.png'); ?>" style="margin-left:15px;"></center>
                            <p style="margin:10px"><?php echo _("Now syslog will handle all your PHP logs and send them through syslog.  Once syslog is configured to send to Nagios Log Server this is all that is needed to receive logs.  The syslog setup is located  "); ?><a href="<?php echo site_url('source-setup/linux'); ?>"><?php echo _("here"); ?>.</a></p>
                        </div>
                        <div class="tab-pane" id="script">
                            <h3><i class="fa fa-file-code-o" style="margin-right:10px;color:#4d89f9;"></i><?php echo _("Script Setup"); ?></h3>
                            <p></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i><?php echo _("This is the script section of the setup, to run this setup manually navigate to the Manual setup tab above.  This may allow for more customization."); ?></p>
                            </div>
                            <h4><?php echo _("Create New PHP Log File"); ?></h4>
                            <p style="margin:10px"><?php echo _("First we are going to make a file called "); ?><b>php.log</b><?php echo _(" for this example. Then PHP will write logs to this file: "); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums">touch /var/log/php.log</code>
                                    <textarea class="copy-target" style="display:none">touch /var/log/php.log</textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("To run the script below to automatically configure your syslog daemon to send PHP log files to Nagios Log Server we will need to edit the php.ini file so that it sends PHP logs to the file we will monitor in log server: "); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums">vi /etc/php.ini</code>
                                    <textarea class="copy-target" style="display:none">vi /etc/php.ini</textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("Find the line that has the "); ?><b>;error_log = syslog</b><?php echo _(" which will be commented out.  We will replace this with the file we will use in the setup script.  Make sure to use the absolute path when editing the php.ini file.  With this version of PHP our configuration file looks like this after being edited: "); ?></p>
                            <center><img src="<?php echo base_url('media/images/php_configure_script.png'); ?>" style="margin-left:15px;"></center>
                            <br>
                            <h4><?php echo _("Configure Setup Script"); ?></h4>
                            <p style="margin:10px"><?php echo _("Now that there is a new independant log file for PHP and php is configured to send logs to the file we can use our Linux Setup script to look at the new file and send logs to Nagios Log Server."); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums"><?php echo $step1; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step1; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="manualfile">
                            <h3><i class="fa fa-terminal" style="margin-right:10px;color:#4d89f9;"></i><?php echo _("Manual Setup"); ?></h3>
                            <p><h5 style="margin:10px"><?php echo _("To configure the syslog daemon manually follow the directions below."); ?></h5></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("You will need the location of the PHP configuration file in the last section for this setup. If you already completed the Syslog or Script setup then this section is not necessary.  This will allow for better configuration such as custom log message templates for example."); ?></p>
                            </div>
                            <h4><?php echo _("Create New PHP Log File"); ?></h4>
                            <p style="margin:10px"><?php echo _("First we are going to make a file called "); ?><b>php.log</b><?php echo _(" for this example. Then PHP will write logs to this file: "); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy to clipboard"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums">touch /var/log/php.log</code>
                                    <textarea class="copy-target" style="display:none">touch /var/log/php.log</textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("To manually configure your syslog daemon to send PHP log files to Nagios Log Server we will need to edit the php.ini file so that it sends PHP logs to the file we will monitor in log server: "); ?></p>
                            <div id="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="select-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code id="code" class="prettyprint linenums">vi /etc/php.ini</code>
                                    <textarea class="copy-target" style="display:none">vi /etc/php.ini</textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("Find the line that has the "); ?><b>;error_log = syslog</b><?php echo _(" which will be commented out.  We will replace this with the file we will use in the setup script.  Make sure to use the absolute path when editing the php.ini file.  With this version of PHP our configuration file looks like this after being edited: "); ?></p>
                            <center><img src="<?php echo base_url('media/images/php_configure_script.png'); ?>" style="margin-left:15px;"></center>
                            <br>
                            <h4><?php echo _("Setup the Rsyslog Configuration File"); ?></h4>
                            <p style="margin:10px"><?php echo _("Put the following in your terminal window to verify the rsyslog spool directory and that the rsyslog.d folder exists.  The second line will give you the path you will need to add in the next section for \$WorkDirectory in the configuration. Then it will open the rsyslog.conf file."); ?></p>
                            <div class="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code class="prettyprint linenums"><?php echo $step2; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step2; ?></textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("Add the following to the configuration file you just opened.  Look for the 'begin forwarding rule.'"); ?></p>
                            <div class="code-tooltip">
                                <div style="position:relative;">
                                    <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                    <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                                    <code class="prettyprint linenums"><?php echo $step3; ?></code>
                                    <textarea class="copy-target" style="display:none"><?php echo $step3; ?></textarea>
                                </div>
                            </div>
                            <p style="margin:10px"><?php echo _("You will need to replace "); ?><b>$WorkDirectory</b><?php echo _(" with the unique file path of the rsyslog spool directory.  This was displayed from the command on line 2 of the previous codeblock.  If this isn't set correctly the rsyslog service will error on restart."); ?></p>
                            <p style="margin:10px"><?php echo _("Example:  \$WorkDirectory /var/lib/rsyslog"); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Log Verification"); ?></h4>
                <p style="margin:10px"><?php echo _("To Verify that you are receiving logs after you have configured this source go the the "); ?><a href="<?php echo site_url('dashboard#'); ?>"><?php echo _("Dashboard"); ?></a><?php echo _(" page.  You should see logs displayed in the graph and log table."); ?></p>
            </div>
            <div class="setup-container">
                <h4><?php echo _("Set Up More Sources "); ?></h4>
                <p><?php echo _("Continue to set up other sources for your Nagios Log Server with the guides below."); ?></p>
                <div>
                    <div class="quick-link-icon">
                        <a href="<?php echo site_url('source-setup/linux'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/linux_files.png'); ?>" class="logo-small"><?php echo _("Linux Files"); ?></a>
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