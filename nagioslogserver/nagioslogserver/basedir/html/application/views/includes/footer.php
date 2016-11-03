    </div>
    <div class="push"></div>
</div>
<div id="footer" class="no-print">
    <div class="well">
        <div class="row-fluid" style="height: 15px;">
            <div class="span6">
                <?php echo _('Nagios Log Server'); ?> <?php if ($logged_in) { ?>&nbsp;&nbsp;&bull;&nbsp;&nbsp; <?php echo get_product_version(); ?> &nbsp;&nbsp;&bull;&nbsp;&nbsp; <a target="_blank" class="updates" href="https://www.nagios.com/checkforupdates/?product=nagioslogserver&version=<?php echo get_product_version(); ?>"><?php echo _('Check for updates'); ?> <i class="icon-share"></i></a><?php } ?>
            </div>
            <div class="span6" style="text-align: right;">
                <a target="_blank" href="https://www.nagios.com/products/nagios-log-server"><?php echo _('About'); ?></a> &nbsp;&nbsp;|&nbsp;&nbsp; <a target="_blank" href="https://www.nagios.com/legal"><?php echo _('Legal'); ?></a> &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo _('Copyright'); ?> &copy; 2014-<?php echo date('Y'); ?> <a target="_blank" href="https://www.nagios.com/"><?php echo _('Nagios Enterprises, LLC'); ?></a>
            </div>
        </div>
    </div>
</div>

</body>
</html>