<?php echo $header; ?>

<div id="conatiner">
    <div class="row-fluid">
        <div class="span12">
            <?php if ($subscription): ?>
                <div class="install-title">
                    <h2><?php echo _('Nagios Log Server Subscription Expired'); ?></h2>
                    <p><?php echo _('Please enter your new activation key to renew your subscription.'); ?></p>
                </div>

            <?php else: ?>
                <div class="install-title">
                    <h2><?php echo _('Trial License Expired!'); ?></h2>
                    <p><?php echo _('Thank you for trying Nagios Log Server. Sadly, your free trial license has expired.'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6 offset3">
            <?php if (!empty($error)) { ?>
            <div class="alert alert-error" style="text-align: center; margin-top: 30px;"><?php echo $error; ?></div>
            <?php } ?>
        </div>
    </div>
    <div class="row-fluid" style="margin-top: 20px;">
        <div class="span4 offset4">
            <div class="well" style="text-align: center; padding-top: 35px;">
                <?php echo form_open('', 'form-horizontal'); ?>
                <input type="text" name="key" style="margin: 0; width: 304px;" placeholder="<?php echo gettext("License Key"); ?>">
                <button type="submit" value="1" name="set" class="btn btn-primary"><?php echo _('Set Key'); ?></button>
                <?php form_close(); ?>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <p style="text-align: center;"><?php echo _('If you do not have a license key yet, you can purchase one') . ' <a href="https://www.nagios.com/products/nagios-log-server" target="_blank">' . _('from the Nagios website.').'</a>'; ?></p>
        </div>
    </div>
</div>

<?php echo $footer; ?>