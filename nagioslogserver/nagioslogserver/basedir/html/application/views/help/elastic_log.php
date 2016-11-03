<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('help'); ?>"><?php echo _('Help'); ?></a> <span class="divider">/</span></li><li class="active"><?php echo _('Elastic Search and Logstash'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
    	<div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <div class="setup-container">
                    <h2><?php echo _('Nagios Log Server Services'); ?></h2>
                    <p>
                        <?php echo _('Nagios Log Server uses elastic search and logstash to locate logs that can be sent to Nagios Log Server.  Understanding both Elastic Search and Logstash will help you setup, use and maintain a Nagios Log Server.  These tools are services which are usually managed from the command line.  With the combintation of all the tools mentioned above Nagios Log Server is the glue that holds them all together and gives you an easy to manage system of logs and a customizable interface with all your logs being displayed how you need them to be.'); ?>
                    </p>
                    <br>
                    <h2><?php echo _('System Status'); ?></h2>
                    <p>
                        <?php echo _('The system status shows a Nagios Log Server user the status of the two engines that make log server work.  Below is the system status icons that you should see at the top of your current Nagios Log Server window.'); ?>
                    </p>
                    <br>
                    <center><img src="<?php echo base_url('media/images/logserver_system_status.png'); ?>" class="logo-large"></center>
                    <br>
                    <p>
                        <?php echo _('The icon on the left indicates the status of the Elastic Search service.  If the service is up it will show green as above.  The Elastic Search database is accessed locally for security purposes so when the service is down you will see this screen on all pages of your Nagios Log Server until the service is started.'); ?>
                        <center><img src="<?php echo base_url('media/images/logserver_system_status_elasticsearch_down.png'); ?>"></center>
                        <br>
                        <b><?php echo _('Go to your Nagios Log Server terminal window and restart the elasticsearch service as the message suggests.') ?></b>
                    </p>
                    <p>
                        <?php echo _('The icon on the right, or the second icon, indicates the status of the Log Collector service. Below is the system status icons showing that the Log Collector or logstash service is offline. All the log collection in Nagios Log Server uses this service to do it main task: collect and save logs.  Simply run a command in your Nagios Log Server terminal window to restart this just like the elasticsearch service.'); ?>
                    </p>
                    <br>
                    <div class="logo-container" style="width:40%;margin:0 auto;">
                        <center><img src="<?php echo base_url('media/images/logserver_system_status_logstash_down.png'); ?>" class="logo-large"></center>
                        <br>
                        <div class="code-tooltip" style="width:80%;">
                            <div style="position:relative;">
                                <button class="select-button" data-toggle="tooltip" title="<?php echo _("Select all"); ?>"><a class="select-success" data-title="Selected!"></a><?php echo _("Select All"); ?></button>
                                <button class="copy-button" data-toggle="tooltip" title="<?php echo _("Copy"); ?>" data-clipboard-target="code"><a class="copy-success" data-title="Copied!"></a><?php echo _("Copy"); ?></button>
<code class="code prettyprint linenums">service logstash start</code>
                                <textarea class="copy-target" style="display:none">service logstash start</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>