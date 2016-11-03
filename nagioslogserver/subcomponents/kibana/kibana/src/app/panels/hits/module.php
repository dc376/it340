<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='hits' ng-init="init()">
  <div ng-show="panel.counter_pos == 'above' && (panel.chart == 'bar' || panel.chart == 'pie')" id='{{$id}}-legend'>
    <!-- vertical legend -->
    <table class="small" ng-show="panel.arrangement == 'vertical'">
      <tr ng-repeat="query in data">
        <td><div style="display:inline-block;border-radius:5px;background:{{query.info.color}};height:10px;width:10px"></div></td> <td style="padding-right:10px;padding-left:10px;">{{query.info.alias}}</td><td>{{query.data[0][1]}}</td>
      </tr>
    </table>

    <!-- horizontal legend -->
    <div class="small" ng-show="panel.arrangement == 'horizontal'" ng-repeat="query in data" style="float:left;padding-left: 10px;">
     <span><i class="fa-circle" ng-style="{color:query.info.color}"></i> {{query.info.alias}} ({{query.data[0][1]}}) </span>
    </div><br>

  </div>

  <div style="clear:both"></div>

  <div ng-show="panel.chart == 'pie' || panel.chart == 'bar'" hits-chart params="{{panel}}" style="position:relative"></div>

  <div ng-show="panel.counter_pos == 'below' && (panel.chart == 'bar' || panel.chart == 'pie')" id='{{$id}}-legend'>
    <!-- vertical legend -->
    <table class="small" ng-show="panel.arrangement == 'vertical'">
      <tr ng-repeat="query in data">
        <td><i class="fa-circle" ng-style="{color:query.info.color}"></i></td> <td style="padding-right:10px;padding-left:10px;">{{query.info.alias}}</td><td>{{query.data[0][1]}}</td>
      </tr>
    </table>

    <!-- horizontal legend -->
    <div class="small" ng-show="panel.arrangement == 'horizontal'" ng-repeat="query in data" style="float:left;padding-left: 10px;">
     <span><i class="fa-circle" ng-style="{color:query.info.color}"></i></span> {{query.info.alias}} ({{query.data[0][1]}}) </span>
    </div><br>

  </div>

  <div ng-show="panel.chart == 'total'"><div ng-style="panel.style" style="line-height:{{panel.style['font-size']}}">{{hits}}</div></div>
  
  <!-- horizontal legend -->
  <span ng-show="panel.chart == 'list' && panel.arrangement == 'horizontal'">
    <div ng-style="panel.style" style="display:inline-block;line-height:{{panel.style['font-size']}}" ng-repeat="query in data">
      <i class="fa-circle" style="color:{{query.info.color}}"></i> {{query.info.alias}} ({{query.hits}}) &nbsp;
    </div>
  </span>

  <!-- vertical legend -->
  <div ng-style="panel.style" style="line-height:{{panel.style['font-size']}}">
    <table class="small" ng-show="panel.chart == 'list' && panel.arrangement == 'vertical'">
      <tr ng-repeat="query in data">
        <td style="padding-right:10px;padding-left:10px;"><i class="fa-circle" ng-style="{color:query.info.color}"></i></td><td> {{query.info.alias}}</td><td style="padding-right:10px;padding-left:10px;">{{query.data[0][1]}}</td>
      </tr>
    </table>
  </div>

</div>