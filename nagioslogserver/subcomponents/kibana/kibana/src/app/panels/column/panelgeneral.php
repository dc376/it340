<?php include_once('../../setlang.inc.php'); ?>

  <div class="row-fluid">
    <div class="span4">
      <label class="small"><?php echo _('Title'); ?></label><input type="text" class="input-medium" ng-model='panel.title'></input>
    </div>
    <div class="span2">
      <label class="small"><?php echo _('Height'); ?></label> <input type="text" class="input-mini" ng-model='panel.height'></input>
    </div>
    <div class="span1"> 
      <label class="small"><?php echo _('Editable'); ?></label><input type="checkbox" ng-model="panel.editable" ng-checked="panel.editable">
    </div>
  </div>