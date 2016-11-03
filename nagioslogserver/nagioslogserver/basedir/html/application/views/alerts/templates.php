<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('alerts'); ?>"><?php echo _("Alerting"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Email Templates'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">

                <div id="messages">
                <?php if (!empty($success)) { ?><div class="alert alert-success"><?php echo $success; ?> <a class="close" data-dismiss="alert" href="#">&times;</a></div><?php } ?>
                </div>

                <h2 style="margin-top: 0;"><?php echo _("Email Templates"); ?></h2>
                <div style="margin-bottom: 15px;">
                    <button class="btn btn-default" id="add-template" <?php if (!$is_admin) { echo 'disabled'; } ?>><i class="fa fa-plus"></i> <?php echo _("Add Template"); ?></button>
                    <button class="btn btn-default" id="view-macros" <?php if (!$is_admin) { echo 'disabled'; } ?>> <?php echo _("View Macros"); ?></button>
                </div>

                <p>
                    <b><?php echo _('Default Email Template'); ?></b> <i class="fa fa-question-circle ls-pop" title="<?php echo _('Default Email Template'); ?>" data-content="<?php echo _('The default template will be used when an alert is set to use \'default template\' or if the alerts was never given a template.'); ?>"></i> - <a id="view-default"><?php echo $default_template; ?></a> <?php if ($is_admin) { ?>- <a id="change-default"><i class="fa fa-pencil"></i> <?php echo _('Change'); ?></a><?php } ?>
                </p>

                <div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo _("Template Name"); ?></th>
                                <th style="width: 220px;"><?php echo _("Last modified"); ?></th>
                                <th><?php echo _("Last modified by"); ?></th>
                                <th><?php echo _("Created by"); ?></th>
                                <th style="width: 60px; text-align: center;"><?php echo _("Actions"); ?></th>
                            </tr>
                        </thead>
                        <tbody id="template-list">
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Manage a email template -->
<div class="modal hide fade" data-backdrop="static" id="manage-template">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><span class="template-action-type"><?php echo _("Add"); ?></span> <?php echo _("Email Template"); ?></h3>
    </div>
    <div class="modal-body">
        <p style="margin-bottom: 15px;"><?php echo _("Manage email templates for alerts. You can use the macros below inside the email message and they will be populated before the message is sent."); ?></p>
        <div id="manage-template-alerts"></div>
        <div class="form-horizontal">
            <div style="margin-bottom: 10px;">
                <input style="width: 97.5%; font-size: 12px; line-height: 15px;" type="text" value="" id="tpl-name" <?php if (!$is_admin) { echo 'disabled'; } ?> placeholder="<?php echo _('Template name'); ?>">
            </div>
            <div style="margin-bottom: 10px;">
                <input style="width: 97.5%; font-size: 12px; line-height: 15px;" type="text" value="" id="tpl-subject" <?php if (!$is_admin) { echo 'disabled'; } ?> placeholder="<?php echo _('Subject'); ?>">
            </div>
            <div>
                <textarea style="width: 97.5%; min-height: 240px; font-size: 12px; line-height: 15px;" id="tpl-body" <?php if (!$is_admin) { echo 'disabled'; } ?> placeholder="<?php echo _('Message body'); ?>"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="fl">
            <div class="btn-group">
                <button class="btn btn-info dropdown-toggle" <?php if (!$is_admin) { echo 'disabled'; } ?>>
                    <?php echo _('Load'); ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="tpl-load-default"><?php echo _('System Default'); ?></a></li>
                    <li><a class="tpl-load-current-default"><?php echo _('Current Default'); ?></a></li>
                </ul>
            </div>
        </div>
        <a href="#" class="btn" data-dismiss="modal"><?php echo _("Cancel"); ?></a>
        <button class="btn btn-primary template-action-type" id="manage-template-button" <?php if (!$is_admin) { echo 'disabled'; } ?>><?php echo _("Add"); ?></button>
        <div class="clear"></div>
    </div>
</div>

