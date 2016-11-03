<?php echo $header; ?>

<script>
$(document).ready(function() {

    // update check
    <?php if (is_admin()) { ?>
        $.get('<?php echo site_url('dashboard/do_update_check') ?>', {}, function(data) {
            if (data != "") {
                $('#updates').html(data);
            } else {
                $('#updates-box').hide();
            }
        });
    <?php } ?>

    // fetch rss functions
    $.get('<?php echo site_url('dashboard/fetch_rss/marketing') ?>', {}, function(data) {
        if (data.trim() != "") {
            $('#marketing').html(data);
            $('#marketing-box').show();
        }
    });

    $("#dontmiss").load('<?php echo site_url('dashboard/fetch_rss/dontmiss') ?>');
    $("#news").load('<?php echo site_url('dashboard/fetch_rss/news') ?>');

    var load_dashboards = function() {
        $.post(site_url + 'api/user/get_dashboards', function(data) {
            if ($(data).size() > 0) {
                $.each(data, function(index, value) {
                    $('#mydash tbody').append('<tr><td><a href="' + site_url + 'dashboard#/dashboard/elasticsearch/' + value.id + '">' + value.title + '</a></td></tr>');
                });
            } else {
                $('#mydash tbody').append("<tr><td><?php echo _('You don\'t have any dashboards'); ?></td></tr>");
            }
        }, 'json');
        $.post(site_url + 'api/system/get_global_dashboards', function(data) {
            if ($(data).size() > 0) {
                $.each(data, function(index, value) {
                    $('#globaldash tbody').append('<tr><td><i class="fa fa-globe" style="margin: 0 2px 0 1px;"></i> <a href="' + site_url + 'dashboard#/dashboard/elasticsearch/' + value.id + '">' + value.title + '</a></td></tr>');
                });
            } else {
                $('#globaldash tbody').append('<tr><td><?php echo _("There are no global dashboards"); ?></td></tr>');
            }
        }, 'json');
    }

    var load_queries = function() {
        var cachebuster = Date.now(); 
        $.post(site_url + 'api/check/get_queries?cb=' +cachebuster, function(data) {
            var has_queries = false;
            if ($(data).size() > 0) {
                $.each(data, function(index, value) {
                    if (value.show_everyone) {
                        $('#globalqueries tbody').append('<tr><td><i class="fa fa-globe" style="margin: 0 2px 0 1px;"></i> <a href="' + site_url + 'alerts/show_query/' + value.id + '">' + value.name + '</a></td></tr>');
                    } else {
                        has_queries = true;
                        $('#queries tbody').append('<tr><td><a href="' + site_url + 'alerts/show_query/' + value.id + '">' + value.name + '</a></td></tr>');
                    }
                });
            }

            if (!has_queries) {
                $('#queries tbody').append('<tr><td><?php echo _("You have not created any queries"); ?></td></tr>');
            }

            // Display defaults for globals if none exist
            if ($('#globalqueries tbody tr').length == 0) {
                $('#globalqueries tbody').append('<tr><td><?php echo _("There are no global queries"); ?></td></tr>');
            }

        }, 'json');
    }

    load_dashboards();
    load_queries();

});
</script>

