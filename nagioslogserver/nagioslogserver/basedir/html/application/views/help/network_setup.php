<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('source-setup'); ?>"><?php echo _('Add a Log Source'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Network Device Source Setup'); ?></li>
</ul>

<div class="container">
    <div class="source-setup-container">
        <div class="logo-container">
            <h2><img src="<?php echo base_url('media/images/logos/Log_server_Logos_NetworkDeviceNB.png'); ?>" class="logo-small"><?php echo _("Network Device Setup"); ?></h2>
            <hr class="logo-divider">
            <div class="setup-container">
                <div class="tabbable" style="margin-top:10px;">
                    <h4><?php echo _("Choose A Network Device"); ?></h4>
                    <ul class="nav nav-tabs" style="padding-left:20px;">
                        <li class="active"><a href="#generic" data-toggle="tab"><i class="fa fa-sitemap" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Generic Device"); ?></a></li>
                        <li><a href="#juniper" data-toggle="tab"><i class="fa fa-sitemap" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Juniper Device"); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="generic">
                            <h3><i class="fa fa-sitemap" style="color:#4d89f9;margin-right:6px;"></i><?php echo _("Generic Network Device"); ?></h3>
                            <p></p>
                            <div class="alert alert-info" style="margin-left:10px;">
                                <p><i class="icon-exclamation-sign icon-white"></i>  <?php echo _("This tab is designed for generic network device setup.  If you are having trouble with this setup try the other types of network devices."); ?></p>
                            </div>
                            <p style="margin:10px"><?php echo _("Configure your network device to send log data to your Nagios Log Server. Go to your network device User Interface.  Login into the User Interface and find the event or system logging section.  Once there all you will need to set it the IP address and the Port that the generated log files should be sent to.  Some configurations require you to turn event or system logging on."); ?></p>
                            <p style="margin:10px"><?php echo _("Below is the information needed for this server:"); ?></p>
                        </div>
                        <div class="tab-pane" id="juniper">
                            <h3><i class="fa fa-sitemap" style="color:#4d89f9;margin-right:6px;"></i><?php echo _("Juniper Network Device"); ?></h3>
                            <p><h5 style="margin:10px"><?php echo _("Example setup for a Juniper Network Device."); ?></h5></p>
                            <p style="margin:10px"><?php echo _("Configure your network device to send log data to your Nagios Log Server.  Go to your network device User Interface.  Our example is using a Juniper routing device that has a section for reporting with syslog.  This will be similar to most devices, but may have a different name.  Once you "); ?></p>
                            <p style="margin:10px"><?php echo _("Here is what the configuration looks like for a Juniper device.  We select the checkbox to enable syslog messages, set the IP/ Hostname and Port that the logs will be sent to."); ?></p>
                            <center><img src="<?php echo base_url('media/images/net_device_syslog.png'); ?>"></center>
                            <p style="margin:10px"><?php echo _("Make sure to replace the IP address field with the Nagios Log Server IP address and the port it uses for receiving logs.  Below is the information needed for this server:"); ?></p>
                        </div>
                    </div>
                </div>
                <div class="setup-container">
                    <h4><?php echo _("My Server Information:"); ?></h4>
                    <p style="margin:10px"><?php echo _("Nagios Log Server IP:  "); ?><b><?php echo $step1; ?></b></p>
                    <p style="margin:10px"><?php echo _("Nagios Log Server Port (TCP/UDP):  "); ?><b><?php echo $step2; ?></b></p>
                </div>
                <p style="margin:10px"><?php echo _("Once you configure your specific router be sure to Apply and Save the new logging settings."); ?></p>
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
                            <a href="<?php echo site_url('source-setup/linux-files'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/linux_files.png'); ?>" class="logo-small"><p><?php echo _("Linux Files"); ?></p></a>
                        </div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/windows-files'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/windows_files.png'); ?>" class="logo-small"><p><?php echo _("Windows Files"); ?></p></a>
                        </div>
                        <div class="quick-link-icon">
                            <a href="<?php echo site_url('source-setup/mssql'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MSSQLNB.png'); ?>" class="logo-small"><p><?php echo _("MS SQL Setup"); ?></p></a>
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