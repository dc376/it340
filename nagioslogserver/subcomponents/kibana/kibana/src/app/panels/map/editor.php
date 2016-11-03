<?php include_once('../../setlang.inc.php'); ?>

  <div class="editor-row">
    <div class="editor-option">
      <form>
        <h6><?php echo _('Field'); ?> <tip><?php echo _('2 letter country or state code'); ?></tip></h6>
        <input bs-typeahead="fields.list" type="text" class="input-small" ng-model="panel.field" ng-change="set_refresh(true)">
      </form>
    </div>
    <div class="editor-option">
      <h6><?php echo _('Max'); ?> <tip><?php echo _('Maximum countries to plot'); ?></tip></h6>
      <input class="input-mini" type="number" ng-model="panel.size" ng-change="set_refresh(true)">
    </div>
    <div class="editor-option"><h6><?php echo _('Map'); ?></h6>
      <select ng-change="$emit('render')" class="input-small" ng-model="panel.map" ng-options="f for f in ['world','europe','usa']"></select>
    </div>
  </div>
