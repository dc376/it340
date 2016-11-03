<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='terms' ng-init="init()">
  <style>
    .pieLabel { pointer-events: none }
    .terms-legend-term {
      word-break: break-all;
    }

    .terms-remaining {
      bottom:0;
      top:0;
      background-color: #f00;
    }

    .terms-wrapper {
      display: table;
      width: 100%;
    }

    .terms-legend {
      display: table-row;
      height: 0;
    }

    .terms-legend {
      display: table-row;
    }
  </style>


  <div class="terms-wrapper">
    <!-- LEGEND -->
    <div class="terms-legend" ng-show="panel.counter_pos == 'above' && (panel.chart == 'bar' || panel.chart == 'pie')" id='{{$id}}-legend'>
    <!-- vertical legend above -->
    <table class="small" ng-show="panel.arrangement == 'vertical'">
      <tr ng-repeat="term in legend">
        <td><i class="fa-circle" ng-style="{color:term.color}"></i></td>
        <td class="terms-legend-term" style="padding-right:10px;padding-left:10px;">{{term.label}}</td>
        <td>{{term.data[0][1]}}</td>
      </tr>
      </table>

    <!-- horizontal legend above -->
    <span class="small" ng-show="panel.arrangement == 'horizontal'" ng-repeat="term in legend" style="float:left;padding-left: 10px;">
      <span>
        <i class="fa-circle" ng-style="{color:term.color}"></i>
        <span class="terms-legend-term">{{term.label}}</span> ({{term.data[0][1]}})
      </span>
    </span>

      <span class="small pull-left" ng-show="panel.tmode == 'terms_stats'">
        &nbsp | {{ panel.tstat }} of <strong>{{ panel.valuefield }}</strong>
      </span>

    </div>
    <!-- keep legend from over lapping -->
    <div style="clear:both"></div>


    <!-- CHART -->
    <div ng-show="panel.chart == 'pie' || panel.chart == 'bar'" terms-chart params="{{panel}}" style="position:relative" class="pointer terms-chart">
    </div>

    <!-- LEGEND -->
    <div class="terms-legend" ng-show="panel.counter_pos == 'below' && (panel.chart == 'bar' || panel.chart == 'pie')" id='{{$id}}-legend'>
    <!-- vertical legend below -->
    <table class="small" ng-show="panel.arrangement == 'vertical'">
      <tr ng-repeat="term in legend">
        <td><i class="fa-circle" ng-style="{color:term.color}"></i></i></td>
        <td class="terms-legend-term" style="padding-right:10px;padding-left:10px;">{{term.label}}</td>
        <td>{{term.data[0][1]}}</td>
      </tr>
      </table>

    <!-- horizontal legend below -->
    <span class="small" ng-show="panel.arrangement == 'horizontal'" ng-repeat="term in legend" style="float:left;padding-left: 10px;">
      <span>
        <i class="fa-circle" ng-style="{color:term.color}"></i>
        <span class="terms-legend-term">{{term.label}}</span> ({{term.data[0][1]}})
      </span>
    </span>

      <span class="small pull-left" ng-show="panel.tmode == 'terms_stats'">
        &nbsp | {{ panel.tstat }} of <strong>{{ panel.valuefield }}</strong>
      </span>

      <div style="clear:both"></div>
    </div>
    <!-- END Pie or Bar chart -->


  <!-- TABLE -->
  <table ng-style="panel.style" class="table table-striped table-condensed" ng-show="panel.chart == 'table'">
    <thead>
      <th><?php echo _('Term'); ?></th> <th>{{ panel.tmode == 'terms_stats' ? panel.tstat : 'Count' }}</th> <th><?php echo _('Action'); ?></th>
    </thead>
    <tr ng-repeat="term in data" ng-show="showMeta(term)">
      <td class="terms-legend-term">{{term.label}}</td>
      <td>{{term.data[0][1]}}</td>
      <td>
        <span ng-hide="term.meta == 'other'">
          <i class='fa-search pointer' ng-click="build_search(term)"></i>
          <i class='fa-ban-circle pointer' ng-click="build_search(term,true)"></i>
        </span>
      </td>
    </tr>
  </table>

</div>