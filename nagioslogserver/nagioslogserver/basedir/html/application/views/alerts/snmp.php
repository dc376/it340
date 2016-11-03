<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('alerts'); ?>"><?php echo _("Alerting"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _("SNMP Trap Receivers"); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2 style="margin-top: 0;"><?php echo _("SNMP Trap Receivers"); ?></h2>
                <p><?php echo _("As an alternative to sending passive checks via NRDP you can also send SNMP traps to a SNMP trap receiver which could also include your Nagios server."); ?></p>
                <div style="margin-bottom: 15px;">
                    <button class="btn btn-default" id="add-snmp"><i class="fa fa-plus"></i> <?php echo _("Add SNMP Trap Receiver"); ?></button>
                </div>
                <div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo _("SNMP Receiver Name"); ?></th>
                                <th><?php echo _("Address (IP:Port)"); ?></th>
                                <th style="width: 100px;"><?php echo _("SNMP Version"); ?></th>
                                <th style="width: 60px; text-align: center;"><?php echo _("Actions"); ?></th>
                            </tr>
                        </thead>
                        <tbody id="snmp-list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Manage a SNMP Trap Receiver -->
<div class="modal hide fade" id="manage-snmp">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><span class="snmp-action-type"><?php echo _("Add"); ?></span> <?php echo _("SNMP Trap Receiver"); ?></h3>
    </div>
    <div class="modal-body">
        <p style="margin-bottom: 15px;"><?php echo _("Add a SNMP Trap Receiver to send SNMP Traps to the receiving server on alert."); ?></p>
        <div id="manage-snmp-alerts"></div>
        <div class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="name"><?php echo _("Name"); ?></label>
                <div class="controls">
                    <input type="text" name="name" id="name">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="address"><?php echo _("Receiver Address"); ?></label>
                <div class="controls">
                    <input type="text" name="address" id="address" style="width: 30%;" placeholder="192.168.1.150">
                    <strong>:</strong>
                    <input type="text" name="port" id="port" style="width: 10%;" placeholder="4503">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="version"><?php echo _("SNMP Version"); ?></label>
                <div class="controls">
                    <select name="version" id="version" style="width: 80px;">
                        <option value="2">2c</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
            <div class="control-group version-2">
                <label class="control-label" for="community"><?php echo _("Community String"); ?></label>
                <div class="controls">
                    <input type="text" name="community" id="community">
                </div>
            </div>
            <div class="control-group version-3 hide">
                <label class="control-label" for="username"><?php echo _("Username"); ?></label>
                <div class="controls">
                    <input type="text" name="username" id="username">
                </div>
            </div>
            <div class="control-group version-3 hide">
                <label class="control-label" for="auth_level"><?php echo _("Authorization Level"); ?></label>
                <div class="controls">
                    <select name="auth_level" id="auth_level" style="width: 140px;">
                        <option value="authPriv">authPriv</option>
                        <option value="authNoPriv">authNoPriv</option>
                        <option value="noAuthnoPriv">noAuthnoPriv</option>
                    </select>
                </div>
            </div>
            <div class="control-group version-3 auth hide">
                <label class="control-label" for="auth_password"><?php echo _("Authorization Password"); ?></label>
                <div class="controls">
                    <input type="text" name="auth_password" id="auth_password" style="width: 160px;">
                    <select name="auth_protocol" id="auth_protocol" style="width: 80px;">
                        <option value="SHA">SHA</option>
                        <option value="MD5">MD5</option>
                    </select>
                </div>
            </div>
            <div class="control-group version-3 priv hide">
                <label class="control-label" for="priv_password"><?php echo _("Privacy Password"); ?></label>
                <div class="controls">
                    <input type="text" name="priv_password" id="priv_password" style="width: 160px;">
                    <select name="priv_protocol" id="priv_protocol" style="width: 80px;">
                        <option value="AES">AES</option>
                        <option value="DES">DES</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary snmp-action-type" id="manage-snmp-button"><?php echo _("Add"); ?></button>
        <a href="#" class="btn" data-dismiss="modal"><?php echo _("Close"); ?></a>
    </div>
</div>

<script>
var CURRENT_ACTION = 'add';
var CURRENT_EDIT_ID = '';

