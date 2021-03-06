<?php include_once('../../setlang.inc.php'); ?>

<div class="editor-row">
  <div class="section">
    <div class="editor-option">
      <label class="small"><?php echo _('Style'); ?></label>
      <select class="input-small" ng-model="panel.chart" ng-options="f for f in ['bar','pie','list','total']"></select></span>
    </div>
    <div class="editor-option" ng-show="panel.chart == 'total' || panel.chart == 'list'">
      <label class="small"><?php echo _('Font Size'); ?></label>
      <select class="input-mini" ng-model="panel.style['font-size']" ng-options="f for f in ['7pt','8pt','9pt','10pt','12pt','14pt','16pt','18pt','20pt','24pt','28pt','32pt','36pt','42pt','48pt','52pt','60pt','72pt']"></select></span>
    </div>
    <div class="editor-option" ng-show="panel.chart == 'bar' || panel.chart == 'pie'">
      <label class="small"><?php echo _('Legend'); ?></label>
      <select class="input-small" ng-model="panel.counter_pos" ng-options="f for f in ['above','below','none']"></select></span>
    </div>
    <div class="editor-option" ng-show="panel.chart != 'total' && panel.counter_pos != 'none'">
      <label class="small"><?php echo _('List Format'); ?></label>
      <select class="input-small" ng-model="panel.arrangement" ng-options="f for f in ['horizontal','vertical']"></select></span>
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
