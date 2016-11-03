<?php include_once('../setlang.inc.php'); ?>

<!-- Panels -->
<div style="height:100%; width:100%" ng-repeat="(name, panel) in row.panels|filter:isPanel" ng-hide="panel.hide" class="panel nospace" ng-style="{'width':'100%'}" data-drop="true" ng-model="row.panels" data-jqyoui-options jqyoui-droppable="{index:$index,mutate:false,onDrop:'panelMoveDrop',onOver:'panelMoveOver(true)',onOut:'panelMoveOut'}" ng-class="{'dragInProgress':dashboard.panelDragging}">

  <!-- Content Panel -->
  <div style="position:relative">
    <kibana-panel type="panel.type" ng-cloak></kibana-panel>
  </div>
</div>