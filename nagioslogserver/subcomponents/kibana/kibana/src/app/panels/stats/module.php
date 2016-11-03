<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller="stats" ng-init="init()">
  <style>
    table.stats-table th, table.stats-table td {
      text-align: right;
    }

    table.stats-table th:first-child,  table.stats-table td:first-child {
      text-align: left !important;
    }


  </style>

  <h1 ng-style="panel.style" style="text-align: center; line-height: .6em">{{data.value|formatstats:panel.format}} <small style="font-size: .5em; line-height: 0;">{{panel.unit}} ({{panel.mode}})</small></h1>
  <table ng-show="panel.display_breakdown == 'yes'" cellspacing="0" class="table-hover table table-condensed stats-table" style="margin-top: 38px;">
    <tbody>
      <thead>
        <tr>
         <th><a href="" ng-click="set_sort('label')" ng-class="{'icon-chevron-down': panel.sort_field == 'label' && panel.sort_reverse == true, 'icon-chevron-up': panel.sort_field == 'label' && panel.sort_reverse == false}"> {{panel.label_name}} </a></th>
         <th ng-repeat="stat in modes" ng-show="panel.show[stat]">
          <a href=""
            ng-click="set_sort(stat)"
            ng-class="{'icon-chevron-down': panel.sort_field == stat && panel.sort_reverse == true, 'icon-chevron-up': panel.sort_field == stat && panel.sort_reverse == false}">
            {{stat}}
          </a>
          </th>
        </tr>
      </thead>
      <tr ng-repeat="item in data.rows | orderBy:(panel.sort_field == 'label' ? 'label' : 'value.'+panel.sort_field):panel.sort_reverse">
        <td><i class="icon-circle" ng-style="{color:item.color}"></i> {{item.label}}</td>
        <td ng-repeat="stat in modes" ng-show="panel.show[stat]">{{item.value[stat]|formatstats:panel.format}} {{panel.unit}}</td>
      </tr>
    </tbody>
  </table>
</div>
