<?php include_once('../../setlang.inc.php'); ?>

<a class="close" ng-click="dismiss()" href="">×</a>
<style>

</style>
<span>
  <i class="pointer icon-search" ng-click="fieldExists(micropanel.field,'must');dismiss();" bs-tooltip="'<?php echo _('Find events with this field'); ?>'"></i>
  <i class="pointer icon-ban-circle" ng-click="fieldExists(micropanel.field,'mustNot');dismiss();" bs-tooltip="'<?php echo _('Find events without this field'); ?>'"></i>
  <strong><?php echo _('Micro Analysis of'); ?> {{micropanel.field}} <span ng-if='micropanel.type'>({{micropanel.type}})</span></strong>
  <span ng-show="micropanel.hasArrays">
    <?php echo _('as'); ?>
    <a class="link" ng-class="{'strong':micropanel.grouped}" ng-click="toggle_micropanel(micropanel.field,true)"><?php echo _('Groups'); ?></a> /
    <a class="link" ng-class="{'strong':!micropanel.grouped}" ng-click="toggle_micropanel(micropanel.field,false)"><?php echo _('Singles'); ?></a>
  </span>
</span>
<table style="width:100%;table-layout:fixed" class='table table-striped table-unpadded'>
  <thead>
    <th style="width:15px"></th>
    <th style="width:260px"><?php echo _('Value'); ?></th>
    <th style="width:40px"><?php echo _('Action'); ?></th>
    <th style="width:100px;text-align:right"><?php echo _('Count'); ?> / {{micropanel.count}} <?php echo _('events'); ?></th>
  </thead>
  <tbody>
    <tr ng-repeat='field in micropanel.values'>
      <td>{{$index+1}}.</td>
      <td style="word-wrap:break-word">{{{true: "__blank__", false:field[0] }[(field[0] == '' || field[0] == undefined) && field[0] != 0]|tableTruncate:panel.trimFactor:3}}</td>
      <td>
        <i class="pointer fa-search" ng-click="build_search(micropanel.field,field[0]);dismiss();"></i>
        <i class="pointer fa-ban-circle" ng-click="build_search(micropanel.field,field[0],true);dismiss();"></i>
      </td>
      <td class="progress" style="position:relative">
        <style scoped>
          .progress {
            overflow: visible;
          }
        </style>
        <div bs-tooltip="percent(field[1],data.length)" class="bar" ng-class="micropanelColor($index)" ng-style="{width: (field[1]/data.length) > 1 ? '100%' : percent(field[1],data.length)}"></div>
        <span style="position:absolute;right:20px;">{{field[1]}}</span>
      </td>
    </tr>
  </tbody>
</table>
<div class="progress nomargin" ng-show="micropanel.grouped">
  <div ng-repeat='field in micropanel.values' bs-tooltip="$index+1+'. ('+percent(field[1],data.length)+')'" class="bar {{micropanelColor($index)}}" ng-style="{width: percent(field[1],data.length)};"></div>
</div>
<div>
  <span ng-repeat="field in micropanel.related|orderBy:'count':true|limitTo:micropanel.limit track by $index"><a ng-click="toggle_field(field.name)" bs-tooltip="'Toggle {{field.name}} column'">{{field.name}}</a> ({{Math.round((field.count / micropanel.count) * 100)}}%), </span>
  <a class="link" ng-show="micropanel.related.length > micropanel.limit" ng-click="micropanel.limit = micropanel.limit + 10"><?php echo _('More'); ?> <i class="fa-caret-right"></i></a>
</div>
<div class="row-fluid">
  <div class="span12">
    <div class="btn-group">
      <a class="btn dropdown-toggle pointer" data-toggle="dropdown">
        <i class="fa-list-ol"></i> <?php echo _('Terms'); ?>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li><a ng-click="termsModal(field,'bar');dismiss();"><?php echo _('Bar'); ?></a></li>
        <li><a ng-click="termsModal(field,'pie');dismiss();"><?php echo _('Pie'); ?></a></li>
        <li><a ng-click="termsModal(field,'table');dismiss();"><?php echo _('Table'); ?></a></li>
      </ul>
    </div>
    <div class="btn-group" ng-show="micropanel.hasStats">
      <a class="btn dropdown-toggle pointer" ng-click="statsModal(field);dismiss();">
        <i class="icon-list-ol"></i> <?php echo _('Stats'); ?>
      </a>
    </div>

  </div>
</div>