$(document).ready(function() {

    load_snmp_servers();

    $('#add-snmp').click(function() {
        CURRENT_ACTION = "add";
        clear_snmp_modal('add');
        $('#manage-snmp').modal('show');
    });

    $('#version').change(function() {
        if ($(this).val() == "2") {
            $('.version-2').show();
            $('.version-3').hide();
        } else {
            $('.version-3').show();
            $('.version-2').hide();
        }
    });

    $('#auth_level').change(function() {
        var level = $(this).val();
        if (level == 'authPriv') {
            $('.auth').show();
            $('.priv').show();
        } else if (level == 'authNoPriv') {
            $('.auth').show();
            $('.priv').hide();
        } else {
            $('.auth').hide();
            $('.priv').hide();
        }
    });

    $('#manage-snmp-button').click(function() {
        var version = $('#version option:selected').val();

        if ($('#name').val() == '' || $('#address').val() == '' || $('#port').val() == '') {
            // Display error
            $('#manage-snmp-alerts').html('<div class="alert alert-danger"><?php echo _("You must fill out all the fields."); ?></div>');
            return;
        }

        var data = { name: $('#name').val(),
                     address: $('#address').val(),
                     port: $('#port').val(),
                     version: version,
                     action: CURRENT_ACTION }

        if (version == '2') {
            data['community'] = $('#community').val();
        } else {
            data['username'] = $('#username').val();
            data['auth_level'] = $('#auth_level option:selected').val();
            data['auth_password'] = $('#auth_password').val();
            data['auth_protocol'] = $('#auth_protocol option:selected').val();
            data['priv_password'] = $('#priv_password').val();
            data['priv_protocol'] = $('#priv_protocol option:selected').val();
        }

        // For editing only
        if (CURRENT_ACTION == "edit") {
            data['id'] = CURRENT_EDIT_ID;
        }

        $.post('<?php echo site_url("api/check/snmp"); ?>', data, function(result) {
            if (result.status == "success") {
                $('#manage-snmp').modal('hide');
                load_snmp_servers();
            } else {
                $('#manage-snmp-alerts').html('<div class="alert alert-danger">'+result.msg+'</div>');
            }
        }, 'json');
    });

    $('#snmp-list').on('click', '.delete', function() {
        var id = $(this).parents('td').data('id');
        $.post('<?php echo site_url("api/check/snmp"); ?>', { id: id, action: 'delete' }, function(result) {
            load_snmp_servers();
        });
    });

    $('#snmp-list').on('click', '.edit', function() {
        CURRENT_EDIT_ID = $(this).parents('td').data('id');
        CURRENT_ACTION = "edit";
        clear_snmp_modal('edit');
        $.get('<?php echo site_url("api/check/get_snmp_receivers"); ?>', { id: CURRENT_EDIT_ID }, function(data) {
            receiver = data._source;
            $('#name').val(receiver.name);
            $('#address').val(receiver.address);
            $('#port').val(receiver.port);
            $('#version').val(receiver.version).trigger('change');
            
            // v3 settings
            if (receiver.version == "3") {
                $('#username').val(receiver.username);
                $('#auth_level').val(receiver.auth_level).trigger('change');
                $('#auth_password').val(receiver.auth_password);
                $('#auth_protocol').val(receiver.auth_protocol);
                $('#priv_password').val(receiver.priv_password)
                $('#priv_protocol').val(receiver.priv_protocol);
            } else {
                $('#community').val(receiver.community);
            }

            $('#manage-snmp').modal('show');
        }, 'json');
    });

});

function load_snmp_servers()
{
    $.get('<?php echo site_url("api/check/get_snmp_receivers"); ?>', { }, function(data) {
        html = '';
        if (data.length == 0) {
            html = '<tr><td colspan="9"><?php echo _("No SNMP Trap Receivers have been set up."); ?></td></tr>';
        } else {
            $.each(data, function(k, v) {
                var version = v._source.version;
                if (v._source.version == "2") {
                    version = "2c";
                }
                var actions = '<a title="Edit"><i class="edit fa fa-pencil"></i></a> <a title="Remove"><i class="delete fa fa-trash-o"></i></a>';
                html += '<tr><td class="name">'+v._source.name+'</td><td>'+v._source.address+':'+v._source.port+'</td><td>'+version+'</td><td class="actions" data-id="'+v._id+'">'+actions+'</td></tr>';
            });
        }
        $('#snmp-list').html(html);
    });
}

function clear_snmp_modal(type)
{
    $('#manage-snmp input').val('');
    $('#manage-snmp-alerts').html('');
    if (type == 'add') {
        $('.snmp-action-type').html('<?php echo _("Add"); ?>');
        $('#version').val('2').trigger('change');
    } else {
        $('.snmp-action-type').html('<?php echo _("Edit"); ?>');
    }
}
</script>

<?php echo $footer; ?>