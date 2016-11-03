<?php include_once('../../setlang.inc.php'); ?>

<h4><?php echo _('Charted'); ?></h4>
<div ng-include src="'app/partials/querySelect.php'"></div>

<div class="editor-row">
  <h4><?php echo _('Markers'); ?></h4>

  <div class="small">
    <?php echo _('Here you can specify a query to be plotted on your chart as a marker. Hovering over a marker will display the field you specify below. If more documents are found than the limit you set, they will be scored by Elasticsearch and events that best match your query will be displayed.'); ?>
  </div>
  <style>
    .querySelect .query {
      margin-right: 5px;
    }
    .querySelect .selected {
      border: 3px solid;
    }
    .querySelect .unselected {
      border: 0px solid;
    }
  </style>
  <p>
  <div class="editor-option">
    <label class="small"><?php echo _('Enable'); ?></label>
    <input type="checkbox" ng-change="set_refresh(true)" ng-model="panel.annotate.enable" ng-checked="panel.annotate.enable">
  </div>
  <div class="editor-option" ng-show="panel.annotate.enable">
    <label class="small"><?php echo _('Marker Query'); ?></label>
    <input type="text" ng-change="set_refresh(true)" class="input-large" ng-model="panel.annotate.query"/>
  </div>
  <div class="editor-option" ng-show="panel.annotate.enable">
    <label class="small"><?php echo _('Tooltip field'); ?></label>
    <input type="text" class="input-small" ng-model="panel.annotate.field" bs-typeahead="fields.list"/>
  </div>
  <div class="editor-option" ng-show="panel.annotate.enable">
    <label class="small"><?php echo _('Limit'); ?> <tip><?php echo _('Max markers on the chart'); ?></tip></label>
    <input type="number" class="input-mini" ng-model="panel.annotate.size" ng-change="set_refresh(true)"/>
  </div>
  <div class="editor-option" ng-show="panel.annotate.enable">
    <label class="small"><?php echo _('Sort'); ?> <tip><?php echo _('Determine the most relevant markers using this field'); ?></tip></label>
    <input type="text" class="input-small" bs-typeahead="fields.list" ng-model="panel.annotate.sort[0]" ng-change="set_refresh(true)" />
    <i ng-click="panel.annotate.sort[1] = _.toggle(panel.annotate.sort[1],'desc','asc');set_refresh(true)" ng-class="{'fa-chevron-up': panel.annotate.sort[1] == 'asc','fa-chevron-down': panel.annotate.sort[1] == 'desc'}"></i>
  </div>
</div>
