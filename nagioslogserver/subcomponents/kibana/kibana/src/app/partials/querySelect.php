<?php include_once('../setlang.inc.php'); ?>

  <div class="row-fluid">
    <style>
      .querySelect .query {
        margin-right: 5px;
      }
      .querySelect .selected {
        border: 3px solid;
      }
      .querySelect .unselected {
        border: 0px solid;
      }
    </style>
    <div class="span2" style="margin-left:0px">
      <label class="small"><?php echo _('Queries'); ?></label>
      <select class="input-small" ng-change="set_refresh(true);" ng-model="panel.queries.mode" ng-options="f for f in ['all','pinned','unpinned','selected']"></select>
    </div>
    <div class="span9 querySelect" ng-show="panel.queries.mode == 'selected'">
      <label class="small"><?php echo _('Selected Queries'); ?></label>
      <span ng-style="{'border-color': querySrv.list()[id].color}" ng-class="{selected:_.contains(panel.queries.ids,id),unselected:!_.contains(panel.queries.ids,id)}" ng-repeat="id in querySrv.ids()" ng-click="panel.queries.ids = _.toggleInOut(panel.queries.ids,id);set_refresh(true);" class="query pointer badge">
        <i class="fa-circle" ng-style="{color: querySrv.list()[id].color}"></i>
        <span> {{querySrv.list()[id].alias || querySrv.list()[id].query}}</span>
      </span>
    </div>
  </div>
