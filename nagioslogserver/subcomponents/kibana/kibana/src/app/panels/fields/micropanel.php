<?php include_once('../../setlang.inc.php'); ?>

<a class="close" ng-click="dismiss()" href="">×</a>
<h4>
  <?php echo _('Micro Analysis of'); ?> {{micropanel.field}} 
  <i class="pointer fa-search" ng-click="fieldExists(micropanel.field,'must');dismiss();"></i>
  <i class="pointer fa-ban-circle" ng-click="fieldExists(micropanel.field,'mustNot');dismiss();"></i>
  <br><small>{{micropanel.count}} <?php echo _('events in the table set'); ?></small>
</h4>
<table style="width:480px" class='table table-bordered table-striped table-condensed'>
  <thead>
    <th>{{micropanel.field}}</th>
    <th><?php echo _('Action'); ?></th>
    <th><?php echo _('In set'); ?></th>
  </thead>
  <tbody>
    <tr ng-repeat='field in micropanel.values'>
      <td>{{{true: "__blank__",false:field[0]}[field[0] == ""]}}</td>
      <td>
        <i class="pointer fa-search" ng-click="build_search(micropanel.field,field[0],'must');dismiss();"></i>
        <i class="pointer fa-ban-circle" ng-click="build_search(micropanel.field,field[0],'mustNot');dismiss();"></i>
      </td>
      <td>{{field[1]}}</td>
    </tr>
  </tbody>
</table>
<span ng-repeat='(field,count) in micropanel.related'><a ng-click="toggle_field(field)">{{field}}</a> ({{Math.round((count / micropanel.count) * 100)}}%),</span>