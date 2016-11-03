<?php include_once('../../setlang.inc.php'); ?>

<div class="editor-row">
  <div class="section">
    <h5><?php echo _('Chart Options'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Bars'); ?></label><input type="checkbox" ng-model="panel.bars" ng-checked="panel.bars">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Lines'); ?></label><input type="checkbox" ng-model="panel.lines" ng-checked="panel.lines">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Points'); ?></label><input type="checkbox" ng-model="panel.points" ng-checked="panel.points">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Selectable'); ?></label><input type="checkbox" ng-model="panel.interactive" ng-checked="panel.interactive">
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('xAxis'); ?></label><input type="checkbox" ng-model="panel['x-axis']" ng-checked="panel['x-axis']"></div>
    <div class="editor-option">
      <label class="small"><?php echo _('yAxis'); ?></label><input type="checkbox" ng-model="panel['y-axis']" ng-checked="panel['y-axis']"></div>
    <div class="editor-option" ng-show="panel.lines">
      <label class="small"><?php echo _('Line Fill'); ?></label>
      <select class="input-mini" ng-model="panel.fill" ng-options="f for f in [0,1,2,3,4,5,6,7,8,9,10]"></select>
    </div>
    <div class="editor-option" ng-show="panel.lines">
      <label class="small"><?php echo _('Line Width'); ?></label>
      <select class="input-mini" ng-model="panel.linewidth" ng-options="f for f in [0,1,2,3,4,5,6,7,8,9,10]"></select>
    </div>
    <div class="editor-option" ng-show="panel.points">
      <label class="small"><?php echo _('Point Radius'); ?></label>
      <select class="input-mini" ng-model="panel.pointradius" ng-options="f for f in [1,2,3,4,5,6,7,8,9,10]"></select>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Y Format'); ?> <tip><?php echo _('Y-axis formatting'); ?></tip></label>
      <select class="input-small" ng-model="panel.y_format" ng-options="f for f in ['none','short','bytes']"></select>
    </div>
  </div>
  <div class="section">
    <h5><?php echo _('Multiple Series'); ?></h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Stack'); ?></label><input type="checkbox" ng-model="panel.stack" ng-checked="panel.stack">
    </div>
    <div class="editor-option" ng-show="panel.stack">
      <label style="white-space:nowrap" class="small"><?php echo _('Percent'); ?> <tip><?php echo _('Stack as a percentage of total'); ?></tip></label>
      <input type="checkbox"  ng-model="panel.percentage" ng-checked="panel.percentage">
    </div>
    <div class="editor-option" ng-show="panel.stack">
      <label class="small"><?php echo _('Stacked Values'); ?> <tip><?php echo _('How should the values in stacked charts to be calculated?'); ?></tip></label>
      <select class="input-small" ng-model="panel.tooltip.value_type" ng-options="f for f in ['cumulative','individual']"></select>
    </div>
  </div>
</div>

<div class="editor-row">
  <div class="section">
    <h5><?php echo _('Header'); ?><h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Zoom'); ?></label><input type="checkbox" ng-model="panel.zoomlinks" ng-checked="panel.zoomlinks" />
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('View'); ?></label><input type="checkbox" ng-model="panel.options" ng-checked="panel.options" />
    </div>
  </div>
  <div class="section">
    <h5><?php echo _('Legend'); ?><h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Legend'); ?></label><input type="checkbox" ng-model="panel.legend" ng-checked="panel.legend">
    </div>
    <div ng-show="panel.legend" class="editor-option">
      <label class="small"><?php echo _('Query'); ?> <tip><?php echo _('If no alias is set, show the query in the legend'); ?></tip></label><input type="checkbox" ng-model="panel.show_query" ng-checked="panel.show_query">
    </div>
    <div ng-show="panel.legend" class="editor-option">
      <label class="small"><?php echo _('Counts'); ?></label><input type="checkbox" ng-model="panel.legend_counts" ng-checked="panel.legend_counts">
    </div>
  </div>

  <div class="section">
    <h5><?php echo _('Grid'); ?><h5>
    <div class="editor-option">
      <label class="small"><?php echo _('Min'); ?> / <a href='' ng-click="panel.grid.min = _.toggle(panel.grid.min,null,0)"><?php echo _('Auto'); ?> <i class="fa-star" ng-show="_.isNull(panel.grid.min)"></i></a></label>
      <input type="number" class="input-small" ng-model="panel.grid.min"/>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Max'); ?> / <a ref='' ng-click="panel.grid.max = _.toggle(panel.grid.max,null,0)"><?php echo _('Auto'); ?> <i class="fa-star" ng-show="_.isNull(panel.grid.max)"></i></a></label>
      <input type="number" class="input-small" ng-model="panel.grid.max"/>
    </div>
  </div>

</div>
