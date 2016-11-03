<?php include_once('../../setlang.inc.php'); ?>

<div class="editor-row">
  <div class="section">
    <h5><?php echo _('Values'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Chart value'); ?></label>
      <select ng-change="set_refresh(true)" class="input-small" ng-model="panel.mode" ng-options="f for f in ['count','min','mean','max','total']"></select>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Time Field'); ?></label>
      <input ng-change="set_refresh(true)" placeholder="<?php echo _('Start typing'); ?>" bs-typeahead="fields.list" type="text" class="input-small" ng-model="panel.time_field">
    </div>
    <div class="editor-option" ng-show="panel.mode != 'count'">
      <label class="small"><?php echo _('Value Field'); ?> <tip><?php echo _('This field must contain a numeric value'); ?></tip></label>
        <input ng-change="set_refresh(true)" placeholder="<?php echo _('Start typing'); ?>" bs-typeahead="fields.list" type="text" class="input-large" ng-model="panel.value_field">
    </div>
  </div>
  <div class="section">
    <h5><?php echo _('Transform Series'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Derivative'); ?> <tip><?php echo _('Plot the change per interval in the series'); ?></tip></label><input type="checkbox" ng-model="panel.derivative" ng-checked="panel.derivative" ng-change="set_refresh(true)">
    </div>
  </div>
</div>