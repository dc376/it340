<?php include_once('../../setlang.inc.php'); ?>

<div class="row-fluid">
    <h5><?php echo _('Details'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Featured Stat'); ?></label>
      <select ng-change="set_refresh(true)" class="input-small" ng-model="panel.mode" ng-options="f for f in modes"></select>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Field'); ?> <tip><?php echo _('This field must contain a numeric value'); ?></tip></label>
        <input ng-change="set_refresh(true)" placeholder="<?php echo _('Start typing'); ?>" bs-typeahead="fields.list" type="text" class="input-large" ng-model="panel.field">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Unit'); ?></label>
        <input type="text" class="input-large" ng-model="panel.unit">
    </div>

    <h5><?php echo _('Columns'); ?></h5>
    <div class="editor-option" ng-repeat="stat in modes">
      <label class="small">{{stat}}</label><input type="checkbox" ng-model="panel.show[stat]" ng-checked="panel.show[stat]">
    </div>

    <h5><?php echo _('Formating'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Format'); ?></label>
      <select ng-change="set_refresh(true)" class="input-small" ng-model="panel.format" ng-options="f for f in ['number','float','money','bytes']"></select>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Font Size'); ?></label>
      <select class="input-mini" ng-model="panel.style['font-size']" ng-options="f for f in ['7pt','8pt','9pt','10pt','12pt','14pt','16pt','18pt','20pt','24pt','28pt','32pt','36pt','42pt','48pt','52pt','60pt','72pt']"></select></span>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Display Breakdowns'); ?></label>
      <select class="input-mini" ng-model="panel.display_breakdown" ng-options="f for f in ['yes', 'no']"></select></span>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Query column name'); ?></label>
        <input type="text" class="input-large" ng-model="panel.label_name">
    </div>
</div>
