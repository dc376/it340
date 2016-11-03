<?php include_once('../../setlang.inc.php'); ?>

<div>
  <h5><?php echo _('Allow saving to'); ?></h5>
  <div class="row-fluid">
    <div class="span2">
      <label class="small"><?php echo _('Export'); ?></label><input type="checkbox" ng-model="panel.save.local" ng-checked="panel.save.local">
    </div>
    <div class="span2">
      <label class="small"><?php echo _('Defaults'); ?></label><input type="checkbox" ng-model="panel.save.default" ng-checked="panel.save.default">
    </div>
    <div class="span2">
      <label class="small"><?php echo _('Gist'); ?> <tip><?php echo _('Requires your domain to be OAUTH registered with Github'); ?><tip></label><input type="checkbox" ng-model="panel.save.gist" ng-checked="panel.save.gist">
    </div>
    <div class="span2">
      <label class="small"><?php echo _('Elasticsearch'); ?></label><input type="checkbox" ng-model="panel.save.elasticsearch" ng-checked="panel.save.elasticsearch">
    </div>
  </div>
  <h5><?php echo _('Allow loading from'); ?></h5>
  <div class="row-fluid">
    <div class="span2">
      <label class="small"><?php echo _('Local file'); ?></label><input type="checkbox" ng-model="panel.load.local" ng-checked="panel.load.local">
    </div>
    <div class="span2">
      <label class="small"><?php echo _('Gist'); ?></label><input type="checkbox" ng-model="panel.load.gist" ng-checked="panel.load.gist">
    </div>
    <div class="span2">
      <label class="small"><?php echo _('Elasticsearch'); ?></label><input type="checkbox" ng-model="panel.load.elasticsearch" ng-checked="panel.load.elasticsearch">
    </div>
    <div class="span3" ng-show="panel.load.elasticsearch">
      <label class="small"><?php echo _('ES list size'); ?></label><input class="input-mini" type="number" ng-model="panel.elasticsearch_size">
    </div>
  </div>
  <h5><?php echo _('Sharing'); ?></h5>
  <div class="row-fluid">
    <div class="span2" >
      <label class="small"><?php echo _('Allow Sharing'); ?></label><input type="checkbox" ng-model="panel.temp" ng-checked="panel.temp">
    </div>
    <div class="span2" ng-show="panel.temp">
      <label class="small"><?php echo _('TTL'); ?></label><input type="checkbox" ng-model="panel.ttl_enable" ng-checked="panel.temp">
    </div>
    <div class="span5" ng-show="panel.temp && panel.ttl_enable">
      <label class="small"><?php echo _('TTL Duration'); ?> <i class="fa-question-sign" bs-tooltip="'<?php echo _('Elasticsearch date math'); ?>, eg: 1m,1d,1w,30d'"></i></label><input class="input-small" type="text" ng-model="panel.temp_ttl">
    </div>
  </div>
</div>