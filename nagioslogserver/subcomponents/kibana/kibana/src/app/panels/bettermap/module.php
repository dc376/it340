<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='bettermap' ng-init="init()">
  <style>
    .leaflet-label {
      color: #fff;
    }
  </style>
  <!-- This solution might work well for other panels that have trouble with heights -->
  <div  style="padding-right:10px;padding-top:10px;height:{{panel.height|| row.height}};overflow:hidden">
    <div bettermap id="{{$id}}" params="{{panel}}" style="height:100%"></div>
  </div>
</div>