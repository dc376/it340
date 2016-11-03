<?php include_once('../../setlang.inc.php'); ?>

<div>
  <h4><?php echo _('Settings'); ?></h4>
  <div class="row-fluid">
    <div class="editor-option">
       <label class="small"><?php echo _('Time Ago'); ?> <tip><?php echo _('Elasticsearch date math format'); ?> (eg 1m, 5m, 1d, 2w, 1y)</tip></label>
        <input type="text" class="input-small" ng-model="panel.ago" ng-change="set_refresh(true)">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Font Size'); ?></label>
      <select class="input-small" ng-model="panel.style['font-size']" ng-options="f for f in ['7pt','8pt','9pt','10pt','12pt','14pt','16pt','18pt','20pt','24pt','28pt','32pt','36pt','42pt','48pt','52pt','60pt','72pt']"></select>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('List Format'); ?></label>
      <select class="input-small" ng-model="panel.arrangement" ng-options="f for f in ['horizontal','vertical']"></select>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Reverse Colors'); ?><tip><?php echo _('Use green for down, and red for up instead'); ?></tip></label>
      <input type="checkbox" ng-model="panel.reverse" ng-checked="panel.reverse">
    </div>
  </div>
</div>
