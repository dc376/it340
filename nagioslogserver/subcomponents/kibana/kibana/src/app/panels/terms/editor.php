<?php include_once('../../setlang.inc.php'); ?>

  <div class="editor-row">
    <div class="section">
      <h5><?php echo _('Parameters'); ?></h5>
      <div class="editor-option">
        <label class="small"><?php echo _('Terms mode'); ?></label>
        <select class="input-medium" ng-model="panel.tmode" ng-options="f for f in ['terms','terms_stats']" ng-change="set_refresh(true)"></select>
      </div>
      <div class="editor-option" ng-show="panel.tmode == 'terms_stats'">
        <label class="small"><?php echo _('Stats type'); ?></label>
        <select class="input-medium" ng-model="panel.tstat" ng-options="f for f in ['count', 'total_count', 'min', 'max', 'total', 'mean']"></select>
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Field'); ?></label>
        <input type="text" class="input-small" bs-typeahead="fields.list" ng-model="panel.field" ng-change="set_refresh(true)">
      </div>
      <div class="editor-option" ng-show="panel.tmode == 'terms_stats'">
        <label class="small"><?php echo _('Value field'); ?></label>
        <input type="text" class="input-small" bs-typeahead="fields.list" ng-model="panel.valuefield" ng-change="set_refresh(true)">
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Length'); ?></label>
        <input class="input-small" type="number" ng-model="panel.size" ng-change="set_refresh(true)">
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Order'); ?></label>
        <select class="input-medium" ng-model="panel.order" ng-options="f for f in ['count','term','reverse_count','reverse_term']" ng-change="set_refresh(true)"  ng-show="panel.tmode == 'terms'"></select>
        <select class="input-medium" ng-model="panel.order" ng-options="f for f in ['term', 'reverse_term', 'count', 'reverse_count', 'total', 'reverse_total', 'min', 'reverse_min', 'max', 'reverse_max', 'mean', 'reverse_mean']" ng-change="set_refresh(true)"  ng-show="panel.tmode == 'terms_stats'"></select>
      </div>
      <div class="editor-option" ng-show="panel.tmode == 'terms'">
        <label class="small"><?php echo _('Exclude Terms(s)'); ?> (<?php echo _('comma separated'); ?>)</label>
        <input array-join type="text" ng-model='panel.exclude'></input>
      </div>
    </div>
  </div>
  <div class="editor-row">
    <div class="section">
      <h5><?php echo _('View Options'); ?></h5>
      <div class="editor-option">
        <label class="small"><?php echo _('Style'); ?></label>
        <select class="input-small" ng-model="panel.chart" ng-options="f for f in ['bar','pie','table']"></select></span>
      </div>
      <div class="editor-option" ng-show="panel.chart == 'table'">
        <label class="small"><?php echo _('Font Size'); ?></label>
        <select class="input-mini" ng-model="panel.style['font-size']" ng-options="f for f in ['7pt','8pt','9pt','10pt','12pt','14pt','16pt','18pt','20pt','24pt','28pt','32pt','36pt','42pt','48pt','52pt','60pt','72pt']"></select></span>
      </div>
      <div class="editor-option" ng-show="panel.chart == 'bar' || panel.chart == 'pie'">
        <label class="small"><?php echo _('Legend'); ?></label>
        <select class="input-small" ng-model="panel.counter_pos" ng-options="f for f in ['above','below','none']"></select></span>
      </div>
      <div class="editor-option" ng-show="panel.chart != 'table' && panel.counter_pos != 'none'">
        <label class="small" ><?php echo _('Legend Format'); ?></label>
        <select class="input-small" ng-model="panel.arrangement" ng-options="f for f in ['horizontal','vertical']"></select></span>
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Missing'); ?></label><input type="checkbox" ng-model="panel.missing" ng-checked="panel.missing">
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Other'); ?></label><input type="checkbox" ng-model="panel.other" ng-checked="panel.other">
      </div>
      <div class="editor-option" ng-show="panel.chart == 'pie'">
        <label class="small"><?php echo _('Donut'); ?></label><input type="checkbox" ng-model="panel.donut" ng-checked="panel.donut">
      </div>
      <div class="editor-option" ng-show="panel.chart == 'pie'">
        <label class="small"><?php echo _('Tilt'); ?></label><input type="checkbox" ng-model="panel.tilt" ng-checked="panel.tilt">
      </div>
      <div class="editor-option" ng-show="panel.chart == 'pie'">
        <label class="small"><?php echo _('Labels'); ?></label><input type="checkbox" ng-model="panel.labels" ng-checked="panel.labels">
      </div>
    </div>
  </div>