<ul class="breadcrumb">
    <li class="active"><?php echo _("Home"); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="home-container span12">
            <h2><?php echo _("Log Server Overview"); ?></h2>
            <div class="row-fluid">
                <div class="span6">
                    <div class="well">
                        <div style="padding: 10px 0 10px 10px; background-color: #FFF;">
                            <div class="row-fluid">
                                <h4 style="margin-bottom: 28px;"><?php if ($unique_hosts < 4) { echo _("Start Sending Logs"); } else { echo _("Send More Logs"); } ?> - <span style="font-size: 14px; font-weight: normal;">
                                <?php if ($unique_hosts > 1) { echo _("Receiving logs from"), "<span style=\"font-weight:bold;font-size: 20px;\"> $unique_hosts </span>", _("hosts."); } else { echo _("Only receiving logs from"), "<span style=\"font-weight:bold;font-size: 20px;\"> 1 </span>", _("host."); } echo ' ', _("Follow the guides below to configure additional sources"); ?></span></h4>
                                <div class="quick-link-icon fl">
                                    <a href="<?php echo site_url('source-setup/windows'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_WindowsNB.png'); ?>" class="logo-small"><p style="margin-top: 10px;"><?php echo _("Windows Source"); ?></p></a>
                                </div>
                                <div class="quick-link-icon fl">
                                    <a href="<?php echo site_url('source-setup/linux'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_LinuxNB.png'); ?>" class="logo-small"><p style="margin-top: 10px;"><?php echo _("Linux Source"); ?></p></a>
                                </div>
                                <div class="quick-link-icon fl">
                                    <a href="<?php echo site_url('source-setup/network'); ?>" class="logo-atom"><img src="<?php echo base_url('media/images/logos/Log_server_Logos_NetworkDeviceNB.png'); ?>" class="logo-small"><p style="margin-top: 10px;"><?php echo _("Network Device"); ?></p></a>
                                </div>
                                <div class="fl" style="margin-left: 40px;">
                                    <a href="<?php echo site_url('source-setup'); ?>"><?php echo _("View more setup guides..."); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="well">
                        <div style="margin-top: 0px; height: 290px; background-color: #f5f5f5;">
                            <?php get_dashlet(array('dashlet_path' => '/dashboard/file/dashlet.json', 'height' => '230px', 'from' => '1h')); ?>
                        </div>
                    </div>
                    <div class="row-fluid hide" id="marketing-box">
                        <div class="well">
                            <div id="marketing"><span class="span1 offset2"><img style="width:16px;height:16px;" src="<?php echo base_url('media/images/ajax-loader.gif') ?>" alt="loading..." /></span></div>
                        </div>
                    </div>
                    <?php if (is_admin()) { ?>
                    <div class="well" id="updates-box">
                        <h3><?php echo _("Update Check"); ?></h3>
                        <div id="updates"><span class="span1 offset2"><img style="width:16px;height:16px;" src="<?php echo base_url('media/images/ajax-loader.gif') ?>" alt="loading..." /></span></div>
                    </div>
                    <?php } ?>
                    <!--
                    <div class="row-fluid">
                        <div class="well">
                            <h3><?php echo _("Don't Miss..."); ?></h3>
                            <div id="dontmiss"><span class="span1 offset2"><img style="width:16px;height:16px;" src="<?php echo base_url('media/images/ajax-loader.gif') ?>" alt="loading..." /></span></div>
                        </div>
                    </div>
                    -->
                </div>
                <div class="span6">
                    <div class="well">
                        <div style="padding: 20px 0 20px 10px; background-color: #FFF;">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div style="margin-right: 10px;">
                                        <div style="margin-bottom: 12px;">
                                            <h4><?php echo _("Global Queries"); ?></h4>
                                            <div style="min-height: 118px; max-height:204px;overflow:auto;">
                                                <table id="globalqueries" class="table table-striped table-hover table-condensed table-bordered" style="margin: 0;">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            <h4><?php echo _("My Queries"); ?></h4>
                                            <div style="max-height:118px;overflow:auto;">
                                                <table id="queries" class="table table-striped table-hover table-condensed table-bordered" style="margin: 0;">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6">
                                    <div style="margin-right: 10px;">
                                        <div style="margin-bottom: 12px;">
                                            <h4><?php echo _("Global Dashboards"); ?></h4>
                                            <div style="min-height: 118px; max-height:204px;overflow:auto;">
                                                <table id="globaldash" class="table table-striped table-hover table-condensed table-bordered" style="margin: 0;">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div>
                                            <h4><?php echo _("My Dashboards"); ?></h4>
                                            <div style="max-height:118px;overflow:auto;">
                                                <table id="mydash" class="table table-striped table-hover table-condensed table-bordered" style="margin: 0;">
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="well">
                                <h3><?php echo _("Reach Out to Us"); ?></h3>
                                <?php if (is_trial()) { ?>
                                <p>
                                    <strong><?php echo _("Want to learn more about how to use Nagios Log Server?"); ?></strong><br>
                                    <a href="https://go.nagios.com/nagios-log-server-demo-request" target="_blank"><?php echo _("Request a live demo"); ?> <i class="fa fa-chevron-circle-right"></i></a>
                                </p>
                                <?php } ?>
                                <p>
                                    <strong><?php echo _("We want your feedback."); ?></strong> <?php echo _("We want to hear about what we can do to make Nagios Log Server even better."); ?><br>
                                    <a href="https://go.nagios.com/nagios-log-server-feedback" target="_blank"><?php echo _("Give us feedback"); ?> <i class="fa fa-chevron-circle-right"></i></a>
                                </p>
                                <p>
                                    <strong><?php echo _("Need help?"); ?></strong> <?php echo _("If you're stuck and need assistance you can contact us directly with a request for assistance. We will redirect your request to the correct team internally for the fastest resolution."); ?><br>
                                    <a href="https://go.nagios.com/nagios-log-server-request-for-assistance" target="_blank"><?php echo _("Request assistance"); ?> <i class="fa fa-chevron-circle-right"></i></a>
                                </p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!--
                    <div class="row-fluid">
                        <div class="well">
                            <h3><?php echo _("Latest News"); ?></h3>
                            <div id="news"><span class="span1 offset2"><img style="width:16px;height:16px;" src="<?php echo base_url('media/images/ajax-loader.gif') ?>" alt="loading..." /></span></div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>