<!-- View default email template -->
<div class="modal hide fade" id="view-default-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><?php echo _("Default Email Template"); ?></h3>
    </div>
    <div class="modal-body">
        <p style="margin-bottom: 10px;"><?php echo _("The template used for alerts with no template and alerts set to use default."); ?></p>
        <p style="margin-bottom: 10px; font-weight: bold;"><?php echo $default_template; ?></p>
        <div class="form-horizontal">
            <div style="margin-bottom: 10px;">
                <input style="width: 97.5%; font-size: 12px; line-height: 15px;" type="text" value="<?php echo $default_template_subject; ?>" placeholder="<?php echo _('Subject'); ?>" readonly>
            </div>
            <div>
                <textarea style="width: 97.5%; min-height: 280px; font-size: 12px; line-height: 15px;" readonly><?php echo $default_template_body; ?></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal"><?php echo _("Close"); ?></a>
    </div>
</div>

<!-- Template macros -->
<div class="modal hide fade" id="view-macros-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><?php echo _("Email Template Macros"); ?></h3>
    </div>
    <div class="modal-body">
        <p style="margin-bottom: 10px;"><?php echo _("The following macros will be interpreted before sending emails."); ?></p>
        <table class="table table-condensed table-striped table-hover table-no-margin table-no-border">
            <tbody>
                <tr>
                    <td style="font-weight: bold;">%time%</td>
                    <td><?php echo _('The time the alert was sent'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%alertname%</td>
                    <td><?php echo _('The name of the alert that is sending a message'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%state%</td>
                    <td><?php echo _('The state of the alert, OK, WARNING, CRITICAL, UNKNOWN'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%lookback%</td>
                    <td><?php echo _('The alert lookback period (example: 5m)'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%warning%</td>
                    <td><?php echo _('The warning threshold value'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%critical%</td>
                    <td><?php echo _('The critical threshold value'); ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;"><?php echo _('Message Body Only'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%output%</td>
                    <td><?php echo _('The command line check output'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%url%</td>
                    <td><?php echo _('The url for the alert to be ran in the NLS dashboard'); ?></td>
                </tr>
                <!--
                <tr>
                    <td style="font-weight: bold;">%apiurl%</td>
                    <td><?php echo _('A link to the alerts query via the API'); ?></td>
                </tr>
                -->
                <tr>
                    <td style="font-weight: bold;">%uniquehosts%</td>
                    <td><?php echo _('A newline separated list of unique hosts in the alert query.'); ?><br><?php echo _('Example'); ?>:<br>192.68.1.5 (28)<br>192.168.5.112 (1220)<br><?php echo _('The value inside the parentheses is the amount of matching logs for the alert time period for the hosts.'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%lastalertlog%</td>
                    <td><?php echo _('The last log from the alert query.'); ?><br><?php echo _('Can only use one of %lastalertlog% OR %last10alertlogs% per email.'); ?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">%last10alertlogs%</td>
                    <td><?php echo _('The last 10 logs from the alert query.'); ?><br><?php echo _('Can only use one of %lastalertlog% OR %last10alertlogs%s per email.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal"><?php echo _("Close"); ?></a>
    </div>
</div>

<!-- Set default template -->
<div class="modal hide fade" id="change-default-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><?php echo _("Set Default Template"); ?></h3>
    </div>
    <div class="modal-body">
        <table class="table table-condensed table-no-margin table-no-border">
            <tr>
                <td style="vertical-align: middle;"><?php echo _('Template'); ?></td>
                <td>
                    <select id="tpl-select" style="margin: 0;"></select>
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal"><?php echo _("Close"); ?></a>
        <button class="btn btn-primary" id="set-default-button"><?php echo _("Set Default"); ?></button>
    </div>
</div>

<script type="text/javascript">
var CURRENT_ACTION = 'add';
var CURRENT_EDIT_ID = '';

$(document).ready(function() {

    $('.ls-pop').popover();
    $('.dropdown-toggle').dropdown();

    load_templates();

    $('#view-default').click(function() {
        $('#view-default-modal').modal('show');
    });

    $('#view-macros').click(function() {
        $('#view-macros-modal').modal('show');
    });

    $('#change-default').click(function() {
        $.get('<?php echo site_url("api/check/get_templates"); ?>', { }, function(data) {
            $('#tpl-select').html('<option value="system"><?php echo _("System Default"); ?></option>');
            $(data).each(function(k, v) {
                $('#tpl-select').append('<option value="'+v._id+'">'+v._source.name+'</option>');
            });
            $('#change-default-modal').modal('show');
        });
    });

    $('#set-default-button').click(function() {
        $.post('<?php echo site_url("api/check/set_default_tpl"); ?>', { id: $('#tpl-select').val() }, function(d) {
            if (d.success) {
                window.location.reload();
            } else {
                // Error
            }
        }, 'json');
    });

    $('#add-template').click(function() {
        CURRENT_ACTION = "add";
        clear_template_modal('add');
        $('#manage-template').modal('show');
    });

    $('.tpl-load-default').click(function() {
        $.get('<?php echo site_url("api/check/get_default_tpl"); ?>', { force: 1 }, function(tpl) {
            $('#tpl-body').val(tpl.body);
            $('#tpl-subject').val(tpl.subject);
        });
    });

    $('.tpl-load-current-default').click(function() {
        $.get('<?php echo site_url("api/check/get_default_tpl"); ?>', { }, function(tpl) {
            $('#tpl-body').val(tpl.body);
            $('#tpl-subject').val(tpl.subject);
        });
    });

    $('#manage-template-button').click(function() {
        if ($('#tpl-name').val() == '' || $('#tpl-subject').val() == '' || $('#tpl-body').val() == '') {
            // Display error
            $('#manage-template-alerts').html('<div class="alert alert-danger"><?php echo _("You must fill out all the fields."); ?></div>');
            return;
        }

        var data = { name: $('#tpl-name').val(),
                     subject: $('#tpl-subject').val(),
                     body: $('#tpl-body').val() }

        // For editing only
        if (CURRENT_ACTION == "edit") {
            data['id'] = CURRENT_EDIT_ID;
        }
        data['action'] = CURRENT_ACTION;

        $.post('<?php echo site_url("api/check/template"); ?>', data, function(result) {
            if (result.status == "success") {
                $('#manage-template').modal('hide');
                load_templates();
                $('#messages').html('<div class="alert alert-success"><?php echo _("Successfully updated email template"); ?> <a class="close" data-dismiss="alert" href="#">&times;</a></div>');
            } else {
                $('#manage-template-alerts').html('<div class="alert alert-danger">'+result.msg+'</div>');
            }
        }, 'json');
    });

    $('#template-list').on('click', '.delete', function() {
        var id = $(this).parents('td').data('id');
        $.post('<?php echo site_url("api/check/template"); ?>', { id: id, action: 'delete' }, function(result) {
            load_templates();
        });
    });

    $('#template-list').on('click', '.edit', function() {
        CURRENT_EDIT_ID = $(this).parents('td').data('id');
        CURRENT_ACTION = "edit";
        $.get('<?php echo site_url("api/check/get_templates"); ?>', { id: CURRENT_EDIT_ID }, function(tpl) {
            clear_template_modal('edit');
            $('#tpl-name').val(tpl._source.name);
            $('#tpl-subject').val(tpl._source.subject);
            $('#tpl-body').val(tpl._source.body);
            $('#manage-template').modal('show');
        });
    });

});

function load_templates()
{
    $.get('<?php echo site_url("api/check/get_templates"); ?>', { }, function(data) {
        html = '';
        if (data.length == 0) {
            html = '<tr><td colspan="9"><?php echo _("No email templates have been created."); ?></td></tr>';
        } else {
            $.each(data, function(k, v) {
                var actions = '<a title="<?php echo _("Edit"); ?>"><i class="edit fa fa-pencil"></i></a> <?php if ($is_admin) { ?><a title="<?php echo _("Remove"); ?>"><i class="delete fa fa-trash-o"></i></a><?php } ?>';
                html += '<tr><td class="name">'+v._source.name+'</td><td>'+v._source.last_edit+'</td><td class="modified">'+v._source.modified_by+'</td><td class="created">'+v._source.created_by+'</td><td class="actions" data-id="'+v._id+'">'+actions+'</td></tr>';
            });
        }
        $('#template-list').html(html);
    });
}

function clear_template_modal(type)
{
    $('#manage-template input').val('');
    $('#manage-template textarea').val('');
    $('#manage-template-alerts').html('');
    if (type == 'add') {
        $('.template-action-type').html('<?php echo _("Add"); ?>');
    } else {
        $('.template-action-type').html('<?php echo _("Save"); ?>');
    }
}
</script>

<?php echo $footer; ?>