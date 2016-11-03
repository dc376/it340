<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='sparklines' ng-init="init()" style="min-height:{{panel.height || row.height}}">
  <center><img ng-show='panel.loading && _.isUndefined(data)' src="img/load_big.gif"></center>


  <div ng-repeat="series in data" style="margin-right:5px;text-align:center;display:inline-block">
    <small class="strong"><i class="fa-circle" ng-style="{color: series.info.color}"></i> {{series.info.alias}}</small><br>
    <div style="display:inline-block" sparklines-chart series="series" panel="panel"></div>
  </div>

</div>