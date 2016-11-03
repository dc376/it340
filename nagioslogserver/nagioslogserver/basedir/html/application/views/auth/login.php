<?php echo $header; ?>

<script>
$(document).ready(function() {

    // Get url hash and send it to the backend...
    // since we need to somehow get the browser to redirect properly
    // to the kibana dashboards when not logged in
    var hash = window.location.hash;
    if (hash != '') {
        $.post(site_url+'auth/set_redirect_hash', { hash: hash });
    }

});
</script>

<div class="container" style="margin: 20px auto; width: 1170px;">
    <div class="row">
        <div class="span4">
            <div class="well">
                <?php echo form_open($url, array('class' => 'form-horizontal login')); ?>
                    <h2 class="login-header"><?php echo _('Log In'); ?></h2>
                    <?php if ($error) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>
                    <?php if ($message) { echo '<div class="alert alert-info">' . $message . '</div>'; } ?>
                    <fieldset>
                        <input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo _('Username'); ?>" autofocus><br/>
                        <input type="password" name="password" placeholder="<?php echo _('Password'); ?>"><br/>
                        <label class="checkbox"><input type="checkbox" name="remember" value="1"> <?php echo _('Keep me logged in');?></label>
                        <div class="row-fluid">
                            <div class="span4">
                            <button type="submit" class="btn btn-primary"><?php echo _('Log In'); ?></button>
                            </div>
                            <div class="span8 login-forgot-password">
                                <a href="<?php echo site_url('forgot_password'); ?>"><?php echo _('Forgot your password?'); ?></a>
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="span8">
            <img src="<?php echo base_url('media/images/nagioslogserver_splash.png'); ?>" style="padding-bottom: 10px;" />
            <h4><?php echo _('About Nagios Log Server'); ?></h4>
            <p><?php echo _('Nagios Log Server is an enterprise-class log analysis solution that provides organizations with insight into logged errors before problems affect critical business processes. For more information on Nagios Log Server, visit the'); ?> <a href="https://www.nagios.com/products/nagios-log-server"><?php echo _('Nagios Log Server product page'); ?></a>.</p>
            <h4><?php echo _('Nagios Learning Opportunities'); ?></h4>
            <p><?php echo _('Learn about Nagios'); ?> <a href="https://www.nagios.com/services/training"><?php echo _("training"); ?></a> <?php echo _("and"); ?> <a href="https://www.nagios.com/services/certification"><?php echo _("certification"); ?></a> <?php echo _("programs"); ?>.</p>
            <p><?php echo _('Want to learn about how other experts are utilizing Nagios? Do not miss your chance to attend the next'); ?> <a href="https://go.nagios.com/nwcna"><?php echo _("Nagios World Conference"); ?></a> <?php echo _("held every year in St. Paul, Minnesota"); ?>.</p>
            <h4><?php echo _('Contact Us'); ?></h4> 
            <p><?php echo _('Have a question or technical problem? Contact us today'); ?>:</p>
            <table>
                <tr>
                    <td><?php echo _('Support'); ?>:</td>
                    <td><a href="https://support.nagios.com/forum/"><?php echo _('Online Support Forum'); ?></a></td>
                </tr>
                <tr>
                    <td><?php echo _('Sales'); ?>:</td>
                    <td><?php echo _('Phone'); ?>: (651) 204-9102<br/><?php echo _('Fax'); ?>: (651) 204-9103<br/><?php echo _('Email'); ?>: sales@nagios.com</td>
                </tr>
                <tr>
                    <td><?php echo _('Web'); ?></td>
                    <td><a href="https://www.nagios.com">www.nagios.com</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php echo $footer; ?>
