<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('System Status'); ?></li>
</ul>

<script>
$(document).ready(function() {

    $('#system-profile').click(function() {
        window.location.href = site_url+'api/system/get_system_profile';
    });

});
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('System Status'); ?></h2>
                <p><button type="button" id="system-profile" class="btn btn-sm btn-default"><?php echo _('Download System Profile'); ?></button></p>
                <p><?php echo _('The system status shows the important required components statuses and allows you to start/stop/restart them from the web UI.'); ?></p>
                <?php if (!empty($success)) { ?><div class="alert alert-success"><?php echo $success; ?></div><?php } ?>
                <?php if ($error) { ?><div class="alert alert-error"><?php echo $error; ?></div><?php } ?>
                <div class="form-horizontal">
                    <strong style="display: inline-block; margin-right: 10px;"><?php echo _("Instance"); ?></strong>
                    <select id="node-select" style="width: 400px;">
                        <?php foreach ($nodes as $node) { ?>
                        <option value="<?php echo $node['address']; ?>">
                            <?php
                            if ($node['address'] == $_SERVER['SERVER_ADDR']) {
                                echo "[This Instance] ";
                            }
                            echo $node['address'];
                            if (!empty($node['hostname']) && $node['hostname'] != $node['address']) {
                                echo " (".$node['hostname'].")";
                            }
                            ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <h5 style="margin-top: 20px;"><?php echo _('Core Services'); ?></h5>
                <div style="margin: 10px 20px; line-height: 28px;">
                    <div><span id="elasticsearch-status" class="status" style="margin-right: 5px;"><img style="width: 16px; heigh: 16px;" src="<?php echo base_url('media/images/ajax-loader.gif'); ?>"></span> <?php echo _('Elasticsearch Database'); ?> <span data-service="elasticsearch" class="service-actions" id="elasticsearch-actions"></span></div>
                    <div><span id="logstash-status" class="status" style="margin-right: 5px;"><img style="width: 16px; heigh: 16px;" src="<?php echo base_url('media/images/ajax-loader.gif'); ?>"></span> <?php echo _('Logstash Collector'); ?> <span data-service="logstash" class="service-actions" id="logstash-actions"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    // Do ajax calls to update service information
    check_all_services();

    // Add starting/stopping/restarting
    $('.service-actions').bind('click', 'a', function(e) {
        var hostname = $('#node-select option:selected').val();
        var service = $(e.target).parent().data('service');
        var action = $(e.target).data('action');
        //console.log(service);
        do_service_action(hostname, service, action);
    });

    // Add changing the selection box
    $('#node-select').change(function() {
        clear_all_status();
        var hostname = $(this).val();
        check_service(hostname, 'logstash');
        check_service(hostname, 'elasticsearch');
    });

});

function check_service(hostname, service)
{
    var protocol = window.location.protocol;
    var url = protocol + '//'+hostname+"/nagioslogserver/api/system/status";
    $.post(url, { subsystem: service, token: '<?php echo $apikey; ?>' }, function(data) {
        img = '';
        if (data.status == "running") {
            img = '<?php echo base_url("media/icons/accept.png"); ?>';
        } else if (data.status == "stopped") {
            img = '<?php echo base_url("media/icons/exclamation.png"); ?>';
        }
        $('#'+service+'-status').html('<img title="'+data.message+'" src="'+img+'">');
        if (data.status == "running") {
            $('#'+service+'-actions').html('[<a data-action="restart"><?php echo _("Restart"); ?></a>] [<a data-action="stop"><?php echo _("Stop"); ?></a>]');
        } else {
            $('#'+service+'-actions').html('[<a data-action="start"><?php echo _("Start"); ?></a>]');
        }
    }, 'json');
}

function clear_all_status()
{
    $('.status').html('<img style="width: 16px; heigh: 16px;" src="<?php echo base_url("media/images/ajax-loader.gif"); ?>">');
}

function check_all_services()
{
    var hostname = $('#node-select option:selected').val();
    check_service(hostname, 'logstash');
    check_service(hostname, 'elasticsearch');
}

function do_service_action(hostname, service, action)
{
    $('#'+service+'-status').html('<img style="width: 16px; heigh: 16px;" src="<?php echo base_url("media/images/ajax-loader.gif"); ?>">');
    var protocol = window.location.protocol;
    var url = protocol + '//'+hostname+"/nagioslogserver/api/system/"+action;
    $.post(url, { subsystem: service, token: '<?php echo $apikey; ?>' }, function(data) {
        setTimeout(check_all_services, 2000);
        setTimeout(get_server_status, 2000);
    }, 'json');
}
</script>

<?php echo $footer; ?>