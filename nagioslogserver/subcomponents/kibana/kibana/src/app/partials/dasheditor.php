<?php include_once('../setlang.inc.php'); ?>

<div class="modal-body">
  <div class="pull-right editor-title"><?php echo _('Dashboard settings'); ?></div>

  <div ng-model="editor.index" bs-tabs style="text-transform:capitalize;">
    <div ng-repeat="tab in ['<?php echo _('General'); ?>','<?php echo _('Index'); ?>','<?php echo _('Rows'); ?>','<?php echo _('Controls'); ?>']" data-title="{{tab}}">
    </div>
    <div ng-repeat="tab in dashboard.current.nav|editable" data-title="{{tab.title || tab.type}}">
    </div>
  </div>

  <div ng-if="editor.index == 0">
    <div class="editor-row">
      <div class="section">
        <div class="editor-option hide">
          <label class="small">Style</label><select class="input-small" ng-model="dashboard.current.style" ng-options="f for f in ['dark','light']"></select>
        </div>
        <div class="editor-option">
          <label class="small"><?php echo _('Editable'); ?></label><input type="checkbox" ng-model="dashboard.current.editable" ng-checked="dashboard.current.editable" />
        </div>
        <div class="editor-option">
          <label class="small"><?php echo _('Hints'); ?> <tip><?php echo _("Show 'Add panel' hints in empty spaces"); ?></tip></label><input type="checkbox" ng-model="dashboard.current.panel_hints" ng-checked="dashboard.current.panel_hints" />
        </div>
      </div>
    </div>
  </div>
  <div ng-if="editor.index == 1">
    <div class="editor-row">
      <div class="section">
        <h5><?php echo _('Index Settings'); ?></h5>
        <div ng-show="dashboard.current.index.interval != 'none'" class="row-fluid">
           <div class="editor-option">
            <p class="small">
              <?php echo _('Time stamped indices use your selected time range to create a list of indices that match a specified timestamp pattern. This can be very efficient for some data sets (eg, logs) For example, to match the default logstash index pattern you might use'); ?> <code>[logstash-]YYYY.MM.DD</code>. <?php echo _('The [] in'); ?> "[logstash-]" <?php echo _('are important as they instruct Kibana not to treat those letters as a pattern. You may also specify multiple indices by seperating them with a comma(,). For example'); ?> <code>[web-]YYYY.MM.DD,[mail-]YYYY.MM.DD</code> <?php echo _('Please also note that indices should rollover at midnight'); ?> <strong>UTC</strong>.
            </p>
            <p class="small">
              <?php echo _('See'); ?> <a href="http://momentjs.com/docs/#/displaying/format/">http://momentjs.com/docs/#/displaying/format/</a>
              <?php echo _('for documentation on date formatting'); ?>.
            </p>
           </div>
         </div>
      </div>
    </div>
    <div class="editor-row">
      <div class="section">
        <div class="editor-option">
          <h6><?php echo _('Timestamping'); ?></h6><select class="input-small" ng-model="dashboard.current.index.interval" ng-options="f for f in ['none','hour','day','week','month','year']"></select>
        </div>
        <div class="editor-option" ng-show="dashboard.current.index.interval != 'none'">
          <h6><?php echo _('Index pattern'); ?> <small><?php echo _('Absolutes in'); ?> []</small></h6>
          <input type="text" class="input-large" ng-model="dashboard.current.index.pattern">
        </div>
        <div class="editor-option" ng-show="dashboard.current.index.interval != 'none'">
          <h6><?php echo _('Failover'); ?> <i class="fa-question-sign" bs-tooltip="'<?php echo _('If no indices match the pattern, failover to default index *NOT RECOMMENDED*'); ?>'"></i></h6>
          <input type="checkbox" ng-model="dashboard.current.failover" ng-checked="dashboard.current.failover" />
        </div>
        <div class="editor-option" ng-show="dashboard.current.failover || dashboard.current.index.interval == 'none'">
          <h6><?php echo _('Default Index'); ?> <small ng-show="dashboard.current.index.interval != 'none'"><?php echo _('If index not found'); ?></small></h6>
          <input type="text" class="input-medium" ng-model="dashboard.current.index.default">
        </div>
        <div class="editor-option">
          <h6><?php echo _('Preload Fields'); ?> <i class="fa-question-sign" bs-tooltip="'<?php echo _('Preload available fields for the purpose of autocomplete. Turn this off if you have many fields'); ?>'"></i></h6>
          <input type="checkbox" ng-model="dashboard.current.index.warm_fields" ng-checked="dashboard.current.index.warm_fields" />
        </div>
      </div>
    </div>
  </div>

  <div ng-if="editor.index == 2">
    <div class="row-fluid">
      <div class="span8">
        <h4><?php echo _('Rows'); ?></h4>
        <table class="table table-striped">
          <thead>
            <th width="1%"></th>
            <th width="1%"></th>
            <th width="1%"></th>
            <th width="97%"><?php echo _('Title'); ?></th>
          </thead>
          <tr ng-repeat="row in dashboard.current.rows">
            <td><i ng-click="_.move(dashboard.current.rows,$index,$index-1)" ng-hide="$first" class="pointer fa-arrow-up"></i></td>
            <td><i ng-click="_.move(dashboard.current.rows,$index,$index+1)" ng-hide="$last" class="pointer fa-arrow-down"></i></td>
            <td><i ng-click="dashboard.current.rows = _.without(dashboard.current.rows,row)" class="pointer fa-remove"></i></td>
            <td>{{row.title||'Untitled'}}</td>
          </tr>
        </table>
      </div>
      <div class="span4">
        <h4><?php echo _('Add Row'); ?></h4>
        <label class="small"><?php echo _('Title'); ?></label>
        <input type="text" class="input-medium" ng-model='row.title' placeholder="<?php echo _("New row"); ?>"></input>
        <label class="small"><?php echo _('Height'); ?></label>
        <input type="text" class="input-mini" ng-model='row.height'></input>
      </div>
    </div>
    <div class="row-fluid">

    </div>
  </div>

  <div ng-if="editor.index == 3" ng-controller="dashLoader">
    <div class="editor-row">
      <div class="section">
        <h5><?php echo _('Save to'); ?></h5>
        <div class="editor-option">
          <label class="small"><?php echo _('Export'); ?></label><input type="checkbox" ng-model="dashboard.current.loader.save_local" ng-checked="dashboard.current.loader.save_local">
        </div>
        <div class="editor-option">
          <label class="small"><?php echo _('Browser'); ?></label><input type="checkbox" ng-model="dashboard.current.loader.save_default" ng-checked="dashboard.current.loader.save_default">
        </div>
        <div class="editor-option">
          <label class="small"><?php echo _('Gist'); ?> <tip><?php echo _('Requires your domain to be OAUTH registered with Github'); ?><tip></label><input type="checkbox" ng-model="dashboard.current.loader.save_gist" ng-checked="dashboard.current.loader.save_gist">
        </div>
        <div class="editor-option">
          <label class="small"><?php echo _('Elasticsearch'); ?></label><input type="checkbox" ng-model="dashboard.current.loader.save_elasticsearch" ng-checked="dashboard.current.loader.save_elasticsearch">
        </div>
      </div>
      <div class="section">
        <h5><?php echo _('Load from'); ?></h5>
        <div class="editor-option">
          <label class="small"><?php echo _('Local file'); ?></label><input type="checkbox" ng-model="dashboard.current.loader.load_local" ng-checked="dashboard.current.loader.load_local">
        </div>
        <div class="editor-option">
          <label class="small"><?php echo _('Gist'); ?></label><input type="checkbox" ng-model="dashboard.current.loader.load_gist" ng-checked="dashboard.current.loader.load_gist">
        </div>
        <div class="editor-option">
          <label class="small"><?php echo _('Elasticsearch'); ?></label><input type="checkbox" ng-model="dashboard.current.loader.load_elasticsearch" ng-checked="dashboard.current.loader.load_elasticsearch">
        </div>
        <div class="editor-option" ng-show="dashboard.current.loader.load.elasticsearch">
          <label class="small"><?php echo _('ES list size'); ?></label><input class="input-mini" type="number" ng-model="dashboard.current.loader.load_elasticsearch_size">
        </div>
      </div>
      <div class="section">
      <h5><?php echo _('Sharing'); ?></h5>
        <div class="editor-option" >
          <label class="small"><?php echo _('Allow Sharing'); ?> <tip><?php echo _('Allow generating adhoc links to dashboards'); ?></tip></label><input type="checkbox" ng-model="dashboard.current.loader.save_temp" ng-checked="dashboard.current.loader.save_temp">
        </div>
        <div class="editor-option" ng-show="dashboard.current.loader.save_temp">
          <label class="small"><?php echo _('TTL'); ?> <tip><?php echo _('Expire temp urls'); ?></tip></label><input type="checkbox" ng-model="dashboard.current.loader.save_temp_ttl_enable">
        </div>
        <div class="editor-option" ng-show="dashboard.current.loader.save_temp &amp;&amp; dashboard.current.loader.save_temp_ttl_enable">
          <label class="small"><?php echo _('TTL Duration'); ?> <tip><?php echo _('Elasticsearch date math'); ?>, eg: 1m,1d,1w,30d  </tip></label><input class="input-small" type="text" ng-model="dashboard.current.loader.save_temp_ttl">
        </div>
      </div>
    </div>
  </div>

  <div ng-if="editor.index == 3">
    <div class="editor-row">
      <div class="section">
        <h5><?php echo _('Pulldowns'); ?></h5>
        <div class="editor-option" ng-repeat="pulldown in dashboard.current.pulldowns">
          <label class="small" style="text-transform:capitalize;">{{lang(pulldown.type)}}</label><input type="checkbox" ng-model="pulldown.enable" ng-checked="pulldown.enable">
        </div>
        <div class="editor-option" ng-repeat="pulldown in dashboard.current.nav|editable">
          <label class="small" style="text-transform:capitalize;">{{lang(pulldown.type)}}</label><input type="checkbox" ng-model="pulldown.enable" ng-checked="pulldown.enable">
        </div>
      </div>
    </div>
  </div>

  <div ng-repeat="pulldown in dashboard.current.nav|editable" ng-controller="PulldownCtrl" ng-show="editor.index == 4+$index">
    <ng-include ng-show="pulldown.enable" src="edit_path(pulldown.type)"></ng-include>
    <button ng-hide="pulldown.enable" class="btn" ng-click="pulldown.enable = true"><?php echo _('Enable the'); ?> {{pulldown.type}}</button>
  </div>


</div>

<div class="modal-footer">
  <button type="button" ng-click="add_row(dashboard.current,row); reset_row();" class="btn btn-info" ng-show="editor.index == 2"><?php echo _('Create Row'); ?></button>
  <button type="button" class="btn btn-success" ng-click="editor.index=0;editSave(dashboard);dismiss();reset_panel();dashboard.refresh()"><?php echo _('Save'); ?></button>
  <button type="button" class="btn btn-default" ng-click="editor.index=0;dismiss();reset_panel();dashboard.refresh()"><?php echo _('Cancel'); ?></button>
</div>
