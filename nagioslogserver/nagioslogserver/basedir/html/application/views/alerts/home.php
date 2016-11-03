<?php echo $header; ?>

<ul class="breadcrumb">
    <li class="active"><?php echo _("Alerting"); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2 style="margin-top: 0;"><?php echo _("Alerts"); ?></h2>
                <p><?php echo _("Manage the local alerts for your Log Server. You can change alerting methods by editing the alert. If you're an admin, you can see everyone's alerts here."); ?></p>

                <?php if ($msg) { ?>
                <div class="alert alert-<?php echo $msg_type; ?>" style="margin-bottom: 15px;"><div style='float: right;'><a href='#' class='close' data-dismiss='alert'>&times;</a></div><?php echo $msg; ?></div>
                <?php } ?>

                <div style="margin: 15px 0;">
                    <div class="row-fluid">
                        <div class="span6">
                            <button id="create-alert" class="btn btn-default"><i class="fa fa-plus"></i> <?php echo _("New Alert"); ?></button>
                        </div>
                        <div class="span6" style="text-align: right;">
                            <?php
                            $attr = array("style" => "margin: 0;");
                            echo form_open('alerts', $attr);
                            ?>
                            <input type="text" style="margin: 0;" name="search" value="<?php if (!empty($search)) { echo $search; } ?>" placeholder="<?php echo _('Search by alert name'); ?>">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo _("Alert Name"); ?></th>
                            <?php if (is_admin()) { ?><th><?php echo _("Created By"); ?></th><?php } ?>
                            <th style="width: 210px;"><?php echo _("Last Run"); ?></th>
                            <th style="width: 80px;"><?php echo _("Status"); ?></th>
                            <th><?php echo _("Alert Output"); ?></th>
                            <th><?php echo _("Alert Method"); ?></th>
                            <th style="width: 120px; text-align: center;"><?php echo _("Actions"); ?></th>
                        </tr>
                    </thead>
                    <tbody id="alert-list">
                        <?php 
                        if (count($alerts) > 0) {
                            foreach ($alerts as $alert) { ?>
                        <tr>
                            <td>
                                <?php if (!$alert['active']) { ?>
                                <span class="label fr ls-tooltip" style="margin-top: 1px;" title="<?php echo _("This alert is not active, so it will not be ran again automatically until activated."); ?>"><?php echo _("Not Active"); ?></span>
                                <?php } else { ?>
                                <!-- <span class="label label-success fr ls-tooltip" style="margin-top: 1px;" title="<?php echo _("This alert is active, so it will be ran on the check interval that has been set."); ?>"><?php echo _("Active"); ?></span> -->
                                <?php }
                                echo $alert['name']; ?>
                                <div class="clear"></div>
                            </td>
                            <?php if (is_admin()) { ?><td><?php echo $alert['created_by']; ?></td><?php } ?>
                            <td><?php if (!empty($alert['last_run'])) echo date("r", $alert['last_run']); else echo _("Never") ?></td>
                            <td class="status-output <?php echo $alert['last_status']; ?>"><?php echo $alert['last_status']; ?></td>
                            <td><?php echo $alert['last_output']; ?></td>
                            <td><?php if (empty($alert['method']['type'])) { echo _("None"); } else { echo $alert['pretty_method']; } ?></td>
                            <td class="actions">
                                <a href="<?php echo site_url('alerts/show/'.$alert['id']); ?>" title="<?php echo _("Show alert in Dashboard"); ?>"><i class="fa fa-desktop"></i></a>
                                <a href="<?php echo site_url('alerts/run/'.$alert['id']); ?>" title="<?php echo _("Run the alert now"); ?>"><i class="fa fa-check-square-o"></i></a>
                                <?php if ($alert['active']) { ?>
                                <a href="<?php echo site_url('alerts/deactivate/'.$alert['id']); ?>" title="<?php echo _("Deactivate this alert"); ?>"><i class="fa fa-bell-slash-o"></i></a>
                                <?php } else { ?>
                                <a href="<?php echo site_url('alerts/activate/'.$alert['id']); ?>" title="<?php echo _("Activate this alert"); ?>"><i class="fa fa-bell-o"></i></a>
                                <?php } if (is_admin()) { ?>
                                <a class="edit" data-aid="<?php echo $alert['id']; ?>" title="<?php echo _("Edit the alert"); ?>"><i class="fa fa-pencil"></i></a>
                                <?php } ?>
                                <a href="<?php echo site_url('alerts/delete/'.$alert['id']); ?>" title="<?php echo _("Remove"); ?>"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                            <?php } 
                        } else {
                        ?>
                        <tr>
                            <td colspan="9"><?php echo _("You have no alerts created."); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<style>
.method_option { display: none; }
</style>

<div id="alert-modal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3><?php echo _("Create an Alert"); ?></h3>
    </div>
    <div class="modal-body delete-modal-on-close">
        <div id="create-alert-message" class="alert hide" style="margin: 0;">
            <div id="alert-message"></div>
        </div>
        <div class="alert-body">
            <h5 style="margin-top: 0; padding-top: 0;"><?php echo _("Configure Alert Settings"); ?></h5>
            <input type="hidden" value="" id="a_id">
            <div class="well" style="margin-bottom: 0;">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" style="width: 100px;" for="a_name"><?php echo _("Alert Name"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <input type="text" name="name" style="width: 300px;" id="a_name">
                        </div>
                    </div>
                    <div class="control-group" id="queries-box">
                        <label class="control-label" style="width: 100px;" for="a_name"><?php echo _("Query"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <select id="a_queries" name="queries"></select>
                            <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("Queries are created in the dashboard using the Query Manager."); ?>"></i>
                        </div>
                    </div>
                    <div class="control-group hide" id="raw-queries-box">
                        <label class="control-label" style="width: 100px;" for="a_name"><?php echo _("Raw Query"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <textarea id="a_raw_query"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="width: 100px;" for="a_ci"><?php echo _("Check Interval"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <input type="text" name="check_interval" style="width: 60px;" id="a_ci" placeholder="5m">
                            <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("Check interval is how often the check will be performed, default is s for seconds. The values available are seconds (s), minutes (m), hours (h), and days (d). Example check intervals: 60s, 5m, 10m, 2h, 1d"); ?>"></i>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="width: 100px;" for="a_lp"><?php echo _("Lookback Period"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <input type="text" name="lookback_period" style="width: 60px;" id="a_lp" placeholder="5m">
                            <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("How long to look back when grabbing data to query, default is s for seconds. This will normally be the same as the check interval. Example lookback periods: 60s, 5m, 10m, 2h, 1d"); ?>"></i>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="width: 100px;" for="a_w"><?php echo _("Thresholds"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <input type="text" name="warning" id="a_w" style="width: 50px;" placeholder="<?php echo _("Warning"); ?>">
                            <input type="text" name="critical" id="a_c" style="width: 50px;" placeholder="<?php echo _("Critical"); ?>"> <?php echo _("# of events"); ?> <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("Can use any valid Nagios threshold value. Use 1: for warning and critical to alert with critical on nothing being found."); ?>"></i>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="width: 100px;" for="a_type"><?php echo _("Alert Method"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <select name="type" id="a_type" onchange="show_method_options(this);" style="width: auto;">
                                <option value=""><?php echo _("None"); ?></option>
                                <?php if (is_admin()) { ?>
                                <option value="nrdp"><?php echo _("Nagios (send using NRDP)"); ?></option>
                                <option value="reactor"><?php echo _("Nagios Reactor Event Chain"); ?></option>
                                <option value="exec"><?php echo _("Execute Script"); ?></option>
                                <option value="snmp"><?php echo _("Send SNMP Trap"); ?></option>
                                <?php } ?>
                                <option value="email"><?php echo _("Email Users"); ?></option>
                            </select>
                            <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("Define how you would like to receive the check when it is ran and meets the requirements."); ?>"></i>
                        </div>
                    </div>
                    <div class="control-group method_option email_option">
                        <label class="control-label" style="width: 100px;" for="a_users"><?php echo _("Select Users"); ?></label>
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
                        <label class="control-label" style="width: 100px;" for="a_script"><?php echo _("Script"); ?></label>
                        <div class="controls" style="margin-left: 110px; margin-right: 20px;">
                            <input type="text" name="exec_location" id="a_script" style="width: 100%;" value="" placeholder="/usr/local/nagioslogserver/scripts/myscript.sh">
                        </div>
                    </div>
                    <div class="control-group method_option exec_option">
                        <label class="control-label" style="width: 100px;" for="a_args"><?php echo _("Arguments"); ?></label>
                        <div class="controls" style="margin-left: 110px; margin-right: 20px;">
                            <input type="text" name="exec_args" id="a_args" style="width: 100%;" value="" placeholder="-H 192.168.0.1 -U test -p hello">
                            <div style="margin-top: 10px;">
                                <div><?php echo _("Alerts will automatically replace these placeholders"); ?>:</div>
                                <div><strong>%count%</strong> - <?php echo _("The total # of events"); ?></div>
                                <div><strong>%status%</strong> - <?php echo _("The status (ok, warning, critical)"); ?></div>
                                <div><strong>%output%</strong> - <?php echo _("The output from the alert"); ?></div>
                                <div><strong>%lastrun%</strong> - <?php echo _("The timestamp of the last run"); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group method_option nrdp_option">
                        <label class="control-label" style="width: 100px;" for="a_nrdp_servers"><?php echo _("NRDP Server"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <select id="a_nrdp_servers" name="nrdp_server"></select>
                        </div>
                    </div>
                    <div class="control-group method_option nrdp_option">
                        <label class="control-label" style="width: 100px;" for="a_hostname"><?php echo _("Hostname"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <input type="text" name="hostname" id="a_hostname" value="">
                            <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("The hostname you want the alert to show up as in Nagios"); ?>"></i>
                        </div>
                    </div>
                    <div class="control-group method_option nrdp_option">
                        <label class="control-label" style="width: 100px;" for="a_servicename"><?php echo _("Servicename"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <input type="text" name="servicename" id="a_servicename" value="">
                            <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("The servicename related to the hostname that will show up in Nagios"); ?>"></i>
                        </div>
                    </div>
                    <div class="control-group method_option reactor_option">
                        <label class="control-label" style="width: 100px;" for="a_reactor_servers"><?php echo _("Reactor Server"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <select id="a_reactor_servers" name="reactor_server" onchange="get_reactor_chains();"></select>
                        </div>
                    </div>
                    <div class="control-group method_option reactor_option">
                        <label class="control-label" style="width: 100px;" for="a_reactor_chains"><?php echo _("Event Chain"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <select id="a_reactor_chains" name="reactor_chains"></select>
                            <div style="margin-top: 10px;">
                                <div><?php echo _("Alerts will automatically send these context variables"); ?>:</div>
                                <div><strong>count</strong> - <?php echo _("The total # of events"); ?></div>
                                <div><strong>status</strong> - <?php echo _("The status (ok, warning, critical)"); ?></div>
                                <div><strong>output</strong> - <?php echo _("The output from the alert"); ?></div>
                                <div><strong>lastrun</strong> - <?php echo _("The timestamp of the last run"); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group method_option snmp_option">
                        <label class="control-label" style="width: 100px;" for="a_snmp_receivers"><?php echo _("Trap Receiver"); ?></label>
                        <div class="controls" style="margin-left: 110px;">
                            <select id="a_snmp_receivers" name="snmp_receiver"></select>
                        </div>
                    </div>
                    <div class="control-group method_option email_option nrdp_option reactor_option snmp_option exec_option">
                        <label class="control-label" style="width: 100px;"></label>
                        <div class="controls" style="margin-left: 110px;">
                            <label class="checkbox" style="margin: 0; padding-top: 0;">
                                <input type="checkbox" name="send_wc_only" id="a_send_wc_only" value="1">
                                <?php echo _("Only alert when Warning or Critical threshold is met."); ?>
                            </label>
                        </div>
                    </div>
                    <div id="toggle-query-editor-btn" class="control-group" style="margin-bottom: 0;">
                        <label class="control-label" style="width: 100px;"></label>
                        <div class="controls" style="margin-left: 110px;">
                            <a id="toggle-query-editor"><?php echo _('Advanced (Manage Query)'); ?></a> &nbsp;<i class="fa fa-chevron-up"></i>
                        </div> 
                    </div>
                </div>
                <div id="query-editor" class="form-horizontal" style="margin-top: 20px; display: none;">
                    <div style="margin-bottom: 10px;">
                        <select id="l_queries" name="lqueries"></select>
                        <button id="load-query" class="btn btn-default"><?php echo _('Load'); ?></button>
                        <i style="margin-left: 5px; font-size: 14px; vertical-align: middle;" class="fa fa-question-circle ls-tooltip" title="<?php echo _("Load one of your pre-created queries into the query editor."); ?>"></i>
                    </div>
                    <textarea id="query-text" name="query" style="width: 97%; height: 100px; font-family: courier new, monospace;"></textarea>
                    <p style="padding: 0; margin: 10px 0 0 0; font-size: 12px; line-height: 16px;"><?php echo _('The must: range: @timestamp: from:/to: section is required. Normally the timestamps given are the ones selected when the query was ran. They will be automatically updated when the alert runs to the proper timestamps.'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success" id="create-alert-btn"><?php echo _("Create Alert"); ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><?php echo _("Close"); ?></button>
    </div>
</div>

<script>
CURRENT_ACTION = '';

$(document).ready(function() {
    
    load_all_queries();

    $('#load-query').click(function() {
        var qid = $('#l_queries').val();

        // Grab the query and write it out in slightly nicer JSON format without slashes
        $.get(site_url + 'api/system/get_query_partial', { id: qid }, function(data) { 
            $('#query-text').val(JSON.stringify(data));
        }, 'json');
    });

    $('#toggle-query-editor').click(function() {
        if ($('#query-editor').is(":visible")) {
            $('#query-editor').hide();
            $(this).parent().find('.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        } else {
            $('#query-editor').show();
            $(this).parent().find('.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
    });

    $('#alert-list').on('click', '.edit', function() {
        CURRENT_ACTION = 'edit';
        $('#toggle-query-editor-btn').show();
        var aid = $(this).data('aid');
        $('#alert-modal h3').html('<?php echo _("Edit an Alert"); ?>');
        $('#create-alert-btn').html('<?php echo _("Save Changes"); ?>');

        // Grab the alert and then show the modal (filled in)
        $.get(site_url+'api/check/get_alert', { id: aid }, function(alert) {
            $('#a_id').val(aid);

            // Fill in the modal
            $('#a_name').val(alert.name);
            $('#queries-box').hide();
            $('#a_ci').val(alert.check_interval);
            $('#a_lp').val(alert.lookback_period);
            $('#a_w').val(alert.warning);
            $('#a_c').val(alert.critical);
            $('#query-editor textarea').val(alert.query);

            // Set alert method
            $('#a_type').val(alert.method.type);
            do_method_options(alert.method.type, alert.method);

            if (alert.alert_crit_only) {
                $('#a_send_wc_only').prop('checked', true);
            } else {
                $('#a_send_wc_only').prop('checked', false);
            }

            $('#alert-modal').modal('show');
        }, 'json');
    });

    $('#create-alert').click(function() {
        CURRENT_ACTION = 'add';
        $('#query-editor').hide();
        $('#toggle-query-editor-btn').hide();
        $('#alert-modal h3').html('<?php echo _("Create an Alert"); ?>');
        $('#create-alert-btn').html('<?php echo _("Create Alert"); ?>');
        clear_alert_modal();
        $('#alert-modal').modal('show');
    });

    $('#create-alert-btn').click(function() {
        var aco = 0;
        if ($('#a_send_wc_only').is(":checked")) {
            aco = 1;
        }

        var check = { name: $('#a_name').val(),
                      check_interval: $('#a_ci').val(),
                      lookback_period: $('#a_lp').val(),
                      warning: $('#a_w').val(),
                      critical: $('#a_c').val(),
                      method: { type: $('#a_type').val() },
                      alert_crit_only: aco,
                      created_by: LS_USERNAME
                    }

        if (CURRENT_ACTION != 'edit') {
            var qid = $('#a_queries').val();
            if (qid == '' || qid == undefined) {
                $('#alert-message').html('<?php echo _("You must fill out all the fields."); ?>');
                $('#create-alert-message').addClass('alert-danger').show();
                return;
            }
            check.query_id = qid;
        } else {
            // Add query to the arguements
            check.query = $('#query-text').val();
        }

        // Verify the values...
        if (check.name == '' || check.check_interval == '' || check.lookback_period == '' || check.warning == '' || check.critical == '') {
            $('#alert-message').html('<?php echo _("You must fill out all the fields."); ?>');
            $('#create-alert-message').addClass('alert-danger').show();
            return;
        }

        // Add more to the alert based on type...
        switch (check.method.type) {
            case 'nrdp':
                check.method.hostname = $('#a_hostname').val();
                check.method.servicename = $('#a_servicename').val();
                check.method.server_id = $('#a_nrdp_servers').val();
                break;
            case 'email':
                var user_ids = [];
                $('#select_users option:selected').each(function(i, opt) {
                    user_ids.push($(opt).val());
                });
                check.method.user_ids = user_ids;
                check.method.tpl_id = $('#templates').val();
                break;
            case 'exec':
                check.method.path = $('#a_script').val();
                check.method.args = $('#a_args').val();
                break;
            case 'snmp':
                check.method.snmp_receiver = $('#a_snmp_receivers').val();
                break;
            case 'reactor':
                check.method.reactor_server_id = $('#a_reactor_servers').val();
                check.method.chain_id = $('#a_reactor_chains').val();
                check.method.chain_name = $('#a_reactor_chains').text();
                break;
        }

        // Send the new check to the API
        var url = site_url+'api/check/create/1';
        if (CURRENT_ACTION == 'edit') {
            url = site_url+'api/check/update';
            check.id = $('#a_id').val();
        }

        $.post(url, { alert: JSON.stringify(check) }, function(data) {
            $('#alert-modal').modal('hide');
            window.location.reload();
        });

    });

});

function load_all_queries(id) {
    var html = '';
    var cachebuster = Date.now(); 
    $.get(site_url+'api/check/get_queries', { cb: cachebuster }, function(data) {
        $.each(data, function(k, v) {
            html += '<option value="'+v.id+'">'+v.name+'</option>';
            $('#a_queries').html(html);
            $('#l_queries').html('<option></option>'+html);
        });
    }, 'json');
}

function show_method_options(select) {
    var method = $(select).val();
    do_method_options(method, '');
}

function do_method_options(method, values) {
    clear_method_options();
    switch (method)
    {
        case "email":
            if (values == '') {
                $('#a_send_wc_only').prop('checked', true);
            }
            $.post(site_url+'api/user/get_all_users', {}, function(data) {
                html = '';
                $.each(data, function(k, user) {
                    var name = '';
                    if (user.name != '' && user.name != undefined) { name = ' ('+user.name+')'; }
                    if (is_admin) {
                        var selected = '';
                        if (values != '') {
                            $.each(values.user_ids, function(k, v) {
                                if (v == user.id) { selected = ' selected'; }
                            });
                        }
                        html += '<option value="'+user.id+'"'+selected+'>'+user.username+name+'</option>';
                    } else {
                        if (user.username == LS_USERNAME) {
                            html += '<option value="'+user.id+'" selected>'+user.username+name+'</option>';
                        }
                    }
                });
                $('#select_users').html(html);
            }, 'json');
            $.get('<?php echo site_url("api/check/get_templates"); ?>', { }, function(data) {
                $('#templates').html('<option value="system"><?php echo _("System Default"); ?></option>');
                $(data).each(function(k, v) {
                    var sel = '';
                    if (values != '') {
                        if (v._id == values.tpl_id) { sel = 'selected'; }
                    }
                    $('#templates').append('<option value="'+v._id+'" '+sel+'>'+v._source.name+'</option>');
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
                if (values != '') {
                    $('#a_nrdp_servers').val(values.server_id);
                }
                $('#a_hostname').val(values.hostname);
                $('#a_servicename').val(values.servicename);
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
                if (values != '') {
                    $('#a_reactor_servers').val(values.reactor_id);
                }
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
                if (values != '') {
                    $('#a_snmp_receivers').val(values.snmp_receiver);
                }
            }, 'json');
            $('.snmp_option').show();
            break;

        case "exec":
            if (values != '') {
                $('#a_script').val(values.path);
                $('#a_args').val(values.args);
            }
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

function clear_alert_modal() {
    $('#a_type').val('');
    clear_method_options();
    $('#a_name').val('');
    $('#queries-box').show();
    $('#a_ci').val('');
    $('#a_lp').val('');
    $('#a_w').val('');
    $('#a_c').val('');
}
</script>

<?php echo $footer; ?>