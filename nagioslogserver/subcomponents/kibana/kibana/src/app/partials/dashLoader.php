<?php include_once('../setlang.inc.php'); ?>

<style>
  .noarrow>a:after {
    display: none !important;
  }
  .dropdown-toggle:hover { text-decoration: none; }
</style>

<div class="container-fluid">
  <span class="brand">
    <i ng-show="dashboard.current.edit_type != 'global' && dashboard.current.edit_type != 'system' && dashboard.current.report != true" style="margin-right: 5px;" class="fa fa-desktop" title="This is a dashboard"></i>
    <i ng-show="dashboard.current.edit_type == 'global' && dashboard.current.edit_type != 'system'" style="margin-right: 5px;" class="fa fa-globe" title="This is a global dashboard"></i> 
    <i ng-show="dashboard.current.edit_type != 'global' && dashboard.current.report == true" style="margin-right: 5px;" class="fa fa-file-text-o" title="This is report"></i>
    {{dashboard.current.title}}
    <span class="dropdown" style="font-size: 13px; font-weight: normal; vertical-align: middle;" ng-show="showDropdown('load')">
      <a data-placement="bottom" class="dropdown-toggle" data-toggle="dropdown" ng-click="elasticsearch_dblist('title:'+elasticsearch.query+'*')" style="margin-right: 5px; margin-left: 5px;">
        <i class='fa-folder-open' style="margin: 0;"></i> <?php echo _('Change'); ?>
      </a>
      <a class="dropdown-toggle" ng-click="fullscreen()">
        <i class='fa-arrows-alt atn00' style="margin: 0;"></i> <span class="atn01"><?php echo _('Fullscreen'); ?></span>
      </a>
      <ul class="dropdown-menu" style="padding:10px; width: 320px;">
        <li ng-if='dashboard.current.loader.load_elasticsearch != false'>
          <form class="nomargin">
            <input type="text" ng-model="elasticsearch.query" ng-change="elasticsearch_dblist('title:'+elasticsearch.query+'*')" placeholder="<?php echo _('Type to filter'); ?>" style="width: 306px;">
          </form>
          <h6 ng-hide="elasticsearch.dashboards.length"><?php echo _('No dashboards matching your query found'); ?></h6>
          <table class="table table-condensed table-striped kibana-load" style="margin-bottom: 0;">
            <tr bindonce ng-repeat="row in elasticsearch.dashboards | orderBy:['_source.title']">
              <td>
                <a href="admin/report#/dashboard/report/{{row._id}}" bo-text="row._source.title" ng-show="dashboard.current.report == true"></a>
                <i ng-show="row._source.user == 'global'" class="fa fa-globe"></i>
                <a href="dashboard#/dashboard/elasticsearch/{{row._id}}" bo-text="row._source.title" ng-show="dashboard.current.report != true"></a>
              </td>
              <td style="width: 12px; text-align: center;">
                <a ng-show="(row._source.user != 'global' || admin_perms() == 1) && dashboard.current.dash_type == 'elasticsearch' && (row._id != 'guided' && row._id != 'default' && row._id != 'blank')" confirm-click="elasticsearch_delete(row._id, 'dashboard')" confirmation="<?php echo _('Are you sure you want to delete the'); ?> {{row._source.title}} <?php echo _('dashboard'); ?>"><i class="fa-remove"></i></a>
                <a ng-show="dashboard.current.report == true" confirm-click="elasticsearch_delete(row._id, 'report')" confirmation="<?php echo _('Are you sure you want to delete'); ?>: {{row._source.title}}"><i class="fa-remove"></i></a>
              </td>
            </tr>
          </table>
        </li>
      </ul>
    </span>
  </span>
    
  <ul class="nav pull-right no-print">

    <li ng-repeat="pulldown in dashboard.current.nav" ng-controller="PulldownCtrl" ng-show="pulldown.enable">
      <kibana-simple-panel type="pulldown.type" ng-cloak></kibana-simple-panel>
    </li>

    <li ng-show="dashboard.current.loader.home != false">
      <button class="btn" bs-tooltip="'<?php echo _('Goto saved default'); ?>'" data-placement="bottom" onclick="window.location='dashboard#'" style="margin-right: 5px;">
        <i class='fa-home'></i>
      </button>
    </li>

    <li ng-show="dashboard.current.queriesmanager != false" bs-tooltip="'<?php echo _('Manage queries'); ?>'" data-placement="bottom">
      <button class="btn" config-modal="app/partials/managequeries.php" kbn-model="dashboard" style="margin-right: 5px; margin-left: 5px;">
        <i class="fa fa-search"></i>
      </button>
    </li>

    <li ng-show="dashboard.current.alertable != false" bs-tooltip="'<?php echo _('Create an alert'); ?>'" data-placement="bottom">
      <button class="btn" config-modal="app/partials/alerteditor.php" kbn-model="dashboard" style="margin-right: 5px; margin-left: 5px;">
        <i class="fa fa-bell"></i>
      </button>
    </li>

    <li class="dropdown" ng-show="showDropdown('load')">
      <button bs-tooltip="'<?php echo _('Load'); ?>'" data-placement="bottom" class="btn dropdown-toggle" data-toggle="dropdown" ng-click="elasticsearch_dblist('title:'+elasticsearch.query+'*')"  style="margin-right: 5px; margin-left: 5px;">
        <i class='fa-folder-open' style="margin: 0;"></i>
      </button>

      <ul class="dropdown-menu" style="padding:10px; width: 320px;">
        <li ng-if='dashboard.current.loader.load_elasticsearch != false'>
          <form class="nomargin">
            <input type="text" ng-model="elasticsearch.query" ng-change="elasticsearch_dblist('title:'+elasticsearch.query+'*')" placeholder="<?php echo _('Type to filte'); ?>r" style="width: 306px;">
          </form>
          <h6 ng-hide="elasticsearch.dashboards.length"><?php echo _('No dashboards matching your query found'); ?></h6>
          <table class="table table-condensed table-striped kibana-load">
            <tr bindonce ng-repeat="row in elasticsearch.dashboards | orderBy:['_source.title']">
              <td>
                <a href="admin/report#/dashboard/report/{{row._id}}" bo-text="row._source.title" ng-show="dashboard.current.report == true"></a>
                <i ng-show="row._source.user == 'global'" class="fa fa-globe"></i>
                <a href="dashboard#/dashboard/elasticsearch/{{row._id}}" bo-text="row._source.title" ng-show="dashboard.current.report != true"></a>
              </td>
              <td style="width: 12px; text-align: center;">
                <a ng-show="(row._source.user != 'global' || admin_perms() == 1) && dashboard.current.dash_type == 'elasticsearch' && (row._id != 'guided' && row._id != 'default' && row._id != 'blank')" confirm-click="elasticsearch_delete(row._id, 'dashboard')" confirmation="<?php echo _('Are you sure you want to delete the'); ?> {{row._source.title}} <?php echo _('dashboard'); ?>"><i class="fa-remove"></i></a>
                <a ng-show="dashboard.current.report == true" confirm-click="elasticsearch_delete(row._id, 'report')" confirmation="<?php echo _('Are you sure you want to delete'); ?>: {{row._source.title}}"><i class="fa-remove"></i></a>
              </td>
            </tr>
          </table>
        </li>

        <li class="dropdown-submenu noarrow">
          <a tabindex="-1" class="small" style="padding:0"><i class="fa-caret-left"></i> <?php echo _('Advanced'); ?></a>
          <ul class="dropdown-menu" style="padding:10px">
            <li>
              <h5><?php echo _('Import dashboard from file'); ?> <tip><?php echo _('Load an exported dashboard in JSON layout from file'); ?></tip></h5>
              <form>
                <input type="file" id="dashupload" dash-upload /><br>
              </form>
            </li>
            <li>
              <h5><?php echo _('Gist'); ?> <tip><?php echo _('Enter a gist number or url'); ?></tip></h5>
              <form>
                <input type="text" ng-model="gist.url" placeholder="<?php echo _("Gist number or URL"); ?>"><br>
                <button class="btn" ng-click="gist_dblist(dashboard.gist_id(gist.url))" ng-show="dashboard.is_gist(gist.url)"><i class="fa-github-alt"></i> <?php echo _('Get gist'); ?>:{{gist.url | gistid}}</button>
                <h6 ng-show="gist.files.length"><?php echo _('Dashboards in gist'); ?>:{{gist.url | gistid}} <small><?php echo _('click to load'); ?></small></h6>
                <h6 ng-hide="gist.files.length || !gist.url.length"><?php echo _('No gist dashboards found'); ?></h6>
                <table class="table table-condensed table-striped">
                  <tr ng-repeat="file in gist.files">
                    <td><a ng-click="dashboard.dash_load(file, 'elasticsearch')">{{file.title}}</a></td>
                  </tr>
                </table>
              </form>
            </li>
          </ul>
        </li>

      </ul>
    </li>

    <li class="dropdown" ng-show="showDropdown('save')">
      <div class="btn-group" id="save-dash-div" style="margin-right: 5px; margin-left: 5px;" bs-tooltip="'<?php echo _('Save'); ?>'" data-placement="bottom">
        <button id="save-dash-button" class="btn btn-success" ng-click="elasticsearch_save('save', false, true)" ng-show="(dashboard.current.dash_type == 'elasticsearch' || dashboard.current.dash_type == 'report') && (dashboard.current.edit_type != 'global' || admin_perms() == 1) && dashboard.current.edit_type != 'system'"><i class="fa fa-floppy-o"></i></button>
        <button class="btn" disabled ng-show="(dashboard.current.dash_type != 'elasticsearch' && dashboard.current.dash_type != 'report') || (dashboard.current.edit_type == 'global' && admin_perms() == 0) || dashboard.current.edit_type == 'system'"><i class="fa fa-floppy-o"></i></button>
        <button class="btn dropdown-toggle" data-placement="bottom" data-toggle="dropdown">
          <i class="fa fa-caret-down" style="margin: 0;"></i>
        </button>
        <ul class="dropdown-menu pull-right" style="padding: 10px; width: 306px;">
          <li ng-show="dashboard.current.loader.save_elasticsearch != false" style="margin-bottom: 10px;">
              <form class="input-append nomargin" name="saveas">
                <input class='input-medium' type="text" ng-model="elasticsearch.title" placeholder="<?php echo _("Save as..."); ?>" style="width: 200px;">
                <button class="btn" bs-tooltip="'<?php echo _('Save as'); ?>...'" ng-show="dashboard.current.report != true && (dashboard.current.dash_type == 'elasticsearch' || dashboard.current.dash_type == 'file')" ng-click="elasticsearch_save('dashboard')"><i class="fa-sign-in" style="font-size: 15px; vertical-align: middle;"></i></button>
                <button class="btn" bs-tooltip="'<?php echo _('Save as'); ?>...'" ng-show="dashboard.current.report == true" ng-click="elasticsearch_save('report')"><i class="fa-sign-in" style="font-size: 15px; vertical-align: middle;"></i></button>
                <button ng-show="admin_perms() == 1 && dashboard.current.report != true && (dashboard.current.dash_type == 'elasticsearch' || dashboard.current.dash_type == 'file')" class="btn" bs-tooltip="'<?php echo _('Save as global dashboard'); ?>...'" ng-click="elasticsearch_save('global-dashboard')"><i class="fa-globe" style="font-size: 15px; vertical-align: middle;"></i> <i class="fa-sign-in" style="font-size: 15px; vertical-align: middle;"></i></button>
              </form>
          </li>
          <li class="dropdown-submenu noarrow">
            <a tabindex="-1" class="small" style="padding:0"><?php echo _('Advanced'); ?> <i class="fa-caret-right"></i></a>
            <ul class="dropdown-menu pull-left">
              <li ng-show="dashboard.current.report != true">
                <a class="link" ng-click="set_default()"><?php echo _('Set as Default Dashboard'); ?></a>
              </li>
              <li>
                <a ng-show="dashboard.current.report != true" class="link" ng-click="dashboard.to_file()"><?php echo _('Export Dashboard'); ?>...</a>
                <a ng-show="dashboard.current.report == true" class="link" ng-click="dashboard.to_file()"><?php echo _('Export Report'); ?>...</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </li>

    <li ng-show="dashboard.current.report != true && showDropdown('share')">
      <button class="btn" bs-tooltip="'<?php echo _('Share'); ?>'" data-placement="bottom" ng-click="elasticsearch_save('temp',dashboard.current.loader.save_temp_ttl)" bs-modal="'app/partials/dashLoaderShare.php'" style="margin-right: 5px; margin-left: 5px;">
        <i class='fa-share'></i>
      </button>
    </li>

    <li ng-show="dashboard.current.editable" bs-tooltip="'<?php echo _('Configure dashboard'); ?>'" data-placement="bottom">
      <button class="btn" config-modal="app/partials/dasheditor.php" kbn-model="dashboard" style="margin-right: 5px; margin-left: 5px;">
        <i class='fa-cog'></i>
      </button>
    </li>

  </ul>
</div>