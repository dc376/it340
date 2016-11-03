<?php include_once('../../setlang.inc.php'); ?>

  <div class="editor-row">

    <div class="section">
      <h5><?php echo _('Parameters'); ?></h5>
      <div class="editor-option">
        <form style="margin-bottom: 0px">
          <label class="small"><?php echo _('Goal'); ?></label>
          <input type="number" style="width:90%" ng-model="panel.query.goal" ng-change="set_refresh(true)">
        </form>
      </div>
    </div>

    <div class="section">
      <h5><?php echo _('View Options'); ?></h5>
      <div class="editor-option">
        <label class="small"> <?php echo _('Donut'); ?> </label><input type="checkbox" ng-model="panel.donut" ng-checked="panel.donut">
      </div>
      <div class="editor-option">
        <label class="small"> <?php echo _('Tilt'); ?> </label><input type="checkbox" ng-model="panel.tilt" ng-checked="panel.tilt">
      </div>
      <div class="editor-option">
        <label class="small"> <?php echo _('Labels'); ?> </label><input type="checkbox" ng-model="panel.labels" ng-checked="panel.labels">
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Legend'); ?></label>
        <select class="input-small" ng-model="panel.legend" ng-options="f for f in ['above','below','none']"></select></span>
      </div>
    </div>

  </div>