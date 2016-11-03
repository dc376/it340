<?php include_once('../../setlang.inc.php'); ?>

  <div class="row-fluid">
    <div class="span6 section">
      <h5><?php echo _('Options'); ?></h5>
      <div class="editor-option">
        <label class="small"><?php echo _('Header'); ?></label><input type="checkbox" ng-model="panel.header" ng-checked="panel.header">
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Sorting'); ?></label><input type="checkbox" ng-model="panel.sortable" ng-checked="panel.sortable">
      </div>
      <div class="editor-option" style="white-space:nowrap" ng-show='panel.sortable'>
        <label class="small"><?php echo _('Sort'); ?></label>
        <input class="input-small" bs-typeahead="fields.list" ng-model="panel.sort[0]" type="text"></input>
        <i ng-click="set_sort(panel.sort[0])" ng-class="{'fa-chevron-up': panel.sort[1] == 'asc','fa-chevron-down': panel.sort[1] == 'desc'}"></i>
      </div>
      <div class="editor-option"><label class="small"><?php echo _('Font Size'); ?></label>
        <select class="input-small" ng-model="panel.style['font-size']" ng-options="f for f in ['7pt','8pt','9pt','10pt','12pt','14pt','16pt','18pt','20pt','24pt','28pt','32pt','36pt','42pt','48pt','52pt','60pt','72pt']"></select></span>
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Trim Factor'); ?> <tip><?php echo _('Trim fields to this long divided by # of rows. Requires data refresh.'); ?></tip></label>
        <input type="number" class="input-small" ng-model="panel.trimFactor" ng-change="set_refresh(true)">
      </div>
      <br>
      <div class="editor-option">
        <label class="small"><?php echo _('Local Time'); ?> <tip><?php echo _('Adjust time field to browser\'s local time'); ?></tip></label><input type="checkbox" ng-change="set_refresh(true)" ng-model="panel.localTime" ng-checked="panel.localTime">
      </div>
      <div class="editor-option" ng-show="panel.localTime">
        <label class="small"><?php echo _('Time Field'); ?></label>
        <input type="text" class="input-small" ng-model="panel.timeField" ng-change="set_refresh(true)" bs-typeahead="fields.list">
      </div>
    </div>
    <div class="section span6">
      <h5><?php echo _('Columns'); ?></h5>
      <form class="input-append editor-option">
        <input bs-typeahead="fields.list" type="text" class="input-small" ng-model='newfield'>
        <button class="btn" ng-click="panel.fields = _.toggleInOut(panel.fields,newfield);newfield=''"><i class="fa-plus"></i></button>
      </form><br>
      <span style="margin-left:3px" ng-repeat="field in panel.fields" class="label">{{field}} <i class="pointer fa-remove-sign" ng-click="panel.fields = _.toggleInOut(panel.fields,field)"></i></span>
      <h5><?php echo _('Highlighted Fields'); ?></h5>
      <form class="input-append editor-option">
        <input bs-typeahead="fields.list" type="text" class="input-small" ng-model='newhighlight' ng-change="set_refresh(true)">
        <button class="btn" ng-click="panel.highlight = _.toggleInOut(panel.highlight,newhighlight);newhighlight=''"><i class="fa-plus"></i></button>
      </form><br>
      <span style="margin-left:3px" ng-repeat="field in panel.highlight" class="label">{{field}} <i class="pointer fa-remove-sign" ng-click="panel.highlight = _.toggleInOut(panel.highlight,field);set_refresh(true)" ></i></span>
    </div>
  </div>