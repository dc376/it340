<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Import From File'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/import_files.png'); ?>" class="logo-small"><?php echo _("Import From File"); ?></h2>
            <span class="logo-divider"><hr class="logo-divider"></span>

            <div class="setup-container">
                <h4><?php echo _("Log Server Inputs"); ?></h4>
                <p><?php echo _("Log Server ships with two inputs in its Global Configuration intended for accepting imports: one for raw log lines coming in on TCP port 2056; and one for JSON messages on port 2057."); if ($import_input_available) { echo " <strong>"._("These inputs are set up by default with a new install of Log Server.")."</strong>"; } ?></p>
                <?php if (!$import_input_available) { ?>
                <p><?php echo _("<strong>It doesn't look like you have the inputs set up.</strong> Setting the type and adding a tag makes it easier to filter and process the messages later."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step1; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step1; ?></textarea>
                    </div>
                </div>
                <p><?php echo _("Make sure the ports are open on your Log Server."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step2; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step2; ?></textarea>
                    </div>
                </div>
                <p><?php echo _("The exact firewall rules will depend on your organization's policies and firewall."); ?></p>
                <?php } ?>
            </div>

            <div class="setup-container">
                <h4><?php echo _("Utility Script"); ?></h4>
                <p><?php echo _("Log Server includes a shipper.py script that reads log lines and writes out JSON messages for import into Log Server. Download the script from your Log Server with the following command."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step3; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step3; ?></textarea>
                    </div>
                </div>
                <p><?php echo _("The following command examples make use of netcat. This program might not be installed on some systems. To install this on RPM-based systems:"); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step3_nc_yum; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step3_nc_yum; ?></textarea>
                    </div>
                </div>
                <p><?php echo _("On Ubuntu and Debian-based systems:"); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step3_nc_apt; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step3_nc_apt; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="setup-container">
                <h4><?php echo _("Ship Log Files"); ?></h4>
                <p><?php echo _("shipper.py will read log lines from stdin if no file selection arguments are given. Data can be added to the JSON for use in filtering messages by passing 'field:value' arguments after any file selection arguments. Setting 'program:apache_access' for an archived Apache access_log will match the default Apache filter in Log Server, and the log messages will be parsed like a live log event. Piping the JSON messages shipper.py writes to netcat will send them to Log Server."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step4; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step4; ?></textarea>
                    </div>
                </div>
                <p><?php echo _("shipper.py can also read files by name, or matching a shell glob pattern. Plain text and gzip or bzip2 compressed files are supported. This command will send all log lines in multiple gzipped access_log files."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step5; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step5; ?></textarea>
                    </div>
                </div>
                <p><?php echo _("shipper.py can also scan a directory recursively, processing only files that match a pattern. This command will send all log lines in gzipped access_log archives in /var/log/archive and its subdirectories."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step6; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step6; ?></textarea>
                    </div>
                </div>
                <p><?php echo _("Zip and tar (raw, and gzip or bzip2 compressed) archives are also supported. This command will send all log lines in access_log archives in archive.tar.bz2."); ?></p>
                <div class="code-tooltip">
                    <div style="position:relative;">
                        <button class="select-button" data-toggle="tooltip" title="Select all"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                        <button class="copy-button" data-toggle="tooltip" title="Copy to clipboard" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
                        <code class="prettyprint linenums"><?php echo $step7; ?></code>
                        <textarea class="copy-target" style="display:none"><?php echo $step7; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="setup-container">
                <h4><?php echo _("Log Verification"); ?></h4>
                <p style="margin:10px"><?php echo _("To Verify that you are receiving logs after you have configured this source go the the "); ?><a href="<?php echo site_url('dashboard'); ?>"><?php echo _("Dashboard"); ?></a><?php echo _(" page. You should see logs displayed in the graph and log table."); ?></p>
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