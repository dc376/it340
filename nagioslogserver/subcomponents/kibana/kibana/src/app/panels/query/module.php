<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='query' ng-init="init()" class="query-panel">

  <span class="dropdown" style="font-size: 13px; font-weight: normal; vertical-align: middle;">
      <a data-placement="bottom" class="dropdown-toggle" data-toggle="dropdown" ng-click="get_queries(nls_query)" style="margin-right: 5px; margin-left: 5px;">
        <i class='fa fa-question-circle' style="margin: 0;"></i> <?php echo _('Load Query'); ?>
      </a>
      <span style="margin-right: 10px;" id="query-name" ng-show="dashboard.current.loaded_query">{{dashboard.current.loaded_query}}</span>
      <ul class="dropdown-menu" style="padding:10px; width: 320px;">
        <li>
          <form class="nomargin">
            <input type="text" ng-model="nls_query" ng-change="get_queries(nls_query)" placeholder="<?php echo _('Type to filter'); ?>" style="width: 306px;">
          </form>
          <h6 ng-hide="nls_queries.length"><?php echo _('No queries found'); ?></h6>
          <table class="table table-condensed table-striped kibana-load" style="margin-bottom: 0;">
            <tr bindonce ng-repeat="row in nls_queries | orderBy:['name']">
              <td>
                <i ng-show="row.show_everyone == 1" class="fa fa-globe"></i>
                <a bo-text="row.name" ng-click="dash_edited(); dashboard.reload_nls_dash(row.id);"></a>
              </td>
            </tr>
          </table>
        </li>
      </ul>
    </span>

  <div ng-repeat="id in (unPinnedQueries = (dashboard.current.services.query.ids|pinnedQuery:false))" ng-class="{'short-query': unPinnedQueries.length>1, 'xl-query': unPinnedQueries.length == 1}">
    <form class="form-search" style="position:relative;margin:5px 0;" ng-submit="refresh()">
      <span class="begin-query">
        <i class="pointer" ng-class="queryIcon(dashboard.current.services.query.list[id].type)" ng-show="dashboard.current.services.query.list[id].enable" data-unique="1" bs-popover="'app/panels/query/meta.php'" data-placement="bottomLeft" ng-style="{color: dashboard.current.services.query.list[id].color}"></i>
        <i class="pointer fa-circle-blank" ng-click="dashboard.current.services.query.list[id].enable=true;dashboard.refresh();" ng-hide="dashboard.current.services.query.list[id].enable" bs-tooltip="'<?php echo _('Activate query'); ?>'" ng-style="{color: dashboard.current.services.query.list[id].color}"></i>
        <i class="fa-remove-sign pointer remove-query" ng-show="dashboard.current.services.query.ids.length > 1" ng-click="querySrv.remove(id);refresh()"></i>
      </span>
      <span>
        <input class="search-query panel-query" ng-disabled="!dashboard.current.services.query.list[id].enable" ng-class="{ 'input-block-level': unPinnedQueries.length==1, 'last-query': $last, 'has-remove': dashboard.current.services.query.ids.length > 1 }" bs-typeahead="panel.history" data-min-length=0 data-items=100 type="text" ng-model="dashboard.current.services.query.list[id].query" ng-change="query_edited()" />
      </span>
      <span class="end-query">
        <i class="fa-search pointer" ng-click="refresh()" ng-show="$last"></i>
        <i class="fa-plus pointer" ng-click="dash_edited(); query_edited(); querySrv.set({})" ng-show="$last"></i>
      </span>
    </form>
  </div>
  <div style="display:inline-block" ng-repeat="id in dashboard.current.services.query.ids|pinnedQuery:true">
    <span class="pointer badge pins" ng-show="$first" ng-click="panel.pinned = !panel.pinned"><?php echo _('Pinned'); ?> <i ng-class="{'fa-caret-right':panel.pinned,'fa-caret-left':!panel.pinned}"></i></span>
    <span ng-show="panel.pinned" class="badge pinned">
      <i class="fa-circle pointer" ng-show="dashboard.current.services.query.list[id].enable" ng-style="{color: dashboard.current.services.query.list[id].color}" data-unique="1" bs-popover="'app/panels/query/meta.php'" data-placement="bottomLeft"></i>
      <i class="pointer fa-circle-blank" bs-tooltip="'<?php echo _('Activate query'); ?>Activate query'" ng-click="dashboard.current.services.query.list[id].enable=true;dashboard.refresh();" ng-hide="dashboard.current.services.query.list[id].enable" ng-style="{color: dashboard.current.services.query.list[id].color}"></i>
      <span bs-tooltip="dashboard.current.services.query.list[id].query | limitTo:45"> {{dashboard.current.services.query.list[id].alias || dashboard.current.services.query.list[id].query}}</span>
    </span>
  </div>
  <span style="display:inline-block" ng-show="unPinnedQueries.length == 0">
    <i class="fa-search pointer" ng-click="refresh()"></i>
    <i class="fa-plus pointer" ng-click="querySrv.set({})"></i>
  </span>
</div>