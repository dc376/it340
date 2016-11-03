<?php include_once('../../setlang.inc.php'); ?>

<form name="refreshPopover" class='form-inline input-append' style="margin:0px">
    <label><small><?php echo _('Interval'); ?> (<?php echo _('seconds'); ?>)</small></label><br>
    <input type="number" class="input-mini" ng-model="refresh_interval">
    <button type="button" class="btn" ng-click="set_interval(refresh_interval);dismiss()"><i class="fa-ok"></i></button>
</form>