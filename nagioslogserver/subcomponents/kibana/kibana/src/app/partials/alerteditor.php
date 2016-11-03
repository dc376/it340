<?php include_once('../setlang.inc.php'); ?>

<style>
.method_option { display: none; }
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3><?php echo _('Create an Alert'); ?></h3>
</div>
<div class="modal-body manage-alerts delete-modal-on-close">
    <div class="alert hide" style="margin: 0;">
        <div class="alert-message"></div>
    </div>
    <div class="alert-body">
        <p><?php echo _('Create an alert based on the <i>current dashboard</i>\'s queries and filters.'); ?></p>
        <h5><?php echo _('Configure Alert Settings'); ?></h5>
        <div id="alert_alert"></div>
        <div class="well" style="margin-bottom: 0;">
            <div class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" style="width: 100px;" for="a_name"><?php echo _('Alert Name'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <input type="text" name="name" style="width: 300px;" id="a_name" placeholder="{{dashboard.current.title}} Check">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="width: 100px;" for="a_ci"><?php echo _('Check Interval'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <input type="text" name="check_interval" style="width: 60px;" id="a_ci" placeholder="5m">
                        <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa-question-sign" bs-tooltip="'<?php echo _('Check interval is how often the check will be performed, default is s for seconds. The values available are seconds (s), minutes (m), hours (h), and days (d). Example check intervals: 60s, 5m, 10m, 2h, 1d'); ?>'"></i>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="width: 100px;" for="a_lp"><?php echo _('Lookback Period'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <input type="text" name="lookback_period" style="width: 60px;" id="a_lp" placeholder="5m">
                        <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa-question-sign" bs-tooltip="'<?php echo _('How long to look back when grabbing data to query, default is s for seconds. This will normally be the same as the check interval. Example lookback periods: 60s, 5m, 10m, 2h, 1d'); ?>'"></i>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="width: 100px;" for="a_w"><?php echo _('Thresholds'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <input type="text" name="warning" id="a_w" style="width: 50px;" placeholder="<?php echo _("Warning"); ?>">
                        <input type="text" name="critical" id="a_c" style="width: 50px;" placeholder="<?php echo _("Critical"); ?>"> <?php echo _('# of events'); ?>
                        <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa-question-sign" bs-tooltip="'<?php echo _('Can use any valid Nagios threshold value. Use 1: for warning and critical to alert with critical on nothing being found.'); ?>'"></i>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" style="width: 100px;" for="a_type"><?php echo _('Alert Method'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <select name="type" id="a_type" onchange="show_method_options(this);" style="width: auto;">
                            <option value=""><?php echo _('None'); ?></option>
                            <option class="admin_only" value="nrdp"><?php echo _('Nagios (send using NRDP)'); ?></option>
                            <option class="admin_only" value="reactor"><?php echo _('Nagios Reactor Event Chain'); ?></option>
                            <option value="email"><?php echo _('Email Users'); ?></option>
                            <option class="admin_only" value="exec"><?php echo _('Execute Script'); ?></option>
                            <option class="admin_only" value="snmp"><?php echo _('Send SNMP Trap'); ?></option>
                        </select>
                        <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa-question-sign" bs-tooltip="'<?php echo _('Define how you would like to receive the check when it is ran and meets the requirements.'); ?>'"></i>
                    </div>
                </div>
                <div class="control-group method_option email_option">
                    <label class="control-label" style="width: 100px;" for="a_users"><?php echo _('Select Users'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <select id="select_users" name="users" multiple></select>
                    </div>
                </div>
                <div class="control-group method_option email_option">
                        <label class="control-label" style="width: 100px;" for="a_users"><?php echo _("Email Template"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <select id="templates" name="tpl_id"></select>
                        </div>
                    </div>
                <div class="control-group method_option exec_option">
                    <label class="control-label" style="width: 100px;" for="a_script"><?php echo _('Script'); ?></label>
                    <div class="controls" style="margin-left: 110px; margin-right: 20px;">
                        <input type="text" name="exec_location" id="a_script" style="width: 100%;" value="" placeholder="/usr/local/nagioslogserver/scripts/myscript.sh">
                    </div>
                </div>
                <div class="control-group method_option exec_option">
                    <label class="control-label" style="width: 100px;" for="a_args"><?php echo _('Arguments'); ?></label>
                    <div class="controls" style="margin-left: 110px; margin-right: 20px;">
                        <input type="text" name="exec_args" id="a_args" style="width: 100%;" value="" placeholder="-H 192.168.0.1 -U test -p hello">
                        <div style="margin-top: 10px;">
                            <div><?php echo _('Alerts will automatically replace these placeholders'); ?>:</div>
                            <div><strong>%count%</strong> - <?php echo _('The total # of events'); ?></div>
                            <div><strong>%status%</strong> - <?php echo _('The status (ok, warning, critical)'); ?></div>
                            <div><strong>%output%</strong> - <?php echo _('The output from the alert'); ?></div>
                            <div><strong>%lastrun%</strong> - <?php echo _('The timestamp of the last run'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="control-group method_option nrdp_option">
                    <label class="control-label" style="width: 100px;" for="a_nrdp_servers"><?php echo _('NRDP Server'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <select id="a_nrdp_servers" name="nrdp_server"></select>
                    </div>
                </div>
                <div class="control-group method_option nrdp_option">
                    <label class="control-label" style="width: 100px;" for="a_hostname"><?php echo _('Hostname'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <input type="text" name="hostname" id="a_hostname" value="">
                        <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa-question-sign" bs-tooltip="'<?php echo _('The hostname you want the alert to show up as in Nagios'); ?>'"></i>
                    </div>
                </div>
                <div class="control-group method_option nrdp_option">
                    <label class="control-label" style="width: 100px;" for="a_servicename"><?php echo _('Servicename'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <input type="text" name="servicename" id="a_servicename" value="">
                        <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa-question-sign" bs-tooltip="'<?php echo _('The servicename related to the hostname that will show up in Nagios'); ?>'"></i>
                    </div>
                </div>
                <div class="control-group method_option reactor_option">
                    <label class="control-label" style="width: 100px;" for="a_reactor_servers"><?php echo _('Reactor Server'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <select id="a_reactor_servers" name="reactor_server" onchange="get_reactor_chains();"></select>
                    </div>
                </div>
                <div class="control-group method_option reactor_option">
                    <label class="control-label" style="width: 100px;" for="a_reactor_chains"><?php echo _('Event Chain'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <select id="a_reactor_chains" name="reactor_chains"></select>
                        <div style="margin-top: 10px;">
                            <div><?php echo _('Alerts will automatically send these context variables'); ?>:</div>
                            <div><strong>count</strong> - <?php echo _('The total # of events'); ?></div>
                            <div><strong>status</strong> - <?php echo _('The status (ok, warning, critical)'); ?></div>
                            <div><strong>output</strong> - <?php echo _('The output from the alert'); ?></div>
                            <div><strong>lastrun</strong> - <?php echo _('The timestamp of the last run'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="control-group method_option snmp_option">
                    <label class="control-label" style="width: 100px;" for="a_snmp_receivers"><?php echo _('Trap Receiver'); ?></label>
                    <div class="controls" style="margin-left: 110px;">
                        <select id="a_snmp_receivers" name="snmp_receiver"></select>
                    </div>
                </div>
                <div class="control-group method_option email_option nrdp_option reactor_option snmp_option exec_option" style="margin-bottom: 0; display: none;">
                    <label class="control-label" style="width: 100px;"></label>
                    <div class="controls" style="margin-left: 110px;">
                        <label class="checkbox" style="margin: 0; padding-top: 0;">
                            <input type="checkbox" name="send_wc_only" id="a_send_wc_only" value="1">
                            <?php echo _('Only alert when Warning or Critical threshold is met.'); ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success create-alert-btn" ng-click="dashboard.create_nls_alert(this);"><?php echo _('Create Alert'); ?></button>
    <button type="button" class="btn btn-default" ng-click="dismiss();"><?php echo _('Close'); ?></button>
</div>

<script>
function show_method_options(select) {
    var method = $(select).val();
    clear_method_options();

    switch (method)
    {
        case "email":
            $('#a_send_wc_only').attr('checked', true);
            $.post(site_url+'api/user/get_all_users', {}, function(data) {
                html = '';
                $.each(data, function(k, user) {
                    var name = '';
                    if (user.name != '' && user.name != undefined) { name = ' ('+user.name+')'; }
                    if (is_admin) {
                        html += '<option value="'+user.id+'">'+user.username+name+'</option>';
                    } else {
                        if (user.username == LS_USERNAME) {
                            html += '<option value="'+user.id+'">'+user.username+name+'</option>';
                        }
                    }
                });
                $('#select_users').html(html);
            }, 'json');
            $.get(site_url+'api/check/get_templates', { }, function(data) {
                $('#templates').html('<option value="system"><?php echo _("System Default"); ?></option>');
                $(data).each(function(k, v) {
                    $('#templates').append('<option value="'+v._id+'">'+v._source.name+'</option>');
                });
            });
            $('.email_option').show();
            break;

        case "nrdp":
            // Check for NRDP server configurations
            $.get(site_url+'api/check/get_nrdp', {}, function(data) {
                html = '';
                $.each(data, function(k, v) {
                    html += '<option value="'+v._id+'">'+v._source.name+'</option>';
                });
                $('#a_nrdp_servers').html(html);
            }, 'json');
            $('.nrdp_option').show();
            break;

        case 'reactor':
            // Check for Reactor servers
            $.get(site_url+'api/check/get_reactor', {}, function(data) {
                html = '';
                $.each(data, function(k, v) {
                    html += '<option value="'+v._id+'" data-server="'+v._source.address+'" data-apikey="'+v._source.apikey+'">'+v._source.name+'</option>';
                });
                $('#a_reactor_servers').html(html);
                get_reactor_chains();
            }, 'json');
            $('.reactor_option').show();
            break;

        case "snmp":
            // Check for SNMP trap receivers
            $.get(site_url+'api/check/get_snmp_receivers', {}, function(data) {
                html = '';
                $.each(data, function(k, v) {
                    html += '<option value="'+v._id+'">'+v._source.name+'</option>';
                });
                $('#a_snmp_receivers').html(html);
            }, 'json');
            $('.snmp_option').show();
            break;

        case "exec":
            $('.exec_option').show();
            break;

        default:
            break;
    }
}

function get_reactor_chains() {
    var server = $('#a_reactor_servers option:selected').data('server');
    var apikey = $('#a_reactor_servers option:selected').data('apikey');
    $('#a_reactor_chains').html('');
    $.get(server+'eventchain', { api_key: apikey }, function(data) {
        var html = '';
        $(data).find('chains chain').each(function(k, v) {
            html += '<option value="' + $(v).attr('id') + '">' + $(v).find('name').text() + '</option>';
        });
        $('#a_reactor_chains').html(html);
    });
}

function clear_method_options() {
    $('.method_option').hide();
    $('#a_send_wc_only').attr('checked', false);
}
</script>