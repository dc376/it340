<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Update License'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('Update License'); ?></h2>
                <p><?php echo _('Update your Nagios Log Server license code. If you do not have one, you can'); ?> <a href="https://www.nagios.com/products/nagios-log-server/pricing/buy" target="_new"><?php echo _("purchase one"); ?></a>.</p>
                <?php if (is_trial_license()) { ?>
                    <?php if (get_trial_days_left() > 60) { ?>
                        <div class="alert alert-error"><?php echo _('Update your license key. Your trial will end in'); ?> <strong><?php echo get_trial_days_left(); ?></strong> <?php echo _('days'). "( 60 + " . (get_trial_days_left() - 60) . " Bonus Days )"; ?>.</div>
                    <?php } else { ?>
                        <div class="alert alert-error"><?php echo _('Update your license key. Your trial will end in'); ?> <strong><?php echo get_trial_days_left(); ?></strong> <?php echo _('days'); ?>.</div>
                    <?php } ?>
                <?php } else if (is_subscription_license() == true && is_subscription_expired()) { ?>
                <div class="alert alert-error"><?php echo _("This subscription for Nagios Log Server has expired"); ?></div>
                <?php } else if (is_subscription_license() == true && get_subscription_days_left() < 30) { ?>
                <div class="alert alert-error"><?php echo _("The subscription to Nagios Log Server will expire in"); ?> <?php echo get_subscription_days_left(); ?> <?php echo _("days"); ?></div>
                <?php } else if ($error) { ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
                <?php } else { ?>
                <div class="alert alert-success"><?php echo _('Your license key is valid'); ?></div>
                <?php } ?>
                <div class="form-horizontal">
                    <?php echo form_open('admin/license'); ?>
                    <strong><?php echo _('License Key'); ?>:</strong>
                    <input <?php if ($demo_mode) { echo 'disabled'; } ?> type="text" name="key" style="width: 304px;" value="<?php if (!$demo_mode) { echo get_license_key(); } else { echo 'DEMO MODE'; } ?>">
                    <button <?php if ($demo_mode) { echo 'disabled'; } ?> type="submit" value="1" name="setkey" class="btn btn-primary"><?php echo _('Set Key'); ?> <i class="icon-chevron-right icon-white"></i></button>
                    <?php echo form_close(); ?>
                </div>
                 <div class="row-fluid">
                 <div class="span6">
                        <div class="grid" style="margin:0;">
                            <div class="grid-title">
                                <div class="pull-left">
                                    <div class="table-title"><i class="fa fa-sitemap"></i></div>
                                    <span><?php echo _("License Information"); ?></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="grid-content overflow">
                                <table class="table table-striped table-hover table-bordered center-table">
                                    <tbody>
                                        <?php echo get_license_info(get_license_key()); ?>
                                    </tbody>
                                </table>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>