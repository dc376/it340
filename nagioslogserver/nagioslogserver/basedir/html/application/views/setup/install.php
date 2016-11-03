<?php echo $header; ?>

<script type="text/javascript">
$(document).ready(function() {
    var temp;
    $('input[name="key_type"]').click(function() {
        if ($(this).val() == 'trial') {
            temp = $('input[name="key"]').val();
            $('input[name="key"]').val('');
            $('input[name="key"]').attr('disabled', true);
        } else {
            $('input[name="key"]').val(temp);
            $('input[name="key"]').attr('disabled', false);
        }
    });
	$('input[type=radio][name=install_type]').change(function() {
		$('.install_type').toggle('slow');
	});
	<?php if ($install_type == 'addnode') { echo '$(\'.install_type\').toggle();'; } ?>
    $('form').submit(function(e) {
        $(this).find('button[name="finish"]').attr('disabled', true).text("<?php echo _('Please Wait...'); ?>");
    });
});
</script>

<?php echo form_open(); ?>
<div id="container">
    <div class="row-fluid">
        <div class="span12">
            <div class="install-title">
                <h2><?php echo _('Final Installation Steps'); ?></h2>
                <p><?php echo _('Almost done! You can create a fresh install or connect to existing cluster.'); ?></p>
            </div>
        </div>
    </div>
    <div class="row-fluid" style="margin-bottom: 10px;">
        <div class="span6 offset3">
            <?php if (!empty($error)) { ?>
            <div class="alert alert-error" style="text-align: center; margin-top: 20px;"><?php echo $error; ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="row-fluid" style="margin-bottom: 10px;">
        <div class="span2 offset3">
            <h4><?php echo _('New Install?'); ?></h4>
            <p><?php echo _('Is this a new install or are we adding a Instance to an existing cluster?'); ?></p>
        </div>
        <div class="span4">
            <div class="well">
                <table style="margin: 0 auto;">
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <label class="radio" style="display: inline-block; margin: 0 15px 10px 0;"><input type="radio" name="install_type" value="new" <?php if ($install_type != 'addnode') { echo 'checked'; } ?>> <?php echo _('New Install'); ?></label>
                            <label class="radio" style="display: inline-block;"><input type="radio" value="addnode" name="install_type" <?php if ($install_type == 'addnode') { echo 'checked'; } ?>> <?php echo _('Add Instance'); ?></label>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
	<div class="row-fluid install_type" style="margin-bottom: 10px;">
        <div class="span2 offset3">
            <h4><?php echo _('License Setup'); ?></h4>
            <p><?php echo _('Choose a trial license, enter your key, or') . ' <a href="https://www.nagios.com/products/nagios-log-server" target="_blank">' . _('get a license now') . '</a>.'; ?></p>
        </div>
        <div class="span4">
            <div class="well">
                <table style="margin: 0 auto;">
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <label class="radio" style="display: inline-block; margin: 0 15px 10px 0;"><input type="radio" name="key_type" value="trial" checked> <?php echo _('Free 60 Day Trial'); ?></label>
                            <label class="radio" style="display: inline-block;"><input type="radio" value="key" name="key_type"> <?php echo _('I already have a key'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="form-left"><?php echo _('License Key'); ?>:</td>
                        <td><input type="text" class="input-xlarge" style="margin: 0; width: 296px;" name="key" value="" disabled></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row-fluid install_type addnew">
        <div class="span2 offset3">
            <h4><?php echo _('Admin Account Setup'); ?></h4>
            <p><?php echo _('Choose or enter your admin profile and account settings. The default username is nagiosadmin, which you can change.'); ?></p>
        </div>
        <div class="span4">
            <div class="well">
                <table style="margin: 0 auto;">
                    <tr>
                        <td class="form-left"><?php echo _('Username'); ?>:</td>
                        <td><input type="text" name="username" value="<?php echo ($username == '') ? 'nagiosadmin' : $username; ?>"></td>
                    </tr>
                    <tr>
                        <td class="form-left"><?php echo _('Password'); ?>:</td>
                        <td><input type="password" name="password" class="input-medium"></td>
                    </tr>
                    <tr>
                        <td class="form-left"><?php echo _('Confirm Password'); ?>:</td>
                        <td><input type="password" name="conf_password" class="input-medium"></td>
                    </tr>
                    <tr>
                        <td class="form-left"><?php echo _('Email'); ?>:</td>
                        <td><input type="text" name="email" value="<?php echo $email; ?>" class="input-xlarge"></td>
                    </tr>
                    <tr>
                        <td class="form-left"><?php echo _('Language'); ?>:</td>
                        <td>
                            <select id="language" name="language" class="input-medium">
                                <option value="default" <?php if ($user_language == 'default') { echo 'selected'; } ?>><?php echo _('Default'); ?></option>
                                <?php foreach ($languages as $l) { ?>
                                <option value="<?php echo $l; ?>" <?php if ($user_language == $language && $language == $l) { echo 'selected'; } ?>>
                                    <?php echo get_language_name($l); ?>
                                </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="form-left"><?php echo _('Timezone'); ?>:</td>
                        <td>
                            <select name="timezone" style="min-width: 300px;">
                                <?php
                                $cur_timezone = get_current_timezone();
                                if (!empty($set_timezone)) { $cur_timezone = $set_timezone; }
                                foreach (get_timezones() as $name => $val) {
                                ?>
                                <option value="<?php echo $val; ?>" <?php if ($val == $cur_timezone) { echo 'selected'; } ?>><?php echo $name; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="text-align: right;">
                <button type="submit" value="1" name="finish" class="btn btn-primary"><?php echo _('Finish Installation'); ?> <i class="icon-chevron-right icon-white"></i></button>
            </div>
        </div>
    </div>
	<div class="row-fluid install_type addnode" style="display:none">
        <div class="span2 offset3">
            <h4><?php echo _('Connect to Existing Cluster'); ?></h4>
            <p><?php echo _('Enter your Cluster ID and hostname or IP address from one instance of the existing cluster. The Cluster ID may be obtained from Administration -> Cluster Status from any active instance.'); ?></p>
        </div>
        <div class="span4">
            <div class="well">
                <table style="margin: 0 auto;">
                    <tr>
                        <td class="form-left"><?php echo _('Hostname'); ?>:</td>
                        <td><input type="text" name="hostname" value="<?php echo $hostname; ?>" class="input-xlarge"></td>
                    </tr>
                    <tr>
                        <td class="form-left"><?php echo _('Cluster ID'); ?>:</td>
                        <td><input type="text" name="cluster_id" value="<?php echo $cluster_id; ?>" class="input-xlarge"></td>
                    </tr>
                </table>
            </div>
            <div style="text-align: right;">
                <button type="submit" value="1" name="finish" class="btn btn-primary"><?php echo _('Finish Installation'); ?> <i class="icon-chevron-right icon-white"></i></button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<?php echo $footer; ?>