<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('admin/users'); ?>"><?php echo _('Users'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Add Users from LDAP/AD'); ?></li>
</ul>

<script type="text/javascript">
$(document).ready(function() {

    $('#create').click(function() {

        $.get(site_url+'api/system/get_users', { }, function(data) {
            var alerts = [];
            var all_usernames = [];

            $.each(data, function(k, v) {
                all_usernames.push(v.username);
            });

            $.each($('.email'), function(k, v) {
                var email = $(v).val();
                if (email == '' || email.length < 4 || email.indexOf('@') == -1) {
                    $(v).addClass('req');
                    if (alerts.indexOf('email') == -1) {
                        alerts.push('email');
                    }
                }
            });

            $.each($('.username'), function(k, v) {
                if (all_usernames.indexOf($(v).val()) != -1) {
                    $(this).addClass('req');
                    if (alerts.indexOf('username') == -1) {
                        alerts.push('username');
                    }
                }
            });
            
            // Submit the form manually or show an error...
            if (alerts.length == 0) {
                $('#main-alert').hide();
                $('form').submit();
            } else {
                var alert_text = '';
                $.each(alerts, function(k, v) {
                    if (v == 'email') {
                        alert_text += '<?php echo _("Must enter a valid email address for each user."); ?> ';
                    } else if (v == 'username') {
                        alert_text += '<?php echo _("Must be a unique username, the username(s) already exist."); ?> ';
                    }
                });

                $('#main-alert-text').html(alert_text);
                $('#main-alert').show();
            }

        });

        return false;
    });

    $('.email').blur(function() {
        if ($(this).hasClass('req')) {
            if ($(this).val() != '') {
                $(this).removeClass('req');
            }
        }
    });

    $('.username').blur(function() {
        $(this).removeClass('req');
    });

});
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('LDAP / Active Directory Import Users'); ?></h2>
                <p><?php echo _('Set up the new users. Add missing information and update the account.'); ?></p>
                <h4><?php echo _('Fill Out New User Information'); ?></h4>

                <div class="alert alert-error hide" id="main-alert">
                    <span id="main-alert-text"></span>
                </div>

                <?php echo form_open('admin/users/import/complete'); ?>
                <table class="table table-striped table-bordered table-hover import-users-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th><?php echo _('Full Name'); ?></th>
                            <th><?php echo _('Username'); ?> <span class="red tt_bind" title="Required">*</span></th>
                            <th><?php echo _('Email Address'); ?> <span class="red tt_bind" title="Required">*</span></th>
                            <th><?php echo _('User Type'); ?> <span class="red tt_bind" title="Required">*</span></th>
                            <th><?php echo _('API Access'); ?></th>
                            <th><?php echo _('Auth Type'); ?></th>
                            <th><?php echo _('Auth Identifier'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($new_users as $i => $user) { ?>
                        <tr>
                            <td>
                                <input type="checkbox" value="1" name="import[<?php echo $i; ?>]" checked style="margin-top: 9px;" class="tt_bind" title="<?php echo _('Select or de-select user to be created.'); ?>">
                            </td>
                            <td>
                                <input type="text" class="name" name="full_name[<?php echo $i; ?>]" value="<?php echo $user['firstname'] . ' ' . $user['lastname']; ?>">
                            </td>
                            <td>
                                <input type="text" class="username" name="username[<?php echo $i; ?>]" value="<?php echo $user['username']; ?>" style="width: 120px;">
                            </td>
                            <td>
                                <input type="text" class="email" name="email[<?php echo $i; ?>]" value="<?php echo $user['email']; ?>">
                            </td>
                            <td>
                                <select name="level[<?php echo $i; ?>]" style="width: 100px;">
                                    <option value="user"><?php echo _('User'); ?></option>
                                    <option value="admin"><?php echo _('Admin'); ?></option>
                                </select>
                            </td>
                            <td>
                                <select name="apiaccess[<?php echo $i; ?>]" style="width: 70px;">
                                    <option value="1"><?php echo _('Yes'); ?></option>
                                    <option value="0" selected><?php echo _('No'); ?></option>
                                </select>
                            </td>
                            <td>
                                <input type="hidden" name="account_type[<?php echo $i; ?>]" value="<?php echo $server['type']; ?>">
                                <input type="hidden" name="server_id[<?php echo $i; ?>]" value="<?php echo $server['id']; ?>">
                                <input type="text" value="<?php if ($server_type == "ad") { echo _('Active Directory'); } else if ($server_type == "ldap") { echo _('LDAP'); } ?>" disabled style="width: 100px;">
                            </td>
                            <?php if ($server_type == "ad") { ?>
                            <td>
                                <input type="hidden" name="ad_username[<?php echo $i; ?>]" value="<?php echo $user['username']; ?>">
                                <input type="text" value="<?php echo $user['username'].$server['suffix']; ?>" disabled style="width: auto;">
                            </td>
                            <?php
                            } else if ($server_type == "ldap") {
                                $size = strlen($user['dn']);
                                $pixels = $size*8;
                                if ($pixels < 100) { $pixels = 100; } else if ($pixels > 300) { $pixels = 300; }
                            ?>
                            <td>
                                <input type="hidden" name="dn[<?php echo $i; ?>]" value="<?php echo $user['dn']; ?>">
                                <input type="text" value="<?php echo $user['dn']; ?>" disabled style="width: <?php echo $pixels; ?>px;">
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <button type="submit" id="create" class="btn btn-primary"><?php echo _('Create Users'); ?></button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>