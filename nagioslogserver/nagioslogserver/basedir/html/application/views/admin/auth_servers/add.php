<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('LDAP/AD Integration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Add Auth Server'); ?></li>
</ul>

<script type="text/javascript">
$(document).ready(function() {

    setup_form();

    // Activate tool tips
    $('.tt').tooltip();

    // Change what's displayed when the server type changes
    $('#type').change(function() {
        setup_form();
    });

});

function setup_form() {
    if ($('#type').val() == "ldap") {
        $('.ad-specific').hide();
        $('.ldap-specific').show();
    } else {
        $('.ad-specific').show();
        $('.ldap-specific').hide();
    }
}
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('Add LDAP / Active Directory Server'); ?></h2>
                <p><?php echo _('You must make sure that you can access the LDAP / Active Directory server from your Nagios Log Server box. You should also verify that the correct encryption methods are available. If you\'re planning on using SSL or TLS with self-signed certificates you need to make sure the proper certificates are installed on the Nagios Log Server server or you will not be able to connect to your LDAP / Active Directory server.'); ?></p>

                <div class="alert alert-error <?php if (empty($errors)) { echo "hide"; } ?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php if (!empty($errors)) { echo $errors; } ?>
                </div>
                
                <form action="<?php echo current_url(); ?>" method="post">
                    <div class="form-horizontal well fl" style="margin-bottom: 15px;">
                        <div style="margin: 20px;">
                            <div class="control-group" style="margin-bottom: 12px;">
                                <label class="control-label" for="type"><?php echo _('Server Type'); ?></label>
                                <div class="controls">
                                    <select id="type" name="type">
                                        <option value="ad" <?php if (!empty($type)) { if ($type == "ad") { echo "selected"; } } ?>>Active Directory</option>
                                        <option value="ldap" <?php if (!empty($type)) { if ($type == "ldap") { echo "selected"; } } ?>>LDAP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group" style="margin-bottom: 12px;">
                                <div class="controls">
                                    <label class="checkbox" style="display: inline-block;">
                                        <input type="checkbox" name="enabled" value="1" <?php if (!isset($enabled)) { echo "checked"; } else { if (!empty($enabled)) { echo "checked"; } } ?>> <?php echo _('Enabled'); ?> <i class="fa fa-question-circle tt" title="<?php echo _('Enabled servers can be used to authenticate against. Disabling a server means the users will still exist but they won\'t be able to log into Nagios Log Server.'); ?>"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name"><?php echo _('Server Name'); ?></label>
                                <div class="controls">
                                    <input type="text" id="name" name="name" value="<?php if (!empty($name)) { echo $name; } ?>">
                                    <div class="subcontrol"><?php echo _('The name of the server for internal purposes only. This will not affect the connection.'); ?></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="basedn"><?php echo _('Base DN'); ?></label>
                                <div class="controls">
                                    <input type="text" id="basedn" name="basedn" value="<?php if (!empty($basedn)) { echo $basedn; } ?>" style="width: 300px;" placeholder="DC=nagios,DC=com">
                                    <div class="subcontrol"><?php echo _('The LDAP-format starting object (distinguished name) that your users are defined below, such as <strong>DC=nagios,DC=com</strong>.'); ?></div>
                                </div>
                            </div>
                            <div class="control-group ad-specific hide">
                                <label class="control-label" for="suffix"><?php echo _('Account Suffix'); ?></label>
                                <div class="controls">
                                    <input type="text" id="suffix" name="suffix" value="<?php if (!empty($suffix)) { echo $suffix; } ?>" placeholder="@nagios.com">
                                    <div class="subcontrol"><?php echo _('The part of the full user identification after the username, such as <strong>@nagios.com</strong>.'); ?></div>
                                </div>
                            </div>
                            <div class="control-group ad-specific hide">
                                <label class="control-label" for="controllers"><?php echo _('Domain Controllers'); ?></label>
                                <div class="controls">
                                    <input type="text" id="controllers" name="controllers" value="<?php if (!empty($controllers)) { echo $controllers; } ?>" style="width: 400px;" placeholder="dc1.nagios.com,dc2.nagios.com">
                                    <div class="subcontrol"><?php echo _('A <strong>comma-separated</strong> list of domain controllers.'); ?></div>
                                </div>
                            </div>
                            <div class="control-group ldap-specific hide">
                                <label class="control-label" for="host"><?php echo _('LDAP Host'); ?></label>
                                <div class="controls">
                                    <input type="text" id="host" name="host" value="<?php if (!empty($host)) { echo $host; } ?>" placeholder="ldap.nagios.com">
                                    <div class="subcontrol"><?php echo _('The IP address or hostname of your LDAP server.'); ?></div>
                                </div>
                            </div>
                            <div class="control-group ldap-specific hide">
                                <label class="control-label" for="port"><?php echo _('LDAP Port'); ?></label>
                                <div class="controls">
                                    <input type="text" id="port" name="port" value="<?php if (!empty($port)) { echo $port; } else { echo "389"; } ?>" style="width: 50px;">
                                    <div class="subcontrol"><?php echo _('The port your LDAP server is running on. (Default is 389)'); ?></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="encryption"><?php echo _('Encryption Method'); ?></label>
                                <div class="controls">
                                    <select id="encryption" name="encryption" style="width: 100px;">
                                        <option value="none" <?php if (!empty($encryption)) { if ($encryption == "none") { echo "selected"; } } ?>>None</option>
                                        <option value="ssl" <?php if (!empty($encryption)) { if ($encryption == "ssl") { echo "selected"; } } ?>>SSL</option>
                                        <option value="tls" <?php if (!empty($encryption)) { if ($encryption == "tls") { echo "selected"; } } ?>>TLS</option>
                                    </select>
                                    <div class="subcontrol"><?php echo _('Used when trying to connect to a server via <strong>SSL</strong> or <strong>TLS</strong> encryptions.'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <button type="submit" name="create" value="1" class="btn btn-primary"><?php echo _('Create Server'); ?></button>
                    <a href="<?php echo site_url('admin/auth_servers'); ?>" class="btn btn-default" style="margin-left: 10px;"><?php echo _('Cancel'); ?></a>
                </form>