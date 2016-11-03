<?php echo $header; ?>

<ul class="breadcrumb">
    <li class="active"><?php echo _('Add a Log Source'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="logo-container">
                            <h2><?php echo _("Log Source Setup"); ?><i class="fa fa-sitemap" style="color:#4d89f9;margin-left:10px;"></i></h2>
                            <hr class="logo-divider">
                            <div class="css-table">
                                <div class="row-block">
                                  <a href="<?php echo site_url('source-setup/linux'); ?>" class="logo-atom">
                                    <div class="logo-container-inner">
                                        <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_LinuxNB.png'); ?>" class="logo-small"><?php echo _("Linux"); ?></h4>
                                        <p><?php echo _("Send Linux syslogs to Nagios Log Server."); ?></p>
                                    </div>
                                  </a>
                                  <a href="<?php echo site_url('source-setup/windows'); ?>" class="logo-atom">
                                    <div class="logo-container-inner">
                                        <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_WindowsNB.png'); ?>" class="logo-small"><?php echo _("Windows"); ?></h4>
                                        <p><?php echo _("Send Windows eventlogs to Nagios Log Server"); ?></p>
                                    </div>
                                  </a>
                                  <a href="<?php echo site_url('source-setup/network'); ?>" class="logo-atom">
                                    <div class="logo-container-inner">
                                        <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_NetworkDeviceNB.png'); ?>" class="logo-small"><?php echo _("Network Devices"); ?></h4>
                                        <p><?php echo _("Send Router and Network Device log data to Nagios Log Server"); ?></p>
                                    </div>
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="logo-container">
                            <h2><?php echo _("Application Logs &amp; Log Files"); ?><i class="fa fa-sitemap" style="color:#4d89f9;margin-left:10px;"></i></h2>
                            <hr class="logo-divider">
                            <h5><?php echo _("File Monitoring"); ?></h5>
                            <div class="css-table">
                                <div class="row-block">
                                    <a href="<?php echo site_url('source-setup/linux-files'); ?>" class="logo-atom">
                                        <div class="logo-container-inner">
                                            <h4><img src="<?php echo base_url('media/images/logos/linux_files.png'); ?>" class="logo-small"><?php echo _("Linux Files"); ?></h4>
                                            <p><?php echo _("Send Linux Files to Nagios Log Server"); ?></p>
                                        </div>
                                    </a>
                                    <a href="<?php echo site_url('source-setup/windows-files'); ?>" class="logo-atom">
                                        <div class="logo-container-inner">
                                            <h4><img src="<?php echo base_url('media/images/logos/windows_files.png'); ?>" class="logo-small"><?php echo _("Windows Files"); ?></h4>
                                            <p><?php echo _("Send Windows Files to Nagios Log Server"); ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <hr class="logo-divider">
                            <h5><?php echo _("Application Monitoring"); ?></h5>
                            <div class="css-table">
                                <div class="row-block">
                                    <a href="<?php echo site_url('source-setup/apache'); ?>" class="logo-atom">
                                        <div class="logo-container-inner">
                                            <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_ApacheNB.png'); ?>" class="logo-small"><?php echo _("Apache"); ?></h4>
                                            <p><?php echo _("Send Apache log files to Nagios Log Server."); ?></p>
                                        </div>
                                    </a>
                                    <a href="<?php echo site_url('source-setup/IIS'); ?>" class="logo-atom">
                                        <div class="logo-container-inner">
                                            <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_IISNB.png'); ?>" class="logo-small"><?php echo _("IIS Web Server"); ?></h4>
                                            <p><?php echo _("Send IIS Web Server logs to Nagios Log Server."); ?></p>
                                        </div>
                                    </a>
                                    <a href="<?php echo site_url('source-setup/mysql'); ?>" class="logo-atom">
                                        <div class="logo-container-inner">
                                            <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MYSQLNB.png'); ?>" class="logo-small"><?php echo _("MySQL Server"); ?></h4>
                                            <p><?php echo _("Send MySQL Web Server data to Nagios Log Server."); ?></p>
                                        </div>
                                    </a>
                                    <a href="<?php echo site_url('source-setup/mssql'); ?>" class="logo-atom">
                                        <div class="logo-container-inner">
                                            <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_MSSQLNB.png'); ?>" class="logo-small"><?php echo _("MS SQL Server"); ?></h4>
                                            <p><?php echo _("Send MS SQL data to Nagios Log Server."); ?></p>           
                                        </div>
                                    </a>
                                    <a href="<?php echo site_url('source-setup/PHP'); ?>" class="logo-atom">
                                        <div class="logo-container-inner">
                                            <h4><img src="<?php echo base_url('media/images/logos/Log_server_Logos_PHPNB.png'); ?>" class="logo-small"><?php echo _("PHP"); ?></h4>
                                            <p><?php echo _("Send PHP logs to Nagios Log Server"); ?></p>
                                        </div>  
                                    </a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="logo-container">
                            <h2><?php echo _("Import Archived Log Files"); ?><i class="fa fa-copy" style="color:#4d89f9;margin-left:10px;"></i></h2>
                            <hr class="logo-divider">
                            <div class="css-table">
                                <div class="row-block">
                                  <a href="<?php echo site_url('source-setup/import'); ?>" class="logo-atom">
                                    <div class="logo-container-inner">
                                        <h4><img src="<?php echo base_url('media/images/logos/import_files.png'); ?>" class="logo-small"><?php echo _("Import From File"); ?></h4>
                                        <p><?php echo _("Send archived log files to Nagios Log Server."); ?></p>
                                    </div>
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>