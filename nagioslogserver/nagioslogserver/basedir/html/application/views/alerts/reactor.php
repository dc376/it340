<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('alerts'); ?>"><?php echo _("Alerting"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Nagios Reactor Servers'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2 style="margin-top: 0;"><?php echo _("Nagios Reactor Servers"); ?></h2>
                <p><?php echo _("Link your Nagios Reactor servers to run event chains on alerts."); ?></p>
                <div style="margin-bottom: 15px;">
                    <button class="btn btn-default" id="add-reactor"><i class="fa fa-plus"></i> <?php echo _("Add Reactor Server"); ?></button>
                </div>
                <div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo _("Nagios Reactor Address"); ?></th>
                                <th><?php echo _("Reactor API Address"); ?></th>
                                <th><?php echo _("Reactor API Key"); ?></th>
                                <th style="width: 60px; text-align: center;"><?php echo _("Actions"); ?></th>
                            </tr>
                        </thead>
                        <tbody id="reactor-list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Manage a Reactor Server -->
<div class="modal hide fade" id="manage-reactor">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><span class="reactor-action-type"><?php echo _("Add"); ?></span> <?php echo _("Nagios Reactor Server"); ?></h3>
    </div>
    <div class="modal-body">
        <p style="margin-bottom: 15px;"><?php echo _("Add a Nagios Reactor server to run event chains from that server on alert."); ?></p>
        <div id="manage-reactor-alerts"></div>
        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="name"><?php echo _("Name"); ?></label>
                <div class="controls">
                    <input type="text" id="name">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="address"><?php echo _("Reactor API Address"); ?></label>
                <div class="controls">
                    <input type="text" id="address" style="width: 85%;" placeholder="http://192.168.1.150/nagiosreactor/index.php/api">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="apikey"><?php echo _("Reactor API Key"); ?></label>
                <div class="controls">
                    <input type="text" id="apikey" placeholder="mysecret">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary reactor-action-type" id="manage-reactor-button"><?php echo _("Add"); ?></button>
        <a href="#" class="btn" data-dismiss="modal"><?php echo _("Close"); ?></a>
    </div>
</div>

<script type="text/javascript">
var CURRENT_ACTION = 'add';
var CURRENT_EDIT_ID = '';

$(document).ready(function() {

    load_reactor_servers();

    $('#add-reactor').click(function() {
        CURRENT_ACTION = "add";
        clear_reactor_modal('add');
        $('#manage-reactor').modal('show');
    });

    $('#manage-reactor-button').click(function() {
        if ($('#name').val() == '' || $('#address').val() == '' || $('#apikey').val() == '') {
            // Display error
            $('#manage-reactor-alerts').html('<div class="alert alert-danger"><?php echo _("You must fill out all the fields."); ?></div>');
            return;
        }

        var addr = $('#address').val();
        if (addr.charAt(addr.length-1) != "/") { addr += '/'; }

        var data = { name: $('#name').val(),
                     address: addr,
                     apikey: $('#apikey').val(),
                     action: CURRENT_ACTION }

        // For editing only
        if (CURRENT_ACTION == "edit") {
            data['id'] = CURRENT_EDIT_ID;
        }

        $.post('<?php echo site_url("api/check/reactor"); ?>', data, function(result) {
            if (result.status == "success") {
                $('#manage-reactor').modal('hide');
                load_reactor_servers();
            } else {
                $('#manage-reactor-alerts').html('<div class="alert alert-danger">'+result.msg+'</div>');
            }
        }, 'json');
    });

    $('#reactor-list').on('click', '.delete', function() {
        var id = $(this).parents('td').data('id');
        $.post('<?php echo site_url("api/check/reactor"); ?>', { id: id, action: 'delete' }, function(result) {
            load_reactor_servers();
        });
    });

    $('#reactor-list').on('click', '.edit', function() {
        CURRENT_EDIT_ID = $(this).parents('td').data('id');
        CURRENT_ACTION = "edit";
        clear_reactor_modal('edit');
        $('#manage-reactor').modal('show');
        $('#name').val($(this).parents('tr').find('.name').text());
        $('#address').val($(this).parents('tr').find('.address').text());
        $('#token').val($(this).parents('tr').find('.token').text());
    });

});

function load_reactor_servers()
{
    $.get('<?php echo site_url("api/check/get_reactor"); ?>', { }, function(data) {
        html = '';
        if (data.length == 0) {
            html = '<tr><td colspan="9"><?php echo _("No Nagios Reactor servers have been linked."); ?></td></tr>';
        } else {
            $.each(data, function(k, v) {
                var actions = '<a title="Edit"><i class="edit fa fa-pencil"></i></a> <a title="Remove"><i class="delete fa fa-trash-o"></i></a>';
                html += '<tr><td class="name">'+v._source.name+'</td><td class="address">'+v._source.address+'</td><td class="apikey">'+v._source.apikey+'</td><td class="actions" data-id="'+v._id+'">'+actions+'</td></tr>';
            });
        }
        $('#reactor-list').html(html);
    });
}

function clear_reactor_modal(type)
{
    $('#manage-reactor input').val('');
    $('#manage-reactor-alerts').html('');
    if (type == 'add') {
        $('.reactor-action-type').html('<?php echo _("Add"); ?>');
    } else {
        $('.reactor-action-type').html('<?php echo _("Edit"); ?>');
    }
}
</script>

<?php echo $footer; ?>