<?php include_once('../../setlang.inc.php'); ?>

<div>
  <div class="row-fluid">
    <h4><?php echo _('Add Panel to Column'); ?></h4>
    <select class="input-medium" ng-model="new_panel.type" ng-options="f for f in _.without(config.panel_names,'column')| stringSort" ng-change="reset_panel(new_panel.type);send_render();"></select>
    <small><?php echo _('Select Type'); ?></small>
    <div ng-show="!(_.isUndefined(new_panel.type))">
      <div column-edit panel="new_panel" config="config" row="row" dashboards="dashboards" type="new_panel.type"></div>
      <button ng-click="add_panel(panel,new_panel); reset_panel();" class="btn btn-primary"><?php echo _('Create Panel'); ?></button><br>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span12">
      <h4><?php echo _('Panels'); ?></h4>
      <table class="table table-condensed table-striped">
        <thead>
          <th><?php echo _('Title'); ?></th>
          <th><?php echo _('Type'); ?></th>
          <th><?php echo _('Height'); ?></th>
          <th><?php echo _('Delete'); ?></th>
          <th><?php echo _('Move'); ?></th>
          <th></th>
          <th><?php echo _('Hide'); ?></th>
        </thead>
        <tr ng-repeat="app in panel.panels">
          <td>{{app.title}}</td>
          <td>{{app.type}}</td>
          <td><input type="text" class="input-small" ng-model="app.height"></input></td>
          <td><i ng-click="panel.panels = _.without(panel.panels,app)" class="pointer fa-remove"></i></td>
          <td><i ng-click="_.move(panel.panels,$index,$index-1)" ng-hide="$first" class="pointer fa-arrow-up"></i></td>
          <td><i ng-click="_.move(panel.panels,$index,$index+1)" ng-hide="$last" class="pointer fa-arrow-down"></i></td>
          <td><input type="checkbox" ng-model="app.hide" ng-checked="app.hide"></td>
        </tr>
      </table>
    </div>
  </div>
</div>
