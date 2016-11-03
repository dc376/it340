<?php echo $header; ?>

<ul class="breadcrumb">
    <li class="active"><?php echo _('My Profile'); ?></li>
</ul>

<script type="text/javascript">
$(document).ready(function() {

    $('#apikey').click(function() { this.select(); });

    $('#update_password_btn').click(function() {
        <?php if ($demo_mode) { ?>
        alert("<?php echo _('This action is not available in Demo Mode.'); ?>");
        <?php } else { ?>
        $('#change_password').modal('show');
        <?php } ?>
    });

    $('#update_pass_btn').click(function() {
        var vars = { old_pass: $('input[name="old_pass"]').val(),
                     new_pass: $('input[name="new_pass"]').val(), 
                     new_pass2: $('input[name="new_pass2"]').val()}

        $('#update_pass_error').hide();
        $('#update_pass_msg').hide();

        $.post(site_url + 'auth/change_password', vars, function(data) {
            if (data.success == 1) { 
                $('#update_pass_msg').removeClass('alert-error').addClass('alert-success').html('<?php echo _('Your password was successfully changed'); ?>').show();
                $('input[type="password"]').val(''); // Clear fields
                $('#update_pass_msg').delay(2000).fadeOut(800);
            } else {
                $('#update_pass_msg').removeClass('alert-success').addClass('alert-error').html(data.errormsg).show();
            }
        }, 'json');
    });

    $('#update_profile_btn').click(function() {
        var vars = { name: $('input[name="name"]').val(),
                     email: $('input[name="email"]').val()}

        <?php if ($demo_mode) { ?>
        alert("<?php echo _('This action is not available in Demo Mode.'); ?>");
        <?php } else { ?>
        $.post(site_url + 'auth/update_profile', vars, function(data) {
            if (data.success == 1) {
                $('#update_profile_msg').removeClass('alert-error').addClass('alert-success').html('<?php echo _('Your profile information has been updated.'); ?>').show();
                $('#update_profile_msg').delay(1000).fadeOut(800);
            } else {
                $('#update_profile_msg').removeClass('alert-success').addClass('alert-error').html(data.errormsg).show();
            }
        }, 'json');
        <?php } ?>
    });

    // Change language
    $('#language').change(function() {
        var language = $(this).val();
        $.post(site_url + 'dashboard/setlanguage', { language: language }, function(data) {
            window.location.reload();
        });
    });

});
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12" style="border-bottom: 1px solid #EEE; padding-bottom: 15px; margin-bottom: 10px;">
            <h2><?php echo _("My Profile"); ?></h2>
            <p><?php echo _("Edit your profile, contact information, account information, and manage your API key if you have API access."); ?></p>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4">
            <h3><?php echo _("Personal Information"); ?></h3>
            <p><?php echo _("Your personal information and account name."); ?></p>
            <div id="update_profile_msg" class="alert hide"></div>

            <table>
                <tr>
                    <td class="form-left"><?php echo _("Username"); ?>:</td>
                    <td><input type="text" value="<?php echo $user['username']; ?>" disabled="disabled"></td>
                </tr>
                <tr>
                    <td class="form-left"><?php echo _("Full Name"); ?>:</td>
                    <td><input type="text" name="name" value="<?php echo $user['name']; ?>" class="input-medium"></td>
                </tr>
                <tr>
                    <td class="form-left"><?php echo _("Email"); ?>:</td>
                    <td><input type="text" name="email" value="<?php echo $user['email']; ?>" class="input-xlarge"></td>
                </tr>
                <tr>
                    <td class="form-left"></td>
                    <td><button id="update_profile_btn" class="btn btn-primary"><?php echo _('Update'); ?></button></td>
                </tr>
            </table>

        </div>
        <div class="span4">
            <h3><?php echo _('Account Actions'); ?></h3>
            <p><?php echo _('Make changes to your account-specific settings.'); ?></p>

            <p class="input-prepend">
                <span class="add-on"><i class="icon-flag"></i> <?php echo _('Language'); ?></span>
                <select id="language" name="language" class="input-medium">
                    <option value="default" <?php if ($user_language == 'default') { echo 'selected'; } ?>><?php echo _('Default'); ?></option>
                    <?php foreach ($languages as $l) { ?>
                    <option value="<?php echo $l; ?>" <?php if ($user_language == $language && $language == $l) { echo 'selected'; } ?>>
                        <?php echo get_language_name($l); ?>
                    </option>
                    <?php } ?>
                </select>
            </p>
            <p><a role="button" class="btn" id="update_password_btn"><i class="icon-lock"></i> <?php echo _('Change Password'); ?></a></p>
        </div>
        <div class="span4">
            <h3><?php echo _('API Access / Key'); ?></h3>
            <p><?php echo _('Your unique API key used for external API access. You can read more about what you can do with the API in the API documents in the help section.'); ?></p>
            <?php if ($user['apiaccess']) { ?>
            <p><strong><?php echo _('Access Level'); ?>:</strong> <?php if ($is_admin) { echo _('Full'); } else { echo _('Read-Only'); } ?></p>
            <div><input type="text" value="<?php echo $user['apikey']; ?>" class="no-highlight" style="cursor: pointer; box-shadow: none; width: 320px;" id="apikey" maxlength="32" readonly></div>
            <div>
                <?php echo form_open('profile/newkey'); ?>
                <input type="hidden" value="<?php echo $user['id']; ?>" name="user_id_verify" />
                <button type="submit" class="btn btn-primary"><i class="icon-refresh icon-white"></i> <?php echo _('Generate New Key'); ?></button>
                <?php echo form_close(); ?>
            </div>
            <?php } else { ?>
            <p><strong><?php echo _('No API Access'); ?></strong></p>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div id="change_password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="change_password_header" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="change_password_header"><?php echo _('Change Password'); ?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo _('Your new password must be 8 or more characters long for security.'); ?></p>
        <div id="update_pass_msg" class="alert hide"></div>
        <table style="margin-top: 20px;">
            <tr>
                <td class="form-left"><?php echo _('Old Password'); ?>:</td>
                <td><input type="password" name="old_pass" class="input-medium" /></td>
            </tr>
            <tr>
                <td class="form-left"><?php echo _('New Password'); ?>:</td>
                <td><input type="password" name="new_pass" class="input-medium" /></td>
            </tr>
            <tr>
                <td class="form-left"><?php echo _('Confirm New Password'); ?>:</td>
                <td><input type="password" name="new_pass2" class="input-medium" /></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo _('Cancel'); ?></button>
        <button id="update_pass_btn" class="btn btn-primary"><?php echo _('Update'); ?></button>
    </div>
</div>


<?php echo $footer; ?>