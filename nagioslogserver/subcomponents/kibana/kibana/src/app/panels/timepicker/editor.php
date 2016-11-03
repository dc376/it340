<?php include_once('../../setlang.inc.php'); ?>

  <div class="editor-row">
    <div class="section">
      <div class="editor-option">
        <label class="small"><?php echo _('Relative time options'); ?> <small><?php echo _('comma separated'); ?></small></label>
        <input type="text" array-join class="input-large" ng-model="panel.time_options">
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Auto-refresh options'); ?> <small><?php echo _('comma separated'); ?></small></label>
        <input type="text" array-join class="input-large" ng-model="panel.refresh_intervals">
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Time Field'); ?></label>
        <input type="text" class="input-small" ng-model="panel.timefield">
      </div>
    </div>
  </div>
