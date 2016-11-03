<?php include_once('../../setlang.inc.php'); ?>

<div class="panel-query-meta row-fluid" style="width:260px">

  <style>
    .panel-query-meta fieldset label {
      margin-top: 3px;
    }
  </style>

  <fieldset>
    <select class="input-small" ng-model="dashboard.current.services.query.list[id].type" ng-change="typeChange(dashboard.current.services.query.list[id])">
      <option ng-repeat="type in queryTypes">{{type}}</option>
    </select> &nbsp<a href="" class="small" ng-click="queryHelp(dashboard.current.services.query.list[id].type)"> <?php echo _('About the'); ?> {{dashboard.current.services.query.list[id].type}} <?php echo _('query'); ?></a>

    <hr class="small">

    <label class="small"><?php echo _('Legend value'); ?></label>
    <input type="text" ng-model="dashboard.current.services.query.list[id].alias" placeholder="<?php echo _('Alias'); ?>...">
  </fieldset>

  <div ng-include src="queryConfig(dashboard.current.services.query.list[id].type)"></div>


  <hr class="small">
  <div>
    <i ng-repeat="color in querySrv.colors" class="pointer" ng-class="{'fa-circle-blank':dashboard.current.services.query.list[id].color == color,'fa-circle':dashboard.current.services.query.list[id].color != color}" ng-style="{color:color}" ng-click="dashboard.current.services.query.list[id].color = color;render();"> </i>
  </div>


  <div class="pull-right">
    <a class="btn btn-mini" ng-click="dashboard.current.services.query.list[id].enable=false;dashboard.refresh();dismiss();" class="pointer"><?php echo _('Deactivate'); ?></a>
    <a class="btn btn-mini" ng-class="{active:dashboard.current.services.query.list[id].pin}" ng-click="toggle_pin(id);dismiss();" class="pointer"><?php echo _('Pin'); ?> <i class="fa-pushpin"></i></a>
    <input class="btn btn-mini" ng-click="dashboard.refresh();dismiss();" type="submit"/ value="<?php echo _('Close'); ?>">
  </div>
</div>