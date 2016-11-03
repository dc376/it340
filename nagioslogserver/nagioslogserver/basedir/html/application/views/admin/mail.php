<?php echo $header; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#test-settings").bind('click', function() {
            btn = $(this);
            btn.button('loading');
            postvars = {}
            url = '<?php echo site_url('admin/test_mail_settings') ?>';
            $.post(url, postvars, function(data) {
                r = $.parseJSON(data);
                if(r.result == 'success') {
                    $('#test-success').html('<?php echo _('The email was sent successfully to'); ?> <b>' + r.email + '</b> <?php echo _('Check your inbox to ensure you received the message'); ?>.').show();
                    $('#test-error').hide();
                } else {
                    $('#test-success').hide();
                    $('#test-error').html(r.msg).show();
                }
                btn.button('reset');
            });
            return false;
        });
    });
</script>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Mail Settings'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('Mail Settings'); ?></h2>
                <p><?php echo _('Set the settings for sending outgoing mail such as notifications. From and Reply-to names and emails are defaulted to what is shown below.'); ?></p>

                <?php if (!empty($success)) { ?><div class="alert alert-success"><?php echo $success; ?></div><?php } ?>
                <?php if ($error) { ?><div class="alert alert-error"><?php echo $error; ?></div><?php } ?>
            
                <div id="test-error" class="alert alert-error hide"></div>
                <div id="test-success" class="alert alert-success hide"></div>

                <?php echo form_open('admin/mail', array("class" => "form-horizontal")); ?>
                <div class="well" style="float: left; padding: 30px 60px 10px 20px;">
                    <div class="control-group">
                        <label class="control-label" for="email_from"><?php echo _("From Email"); ?></label>
                        <div class="controls">
                            <input type="text" style="width: 140px;" id="email_from_name" name="email_from_name" value="<?php echo $email_from_name; ?>" placeholder="<?php echo _('Nagios Log Server'); ?>">
                            <input type="text" id="email_from" name="email_from" value="<?php echo htmlentities($email_from, ENT_COMPAT, 'UTF-8'); ?>" placeholder="logserver@mydomain.com">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email_reply_to"><?php echo _("Reply-To Email"); ?></label>
                        <div class="controls">
                            <input type="text" style="width: 140px;" id="email_reply_to_name" name="email_reply_to_name" value="<?php echo $email_reply_to_name; ?>" placeholder="<?php echo _('Nagios Log Server'); ?>">
                            <input type="text" id="email_reply_to" name="email_reply_to" value="<?php echo htmlentities($email_reply_to, ENT_COMPAT, 'UTF-8'); ?>" placeholder="root@localhost">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email_method"><?php echo _("Send Email Method"); ?></label>
                        <div class="controls">
                            <select name="email_method" id="email_method">
                                <option value="mail" <?php if ($email_method == 'mail') { echo "selected"; } ?>><?php echo _("PHP Mail"); ?></option>
                                <option value="smtp" <?php if ($email_method == 'smtp') { echo "selected"; } ?>><?php echo _("SMTP Server"); ?></option>
                            </select>
                        </div>
                    </div>
                    <div id="smtp-settings" <?php if ($email_method == 'mail' || empty($email_method)) { echo 'class="hide"'; } ?>>
                        <div class="control-group">
                            <label class="control-label" for="smtp_host"><?php echo _("SMTP Server Address"); ?></label>
                            <div class="controls">
                                <input type="text" name="smtp_host" value="<?php echo $smtp_host; ?>" id="smtp_host">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="smtp_crypto"><?php echo _("SMTP Security"); ?></label>
                            <div class="controls">
                                <select name="smtp_crypto" id="smtp_crypto">
                                    <option value="" <?php if (empty($smtp_crypto)) { echo "selected"; } ?>>None</option>
                                    <option value="ssl" <?php if ($smtp_crypto == 'ssl') { echo "selected"; } ?>>SSL</option>
                                    <option value="tls" <?php if ($smtp_crypto == 'tls') { echo "selected"; } ?>>TLS</option>
                                    <option value="tcp" <?php if ($smtp_crypto == 'tcp') { echo "selected"; } ?>>STARTTLS</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="smtp_port"><?php echo _("SMTP Port"); ?></label>
                            <div class="controls">
                                <input type="text" name="smtp_port" style="width: 40px;" value="<?php if (!empty($smtp_port)) { echo $smtp_port; } else { echo '25'; } ?>" placeholder="25" id="smtp_port">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="smtp_user"><?php echo _("SMTP Username"); ?></label>
                            <div class="controls">
                                <input type="text" name="smtp_user" style="width: 200px;" value="<?php echo $smtp_user; ?>" id="smtp_user">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="smtp_pass"><?php echo _("SMTP Password"); ?></label>
                            <div class="controls">
                                <input type="password" name="smtp_pass" style="width: 200px;" value="<?php echo $smtp_pass; ?>" id="smtp_pass">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <button autocomplete="false" id="test-settings" data-toggle="button" data-loading-text="<?php echo _('Please wait'); ?>..." class="btn btn-info"><?php echo _('Test Settings'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo _("Save Settings"); ?></button>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#email_method').change(function() {
        var method = $(this).val();
        if (method == "smtp") {
            $('#smtp-settings').show();
        } else {
            $('#smtp-settings').hide();
        }
    });
});
</script>

<?php echo $footer; ?>