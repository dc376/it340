<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _("Administration"); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('admin/users'); ?>"><?php echo _("Users"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _("Edit User"); ?></li>
</ul>

<script type="text/javascript">
var USERID = '<?php echo $user["id"]; ?>';
$(document).ready(function() {

    show_correct_fields();

    $('#account_type').change(function() {
        show_correct_fields();
    });

});

function show_correct_fields()
{
    var type = $('#account_type').val();

    if (type == "ldap") {
        $('.ad-required').hide();
        $('.ldap-required').show();
        $('.pw-box').hide();
    } else if (type == "ad") {
        $('.ldap-required').hide();
        $('.ad-required').show();
        $('.pw-box').hide();
    } else {
        $('.ldap-required').hide();
        $('.ad-required').hide();
        $('.pw-box').show();
    }

    if (USERID == 1) {
        $('.pw-box').show();
    }
}
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('Edit User');?></h2>
                <p><?php echo _('Please enter the users information below.');?></p>
                <?php if (!empty($msg)) { ?><div class="alert alert-success"><?php echo $msg; ?></div><?php } ?>
                <?php if (!empty($error)) { ?><div class="alert alert-error"><?php echo $error; ?></div><?php } ?>
                <?php echo form_open('admin/users/edit/'.$user['id']);?>
                <div class="row-fluid">
                    <div class="span6">
                        <h4><?php echo _('User Details'); ?></h4>
                        <table>
                            <tr>
                                <td class="form-left" style="width: 140px;"><?php echo _("Full Name"); ?>:</td>
                                <td>
                                    <input type="text" name="name" value="<?php if (set_value('name')) { echo set_value('name'); } else { echo $user['name']; } ?>" class="input-medium">
                                </td>
                            </tr>
                            <tr>
                                <td class="form-left"><?php echo _("Email"); ?>:</td>
                                <td><input type="text" name="email" value="<?php if (set_value('email')) { echo set_value('email'); } else { echo $user['email']; } ?>" class="input-xlarge"> *</td>
                            </tr>
                        </table>
                        <h4><?php echo _('Account Information'); ?></h4>
                        <table>
                            <tr>
                                <td class="form-left" style="width: 140px;"><?php echo _('Username'); ?>:</td>
                                <td><input type="text" name="username" value="<?php echo $user['username']; ?>" class="input" disabled></td>
                            </tr>
                            <tr class="pw-box">
                                <td class="form-left"><?php echo _('Password'); ?>:</td>
                                <td><input type="password" name="password" value="<?php echo set_value('password'); ?>" class="input-medium"> *</td>
                            </tr>
                            <tr class="pw-box">
                                <td class="form-left"><?php echo _('Confirm Password'); ?>:</td>
                                <td><input type="password" name="password2" value="<?php echo set_value('password2'); ?>" class="input-medium"> *</td>
                            </tr>
                            <tr>
                                <td class="form-left"><?php echo _('Language'); ?>:</td>
                                <td>
                                    <select name="language" class="input-medium">
                                        <option value="default" <?php if ($user['language'] == 'default') { echo 'selected'; } ?>><?php echo _('Default'); ?></option>
                                        <?php foreach ($languages as $l) { ?>
                                        <option value="<?php echo $l; ?>" <?php if ($user['language'] == $l) { echo 'selected'; } ?>>
                                            <?php echo get_language_name($l); ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <h4><?php echo _('Authentication Settings'); ?></h4>
                        <p><?php echo _('User accounts can be authenticated in many different ways either from your local database or external programs such as Active Directory or LDAP. You can set up external authentication servers in the'); ?> <a href="<?php echo site_url('admin/auth_servers'); ?>"><?php echo _('LDAP/AD Integration settings'); ?></a>.</p>

                        <?php if ($user['id'] == 1) { ?>
                        <div class="alert alert-info">
                            <?php echo _('<strong>Superuser Auth Settings</strong> You can not turn off local authentication for the nagiosadmin user. Even if you select a separate authentication method you will still be able to log in with the local password for this user.'); ?>
                        </div>
                        <?php } ?>

                        <table style="width: 100%;">
                            <tr>
                                <td class="form-left" style="width: 140px;"><?php echo _('Auth Type'); ?>:</td>
                                <td>
                                    <select name="account_type" id="account_type">
                                        <option value="local" <?php if (empty($user['auth_settings']['type'])) { echo "selected"; } ?>><?php echo _('Local (Default)'); ?></option>
                                        <option value="ad" <?php if (empty($ad_servers)) { echo "disabled"; } if ($user['auth_settings']['type'] == "ad") { echo "selected"; } ?>><?php echo _('Active Directory'); ?> <?php if (empty($ad_servers)) { ?>(<?php echo _('No Servers'); ?>)<?php } ?></option>
                                        <option value="ldap" <?php if (empty($ldap_servers)) { echo "disabled"; } if ($user['auth_settings']['type'] == "ldap") { echo "selected"; } ?>><?php echo _('LDAP'); ?> <?php if (empty($ldap_servers)) { ?>(<?php echo _('No Servers'); ?>)<?php } ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="hide ldap-required">
                                <td class="form-left"><?php echo _('LDAP Server'); ?>:</td>
                                <td>
                                    <select name="ldap_server" id="ldap_server" style="min-width: 340px;">
                                        <?php foreach ($ldap_servers as $ldap) { ?>
                                        <option value="<?php echo $ldap['id']; ?>"><?php echo $ldap['name'].' ('.$ldap['host'].')'; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="hide ad-required">
                                <td class="form-left"><?php echo _('AD Server'); ?>:</td>
                                <td>
                                    <select name="ad_server" id="ad_server" style="min-width: 340px;">
                                        <?php foreach ($ad_servers as $ad) { ?>
                                        <option value="<?php echo $ad['id']; ?>"><?php echo $ad['name'].' ('.$ad['controllers'].')'; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="hide ad-required">
                                <td class="form-left"><?php echo _('AD Username'); ?>:</td>
                                <td>
                                    <input type="text" name="ad_username" id="ad_username" <?php if (!empty($user['auth_settings']['ad_username'])) { echo 'value="'.$user['auth_settings']['ad_username'].'"'; } ?> style="min-width: 160px;">
                                </td>
                            </tr>
                            <tr class="hide ldap-required">
                                <td class="form-left"><?php echo _('User\'s Full DN'); ?>:</td>
                                <td>
                                    <input type="text" name="dn" <?php if (!empty($user['auth_settings']['dn'])) { echo 'value="'.$user['auth_settings']['dn'].'"'; } ?> placeholder="cn=John Smith,dn=nagios,dc=com" style="min-width: 280px; width: 75%;">
                                </td>
                            </tr>
                            <tr class="hide">
                                <td></td>
                                <td>
                                    <input type="checkbox"> 
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="span6">
                        <h4><?php echo _('User Access Level'); ?></h4>
                        <p><?php echo _('Set the user level of access inside the UI.'); ?></p>
                        <label class="radio"><input type="radio" name="auth_type" value="admin" <?php if ($admin_checked) { echo "checked"; } if ($user['id'] == 1) { echo ' disabled'; } ?>> <strong><?php echo _('Admin'); ?></strong> - <?php echo _('Full Access. Admins can change/delete all components and settings including indexes, backups, dashboards, queries, and alerts. They can also update the Nagios Log Server configuration and manage users.'); ?></label>
                        <label class="radio"><input type="radio" name="auth_type" value="user" <?php if ($user_checked) { echo "checked"; } if ($user['id'] == 1) { echo ' disabled'; } ?>> <strong><?php echo _('User'); ?></strong> - <?php echo _("Limited Full Access. Users can see everything except the configuration options. However, they can not edit anything except their own profile's password, contact info, and api key."); ?></label>
                        <h4><?php echo _('API Access'); ?></h4>
                        <p><?php echo _('If you want to allow this user to use the external API via an access key.'); ?></p>
                        <label class="radio">
                            <input type="radio" class="yes-admin" name="apiaccess" value="1" <?php if ($user['apiaccess'] || $user['auth_type'] == 'admin') { echo "checked"; } ?>> <?php echo _('Yes'); ?>
                        </label>
                        <label class="radio">
                            <input type="radio" class="no-admin" name="apiaccess" value="0" <?php if (!$user['apiaccess']) { echo "checked"; } else if ($user['auth_type'] == 'admin') { echo 'disabled'; } ?>> <?php echo _('No'); ?>
                        </label>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div style="margin-top: 15px; margin-bottom: 0;" class="form-actions">
                            <button type="submit" class="btn btn-primary"><?php echo _('Save User'); ?></button>
                            <a href="<?php echo site_url('admin/users'); ?>" class="btn"><?php echo _('Cancel'); ?></a>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('input[name="auth_type"]').click(function () {
        var auth_type = $(this).val();
        if (auth_type == 'admin') {
            $('.no-admin').prop('checked', false);
            $('.yes-admin').prop('checked', true);
            $('.no-admin').prop('disabled', true);
        } else {
            $('.no-admin').prop('disabled', false);
        }
    });
});
</script>

<?php echo $footer; ?>