<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='filtering' ng-init="init()">
  <style>
    .filtering-container {
      margin-top: 3px;
    }
    .filter-panel-filter {
      display: inline-block;
      vertical-align: top;
      width: 220px;
      padding: 6px 6px 0px 10px;
      margin: 5px 5px 5px 0px;
      color: #fff;
      background-color: #778899;
      border: 1px solid #777;
      border-radius: 4px;
      box-shadow: 0 2px 6px rgba(0,0,0,.2);
    }
    .filter-panel-filter .ff { line-height: 16px; }
    .filter-panel-filter ul {
      margin-bottom: 8px;
    }
    .filter-panel-filter li { line-height: 16px; }
    .filter-deselected {
      opacity: 0.5;
    }
    .filter-action {
      float:right;
      margin-bottom: 0px !important;
      margin-left: 3px;
    }
    .filter-mandate {
      text-decoration: underline;
      cursor: pointer;
    }
    .filter-apply {
      float:right;
    }
    .filter-panel-filter form, .filter-panel-filter input, .filter-panel-filter select { margin: 0; }
    .filter-panel-filter .text-success { color: #60c060; }
    .filter-panel-filter .text-warning { color: #ffcc66; }
  </style>

  <div class='filtering-container'>
    <span ng-show="dashboard.current.services.filter.ids.length == 0">
      <h5><?php echo _('No filters available'); ?></h5>
    </span>
    <div ng-repeat="id in dashboard.current.services.filter.ids" class="small filter-panel-filter">
      <div class="ff">
        <strong>{{dashboard.current.services.filter.list[id].type}}</strong>
        <span ng-show="!dashboard.current.services.filter.list[id].editing && isEditable(dashboard.current.services.filter.list[id])" class="filter-mandate" ng-click="dashboard.current.services.filter.list[id].editing = true">
          {{dashboard.current.services.filter.list[id].mandate}}
        </span>
        <span ng-show="!isEditable(dashboard.current.services.filter.list[id])">
          {{dashboard.current.services.filter.list[id].mandate}}
        </span>

        <i ng-class="getFilterClass(dashboard.current.services.filter.list[id])" class="fa-circle"></i>

        <span ng-show="dashboard.current.services.filter.list[id].editing">
          <select class="input-small" ng-model="dashboard.current.services.filter.list[id].mandate" ng-options="f for f in ['must','mustNot','either']"></select>
        </span>

        <i class="filter-action pointer fa-remove" bs-tooltip="'<?php echo _('Remove'); ?>'" ng-click="query_edited(); remove(id);"></i>
        <i class="filter-action pointer" ng-class="{'fa-check': dashboard.current.services.filter.list[id].active,'fa-check-empty': !dashboard.current.services.filter.list[id].active}" bs-tooltip="'Toggle'" ng-click="toggle(id)"></i>
        <i class="filter-action pointer fa-edit" ng-hide="dashboard.current.services.filter.list[id].editing || !isEditable(dashboard.current.services.filter.list[id])" bs-tooltip="'Edit'" ng-click="query_edited(); dashboard.current.services.filter.list[id].editing = true"></i>
      </div>

      <div ng-hide="dashboard.current.services.filter.list[id].editing && isEditable(dashboard.current.services.filter.list[id])">
        <ul class="unstyled">
          <li ng-repeat="(key,value) in dashboard.current.services.filter.list[id] track by $index" ng-show="show_key(key)">
            <strong>{{key}}</strong> : {{value}}
          </li>
        </ul>
      </div>
      <form ng-show="dashboard.current.services.filter.list[id].editing && isEditable(dashboard.current.services.filter.list[id])">
        <ul class="unstyled">
          <li ng-repeat="key in _.keys(dashboard.current.services.filter.list[id])" ng-show="show_key(key)">
            <strong>{{key}}</strong> : <input type='text' ng-model="dashboard.current.services.filter.list[id][key]">
          </li>
        </ul>
        <div style="margin-bottom: 6px;">
          <button type="submit" ng-click="dashboard.current.services.filter.list[id].editing=undefined;refresh()" class="filter-apply btn btn-mini btn-success"><?php echo _('Apply'); ?></button>
          <button ng-click="dashboard.current.services.filter.list[id].editing=undefined" class="filter-apply btn-mini btn" bs-tooltip="'<?php echo _('Save without refresh'); ?>'" style="margin-right: 6px;"><?php echo _('Save'); ?></button>
          <div style="clear: both;"></div>
        </div>
      </form>
    </div>
    <i class="pointer fa-plus-sign" ng-click="add();" bs-tooltip="'<?php echo _('Add a query filter'); ?>'" data-placement="right"></i>
  </div>
</div>