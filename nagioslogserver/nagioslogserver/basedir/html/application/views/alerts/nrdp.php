<?php echo $header; ?>

<style>
.form-horizontal .control-group { margin-bottom: 10px; }
</style>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('alerts'); ?>"><?php echo _("Alerting"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _("Nagios Servers (NRDP)"); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
            
                <h2 style="margin-top: 0;"><?php echo _("Nagios Servers (NRDP)"); ?></h2>
                <p><?php echo _("You can set up Nagios Servers to send passive checks to via NRDP. This is available for both Nagios XI and Nagios Core. You will have to set up the host and service in your config files on the Nagios Server if you use this alerting method or the passive checks will not show up."); ?></p>
                <div>
                    <div class="row-fluid">
                        <div class="span6">
                            <div style="margin-top: 5px; margin-bottom: 20px;">
                                <h4><?php echo _("Alert Host/Service Configuration for NRDP method"); ?></h4>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo _("Alert Name"); ?></th>
                                        <th><?php echo _("Host"); ?></th>
                                        <th><?php echo _("Service"); ?></th>
                                        <th><?php echo _("Server Name"); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="nrdp-link-list">
                                <?php if (count($alerts) > 0) {
                                        foreach ($alerts as $alert) { ?>
                                        <tr>
                                            <td><?php echo $alert['name']; ?></td>
                                            <td><?php echo $alert['method']['hostname']; ?></td>
                                            <td><?php echo $alert['method']['servicename']; ?></td>
                                            <td><?php echo $alert['method']['server_name']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr><td colspan="9"><?php echo _("There are no alerts linked to any NRDP servers."); ?></td></tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="span6">
                            <div style="margin-bottom: 15px;">
                                <button class="btn btn-default" id="add-nrdp"><i class="fa fa-plus"></i> <?php echo _("Add NRDP Server"); ?></button>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th><?php echo _("Server Name"); ?></th>
                                        <th><?php echo _("NRDP Address"); ?></th>
                                        <th><?php echo _("NRDP Token"); ?></th>
                                        <th style="width: 60px; text-align: center;"><?php echo _("Actions"); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="nrdp-list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Manage a NRDP Server -->
<div class="modal hide fade" id="manage-nrdp">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><span class="nrdp-action-type"><?php echo _("Add"); ?></span> <?php echo _("NRDP Server"); ?></h3>
    </div>
    <div class="modal-body">
        <p style="margin-bottom: 15px;"><?php echo _("Can be Nagios Core or Nagios XI as long as you have the NRDP address and token."); ?></p>
        <div id="manage-nrdp-alerts"></div>
        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="name"><?php echo _("Name"); ?></label>
                <div class="controls">
                    <input type="text" id="name">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="address"><?php echo _("NRDP Address"); ?></label>
                <div class="controls">
                    <input type="text" id="address" style="width: 85%;" placeholder="http://192.168.1.150/nrdp/">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="token"><?php echo _("NRDP Token"); ?></label>
                <div class="controls">
                    <input type="text" id="token" placeholder="mysecret">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary nrdp-action-type" id="manage-nrdp-button" data-loading-text="<?php echo _("Connecting"); ?>..."><?php echo _("Add"); ?></button>
        <a href="#" class="btn" data-dismiss="modal"><?php echo _("Close"); ?></a>
    </div>
</div>

<script>
var CURRENT_ACTION = 'add';
var CURRENT_EDIT_ID = '';

$(document).ready(function() {

    load_nrdp_servers();

    $('#add-nrdp').click(function() {
        CURRENT_ACTION = "add";
        clear_nrdp_modal('add');
        $('#manage-nrdp').modal('show');
    });

    $('#manage-nrdp-button').click(function() {
        if ($('#name').val() == '' || $('#address').val() == '' || $('#token').val() == '') {
            // Display error
            $('#manage-nrdp-alerts').html('<div class="alert alert-danger"><?php echo _("You must fill out all the fields."); ?></div>');
            return;
        }
        $(this).button('loading');

        var addr = $('#address').val();
        if (addr.charAt(addr.length-1) != "/") { addr += '/'; }

        var data = { name: $('#name').val(),
                     address: addr,
                     token: $('#token').val(),
                     action: CURRENT_ACTION }

        // For editing only
        if (CURRENT_ACTION == "edit") {
            data['id'] = CURRENT_EDIT_ID;
        }

        $.post('<?php echo site_url("api/check/nrdp"); ?>', data, function(result) {
            $('#manage-nrdp-button').button('reset');
            if (result.status == "success") {
                $('#manage-nrdp').modal('hide');
                load_nrdp_servers();
            } else {
                $('#manage-nrdp-alerts').html('<div class="alert alert-danger">'+result.msg+'</div>');
            }
        }, 'json');
    });

    $('#nrdp-list').on('click', '.delete', function() {
        var id = $(this).parents('td').data('id');
        $.post('<?php echo site_url("api/check/nrdp"); ?>', { id: id, action: 'delete' }, function(result) {
            load_nrdp_servers();
        });
    });

    $('#nrdp-list').on('click', '.edit', function() {
        CURRENT_EDIT_ID = $(this).parents('td').data('id');
        CURRENT_ACTION = "edit";
        clear_nrdp_modal('edit');
        $('#manage-nrdp').modal('show');
        $('#name').val($(this).parents('tr').find('.name').text());
        $('#address').val($(this).parents('tr').find('.address').text());
        $('#token').val($(this).parents('tr').find('.token').text());
    });

});

function load_nrdp_servers()
{
    $.get('<?php echo site_url("api/check/get_nrdp"); ?>', { }, function(data) {
        html = '';
        if (data.length == 0) {
            html = '<tr><td colspan="9"><?php echo _("No Nagios Servers have been created."); ?></td></tr>';
        } else {
            $.each(data, function(k, v) {
                var actions = '<a title="Edit"><i class="edit fa fa-pencil"></i></a> <a title="Remove"><i class="delete fa fa-trash-o"></i></a>';
                html += '<tr><td class="name">'+v._source.name+'</td><td class="address">'+v._source.address+'</td><td class="token">'+v._source.token+'</td><td class="actions" data-id="'+v._id+'">'+actions+'</td></tr>';
            });
        }
        $('#nrdp-list').html(html);
    });
}

function clear_nrdp_modal(type)
{
    $('#manage-nrdp input').val('');
    $('#manage-nrdp-alerts').html('');
    if (type == 'add') {
        $('.nrdp-action-type').html('<?php echo _("Add"); ?>');
    } else {
        $('.nrdp-action-type').html('<?php echo _("Edit"); ?>');
    }
}
</script>

<?php echo $footer; ?>