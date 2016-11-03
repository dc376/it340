<?php echo $header; ?>

<div id="container" style="position: relative; top: 50px;">
    <div class="row-fluid">
        <div class="span12">
            <div class="install-title">
                <h2><?php echo _("Elasticsearch Database Offline"); ?></h2>
                <p><?php echo _("It looks like your local elasticsearch service isn't running."); ?></p>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6 offset3" style="text-align: center;">
            <h4><?php echo _("Why am I getting this error?"); ?></h4>
            <p><?php echo _("Elasticsearch must run locally on all Log Servers due to security restrictions when accessing the database."); ?></p>
            <p><?php echo _("You may need to run"); ?> <code style="display: inline; padding: 3px 10px 4px 10px;">service elasticsearch start</code> <?php echo _("to start it."); ?></p>
        </div>
    </div>
</div>

<?php echo $footer; ?>