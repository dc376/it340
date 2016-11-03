<?php include_once('../../setlang.inc.php'); ?>

<div class="editor-row">
  <div class="section">
    <h5><?php echo _('Values'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Chart value'); ?></label>
      <select ng-change="set_refresh(true)" class="input-small" ng-model="panel.mode" ng-options="f for f in ['count','min','mean','max','total']"></select>
    </div>
    <div class="editor-option" ng-show="panel.mode != 'count'">
      <label class="small"><?php echo _('Value Field'); ?> <tip><?php echo _('This field must contain a numeric value'); ?></tip></label>
        <input ng-change="set_refresh(true)" placeholder="<?php echo _("Start typing"); ?>" bs-typeahead="fields.list" type="text" class="input-medium" ng-model="panel.value_field">
    </div>
  </div>
  <div class="section">
    <h5><?php echo _('Transform Series'); ?></h5>
    <div class="editor-option" ng-show="panel.mode != 'count'">
      <label class="small"><?php echo _('Scale'); ?></label>
        <input type="text" class="input-mini" ng-model="panel.scale">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Seconds'); ?> <tip><?php echo _('Normalize intervals to per-second'); ?></tip></label><input type="checkbox" ng-model="panel.scaleSeconds" ng-checked="panel.scaleSeconds">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Derivative'); ?> <tip><?php echo _('Plot the change per interval in the series'); ?></tip></label><input type="checkbox" ng-model="panel.derivative" ng-checked="panel.derivative" ng-change="set_refresh(true)">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Zero fill'); ?> <tip><?php echo _('Fills zeros in gaps.'); ?></tip></label><input type="checkbox" ng-model="panel.zerofill" ng-checked="panel.zerofill" ng-change="set_refresh(true)">
    </div>
  </div>
  <div class="section">
  <h5><?php echo _('Time Options'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Time Field'); ?></label>
        <input ng-change="set_refresh(true)" placeholder="<?php echo _("Start typing"); ?>" bs-typeahead="fields.list" type="text" class="input-small" ng-model="panel.time_field">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Time correction'); ?></label>
      <select ng-model="panel.timezone" class='input-small' ng-options="f for f in ['browser','utc']"></select>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Auto-interval'); ?></label><input type="checkbox" ng-model="panel.auto_int" ng-checked="panel.auto_int" />
    </div>
    <div class="editor-option" ng-show='panel.auto_int'>
      <label class="small"><?php echo _('Resolution'); ?> <tip><?php echo _('Shoot for this many data points, rounding to sane intervals'); ?></tip></label>
      <input type="number" class='input-mini' ng-model="panel.resolution" ng-change='set_refresh(true)'/>
    </div>
    <div class="editor-option" ng-hide='panel.auto_int'>
      <label class="small"><?php echo _('Interval'); ?> <tip><?php echo _('Use Elasticsearch date math format'); ?> (eg 1m, 5m, 1d, 2w, 1y)</tip></label>
      <input type="text" class='input-mini' ng-model="panel.interval" ng-change='set_refresh(true)'/>
    </div>
  </div>
</div>