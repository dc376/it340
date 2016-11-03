<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller="column" ng-init="init();">
  <!-- All the panels in the column -->
  <div
    ng-repeat="(name, panel) in panel.panels|filter:isPanel"
    ng-cloak ng-hide="panel.height == '0px' || panel.hide"
    kibana-panel type='panel.type'
    class="row-fluid panel"
    style="min-height:{{panel.height}}; position:relative"
    ng-model="row.panels">
  </div>
</div>
