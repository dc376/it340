<?php echo $header; ?>

<div id="container" style="position: relative; top: 50px;">
    <div class="row-fluid">
        <div class="span12">
            <div class="install-title">
                <h2><?php echo _("Waiting for Database Startup"); ?></h2>
                <p><?php echo _("It looks like your local elasticsearch service is starting."); ?></p>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span6 offset3" style="text-align: center;">
            <h4><?php echo _("Why am I getting this error?"); ?></h4>
            <p><?php echo _("Elasticsearch can take a little while to start up because of it's indexing. This may take a few seconds."); ?></p>
            <p><strong><?php echo _("The page will refresh automatically after 5 seconds..."); ?></strong></p>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    setInterval(refresh_page, 5000);
});

function refresh_page() {
    location.reload(true);
}
</script>

<?php echo $footer; ?>