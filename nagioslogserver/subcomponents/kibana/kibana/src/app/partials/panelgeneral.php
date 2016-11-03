<?php include_once('../setlang.inc.php'); ?>

  <div class="editor-row">
    <div class="section">
      <span ng-bind-html="panelMeta.description"></span>
    </div>
  </div>
  <div class="editor-row">
    <div class="section">
      <div class="editor-option">
        <label class="small"><?php echo _('Title'); ?></label><input type="text" class="input-medium" ng-model='panel.title'></input>
      </div>
      <div class="editor-option" ng-hide="panel.sizeable == false">
        <label class="small"><?php echo _('Span'); ?></label> <select class="input-mini" ng-model="panel.span" ng-options="f for f in [1,2,3,4,5,6,7,8,9,10,11,12]"></select>
      </div>
      <div class="editor-option">
        <label class="small"><?php echo _('Editable'); ?></label><input type="checkbox" ng-model="panel.editable" ng-checked="panel.editable">
      </div>
      <div class="editor-option" ng-show="!_.isUndefined(panel.spyable)">
        <label class="small">
          <?php echo _('Inspect'); ?> <i class="fa-question-sign" bs-tooltip="'<?php echo _('Allow query reveal via'); ?> <i class=fa-info-sign></i>'"></i>
        </label>
        <input type="checkbox" ng-model="panel.spyable" ng-checked="panel.spyable">
      </div>
    </div>
  </div>