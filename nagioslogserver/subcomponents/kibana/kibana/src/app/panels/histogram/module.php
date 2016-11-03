<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='histogram' ng-init="init()" style="min-height:{{panel.height || row.height}}">
  <style>
    .histogram-legend {
      display:inline-block;
      padding-right:5px
    }
    .histogram-legend-dot {
      display:inline-block;
      height:10px;
      width:10px;
      border-radius:5px;
    }
    .histogram-legend-item {
      display:inline-block;
    }
    .histogram-chart {
      position:relative;
    }
    .histogram-options {
      padding: 5px;
      margin-right: 15px;
      margin-bottom: 0px;
    }
    .histogram-options label {
      margin: 0px 0px 0px 10px !important;
    }
    .histogram-options span {
      white-space: nowrap;
    }

    /* this is actually should be in bootstrap */
    .form-inline .checkbox {
        display: inline-block;
    }

    .histogram-marker {
      display: block;
      width: 20px;
      height: 21px;
      background-image: url('img/annotation-icon.png');
      background-repeat: no-repeat;
    }

  </style>
  <div>
    <span ng-show='panel.options'>
      <a class="link small" ng-show='panel.options' ng-click="options=!options">
        <?php echo _('View'); ?> <i ng-show="!options" class="fa-caret-right"></i><i ng-show="options" class="fa-caret-down"></i>
      </a> |&nbsp
    </span>
    <span ng-show='panel.zoomlinks'>
      <a class='small' ng-click='zoom(2)'><i class='fa-zoom-out'></i> <?php echo _('Zoom Out'); ?></a> |&nbsp
    </span>
    <span ng-show="panel.legend" ng-repeat='series in legend' class="histogram-legend">
      <i class='fa-circle' ng-style="{color: series.query.color}"></i>
      <span class='small histogram-legend-item'>
        <span ng-if="panel.show_query">{{series.query.alias || series.query.query}}</span>
        <span ng-if="!panel.show_query">{{series.query.alias}}</span>
        <span ng-show="panel.legend_counts"> ({{series.hits}})</span>
      </span>
    </span>
    <span ng-show="panel.legend" class="small"><span ng-show="panel.derivative"> <?php echo _('change in'); ?> </span><span class="strong" ng-show="panel.value_field && panel.mode != 'count'">{{panel.value_field}}</span> {{panel.mode}} per <strong ng-hide="panel.scaleSeconds">{{panel.interval}}</strong><strong ng-show="panel.scaleSeconds">1s</strong> | (<strong>{{hits}}</strong> hits)</span>
  </div>
  <form class="form-inline bordered histogram-options" ng-show="options">
    <span>
      <div class="checkbox">
        <label class="small">
          <input type="checkbox" ng-model="panel.bars" ng-checked="panel.bars" ng-change="render()">
          <?php echo _('Bars'); ?>
        </label>
      </div>
      <div class="checkbox">
        <label class="small">
          <input type="checkbox" ng-model="panel.lines" ng-checked="panel.lines" ng-change="render()">
          <?php echo _('Lines'); ?>
        </label>
      </div>
      <div class="checkbox">
        <label class="small">
          <input type="checkbox" ng-model="panel.stack" ng-checked="panel.stack" ng-change="render()">
          <?php echo _('Stack'); ?>
        </label>
      </div>
    </span>
    <span ng-show="panel.stack">
      <div class="checkbox">
        <label style="white-space:nowrap" class="small">
          <input type="checkbox"  ng-model="panel.percentage" ng-checked="panel.percentage" ng-change="render()">
          <?php echo _('Percent'); ?>
        </label>
      </div>
    </span>
    <span>
      <div class="checkbox">
        <label class="small">
          <input type="checkbox" ng-model="panel.legend" ng-checked="panel.legend" ng-change="render()">
          <?php echo _('Legend'); ?>
        </label>
      </div>
    </span>
    <span>
      <label class="small"><?php echo _('Interval'); ?></label> <select ng-change="set_interval(panel.interval);get_data();" class="input-small" ng-model="panel.interval" ng-options="interval_label(time) for time in _.union([panel.interval],panel.intervals)"></select>
    </span>
  </form>
  <center><img ng-show='panel.loading' src="img/load_big.gif"></center>
  <div histogram-chart class="pointer histogram-chart" params="{{panel}}"></div>
</div>
