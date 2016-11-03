<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='table' ng-init='init()'>
  <style>
    .table-doc-table {
      margin-left: 0px !important;
      overflow-y: auto;
    }
    .table-sidebar {
      width: 200px;
      display: table-cell;
      padding-right: 10px;
    }
    .table-main {
      width: 100%;
      display: table-cell;
    }
    .table-container {
      display: table;
      height: 100px;
      width: 100%;
      table-layout: fixed;
    }
    .table-fieldname {
      white-space: nowrap;
    }

    .table-fieldname a {
      word-wrap:break-word;
      white-space: normal;
    }

    .table-details {
      table-layout: fixed;
      border: 2px solid #dddddd;
    }
    
    .expanded-table {
        margin: 30px; 
    }

    .table-details-field {
      width: 200px;
    }

    .table-details-action {
      width: 60px;
      text-align: center;
    }

    .table-details-value {
    }

    .table-field-value {
      white-space: pre-wrap;
    }

    .table-facet {
      padding: 10px;
      border: 1px solid #666;
    }
  </style>

  <div class="table-container">

    <div ng-if="!panel.field_list" class="no-print">
      <strong><?php echo _('Show Fields'); ?> <i class="fa-chevron-sign-right pointer" ng-click="panel.field_list = true" bs-tooltip="'<?php echo _('Show list of fields'); ?>'"></i></strong><p>
    </div>

    <div bindonce ng-class="{'table-sidebar':panel.field_list}" ng-if="panel.field_list" class="no-print">
      <div style="{{panel.overflow}}:{{panel.height||row.height}};overflow-y:auto">

        <strong><?php echo _('Fields'); ?> <i class="fa-chevron-sign-left pointer" ng-click="panel.field_list = !panel.field_list" bs-tooltip="'<?php echo _('Hide list of fields'); ?>'"></i></strong><p>

        <div class="small">
          <span class="link small" ng-click="panel.all_fields = true;" ng-if="fields.list.length" ng-class="{strong:panel.all_fields}">
            <?php echo _('All'); ?> ({{fields.list.length}})</span> /
          <span class="link small" ng-click="panel.all_fields = false;" ng-class="{strong:!panel.all_fields}">
            <?php echo _('Current'); ?> ({{current_fields.length || 0}})</span>
        </div>

        <div><input type="text" class="input-medium" placeholder="<?php echo _('Type to filter'); ?>..." ng-model="fieldFilter">
        </div>

        <div ng-show="panel.all_fields" class="small muted" style="margin-bottom:10px">
          <strong><?php echo _('Note'); ?></strong> <?php echo _('These fields have been<br>extracted from your mapping.<br>Not all fields may be available<br>in your source document.'); ?>
        </div>

        <ul class="unstyled" ng-if="panel.all_fields">
          <li class="table-fieldname" ng-style="panel.style" ng-repeat="field in fields.list|filter:fieldFilter|orderBy:identity">
            <i class="pointer" ng-class="{'icon-check': columns[field],'icon-check-empty': _.isUndefined(columns[field])}" ng-click="toggle_field(field)"></i>
            <a class="pointer" data-unique="1" bs-popover="'app/panels/table/micropanel.php'" data-placement="rightTop" ng-click="toggle_micropanel(field,true)" ng-class="{label: columns[field]}"><i class="fa fa-filter"></i> {{field}}</a>
          </li>
        </ul>

        <ul class="unstyled" ng-if="!panel.all_fields">
          <li class="table-fieldname"  ng-style="panel.style" ng-repeat="field in current_fields|filter:fieldFilter|orderBy:identity">
            <i class="pointer" ng-class="{'icon-check': columns[field],'icon-check-empty': _.isUndefined(columns[field])}" ng-click="toggle_field(field)"></i>
            <a class="pointer" data-unique="1" bs-popover="'app/panels/table/micropanel.php'" data-placement="rightTop" ng-click="toggle_micropanel(field,true)" ng-class="{label: columns[field]}"><i class="fa fa-filter"></i> {{field}}</a>
          </li>
        </ul>

      </div>
    </div>

    <div ng-class="{'table-main':panel.field_list}" class="table-doc-table">

      <div style="{{panel.overflow}}:{{panel.height||row.height}};overflow-y:auto">
        <div class="table-facet" ng-if="modalField">
          <h4>
            <button class="btn btn-mini btn-danger" ng-click="closeFacet();"><?php echo _('Close'); ?></button>
            {{adhocOpts.title}}
            <span class="pointer ng-scope ng-pristine ng-valid ui-draggable" bs-tooltip="'<?php echo _('Drag to add to dashboard'); ?>'"
              data-drag="true"
              data-jqyoui-options="kbnJqUiDraggableOptions"
              jqyoui-draggable="{animate:false,mutate:false,onStart:'panelMoveStart',onStop:'panelMoveStop',embedded:true}"
              ng-model="adhocOpts"
              data-original-title=""
              title=""
              aria-disabled="false" style="position: relative;"><i class="icon-move"></i></span>
          </h4>
          <kibana-simple-panel type="'{{facetType}}'" panel='{{facetPanel}}' ng-cloak></kibana-simple-panel>
        </div>

        <i class="pull-left icon-chevron-sign-right pointer" ng-click="panel.field_list = !panel.field_list" bs-tooltip="'<?php echo _('Show list of fields'); ?>'" ng-show="!panel.field_list"></i>
        <div class="row-fluid" ng-show="panel.paging">
          <div class="span1 offset1" style="text-align:right">
            <i ng-click="panel.offset = 0" ng-show="panel.offset > 0" class='icon-circle-arrow-left pointer'></i>
            <i ng-click="panel.offset = (panel.offset - panel.size)" ng-show="panel.offset > 0" class='icon-arrow-left pointer'></i>
          </div>
          <div class="span8" style="text-align:center">
            <strong>{{panel.offset}}</strong> <?php echo _('to'); ?> <strong>{{panel.offset + data.slice(panel.offset,panel.offset+panel.size).length}}</strong>
            <small> <?php echo _('of'); ?> {{data.length}} <?php echo _('available for paging'); ?></small>
          </div>
          <div class="span1" style="text-align:left">
            <i ng-click="panel.offset = (panel.offset + panel.size)" ng-show="data.length > panel.offset+panel.size" class='icon-arrow-right pointer'></i>
          </div>
        </div>
        <table class="table-hover table table-condensed" ng-style="panel.style">
          <thead ng-show="panel.header">
            <th ng-show="panel.fields.length<1">_source (<?php echo _('select columns from the list to the left'); ?>)</th>
            <th style="white-space:nowrap" ng-repeat="field in panel.fields">
              <i ng-show="!$first" class="pointer link fa-angle-left" ng-click="_.move(panel.fields,$index,$index-1)"></i>

              <span  class="pointer" ng-click="set_sort(field)" ng-show='panel.sortable'>
                {{field}}
                <i ng-show='field == panel.sort[0]' class="pointer link" ng-class="{'icon-chevron-up': panel.sort[1] == 'asc','icon-chevron-down': panel.sort[1] == 'desc'}"></i>
              </span>
              <span ng-show='!panel.sortable'>{{field}}</span>
              <i ng-show="!$last" class="pointer link fa-angle-right" ng-click="_.move(panel.fields,$index,$index+1)"></i>
            </th>
            <th style="width:150px;text-align:right;"><?php echo _('Actions'); ?></th>
          </thead>
          <tbody bindonce ng-repeat="event in data| slice:panel.offset:panel.offset+panel.size" ng-class-odd="'odd'">
            <tr class="pointer">
              <td ng-click="toggle_details(event)" ng-if="panel.fields.length<1" bo-text="event._source|stringify|tableTruncate:panel.trimFactor:1"></td>
              <td ng-click="toggle_details(event)" ng-show="panel.fields.length>0" ng-repeat="field in panel.fields">
                <span ng-if="!panel.localTime || panel.timeField != field" bo-html="(event.kibana.highlight[field]||event.kibana._source[field]) | tableHighlightLinkNoXML | tableTruncate:panel.trimFactor:panel.fields.length" class="table-field-value"></span>
                <span ng-if="panel.localTime && panel.timeField == field" bo-html="event.sort[1]|tableLocalTime:event" class="table-field-value"></span>
              </td>
              <td style="width: 80px;">
                <div ng-if="event._source.message" class="btn-group" style="width: 100%; text-align: right;">
                    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" style="display: inline-block;"><i class="fa fa-search"></i> <span style="margin-left: 4px;" class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu" style="min-width:120px; margin:0 0 10px 25px">
                        <li><a href="https://www.google.com/#q={{event._source.message|removeiphostnames|queryencode|tableTruncate:2000:1}}" target="_blank" title="<?php echo _('Search for this entry on Google'); ?>">Google</a></li>
                        <li><a href="http://www.bing.com/search?q={{event._source.message|removeiphostnames|queryencode|tableTruncate:2000:1}}" target="_blank" title="<?php echo _('Search for this entry on Bing'); ?>">Bing</a></li>
                        <li><a href="http://stackoverflow.com/search?q={{event._source.message|removeiphostnames|queryencode|tableTruncate:2000:1}}" target="_blank" title="<?php echo _('Search for this entry on StackOverflow'); ?>">StackOverflow</a></li>
                    </ul>
                </div>
              </td>
            </tr>
            <tr ng-if="event.kibana.details">
              <td colspan={{panel.fields.length+1}} ng-switch="event.kibana.view">
                <span>
                  <?php echo _('View'); ?>:
                <a class="link" ng-class="{'strong':event.kibana.view == 'table'}" ng-click="event.kibana.view = 'table'"><?php echo _('Table'); ?></a> /
                <a class="link" ng-class="{'strong':event.kibana.view == 'json'}" ng-click="event.kibana.view = 'json'">JSON</a> /
                <a class="link" ng-class="{'strong':event.kibana.view == 'raw'}" ng-click="event.kibana.view = 'raw'"><?php echo _('Raw'); ?></a>
                <i class="link pull-right fa-chevron-up" ng-click="toggle_details(event)"></i>
              </span>
              <div class="expanded-table">
              <table class='table table-bordered table-condensed table-details' ng-switch-when="table">
                <thead>
                  <th class="table-details-field"><?php echo _('Field'); ?></th>
                    <th class="table-details-action"><?php echo _('Action'); ?></th>
                    <th class="table-details-value"><?php echo _('Value'); ?></th>
                    <th style="width:150px;text-align:right;"><?php echo _('Search'); ?></th>
                  </thead>
                <tr ng-repeat="(key,value) in event.kibana._source track by $index" ng-class-odd="'odd'">
                  <td style="word-wrap:break-word">
                    <i class="pointer icon-check-empty" ng-click="toggle_field(key)" ng-class="{'icon-check': columns[key],'icon-check-empty': _.isUndefined(columns[key])}"></i>
                    <span  class="pointer link" ng-click="set_sort(key)" ng-show='panel.sortable'>
                        {{key}}
                        <i ng-show='key == panel.sort[0]' class="pointer link" ng-class="{'icon-chevron-up': panel.sort[1] == 'asc','icon-chevron-down': panel.sort[1] == 'desc'}"></i>
                    </span>
                  </td>
                  <td style="white-space:nowrap">
                    <i class='fa-search pointer' ng-click="build_search(key,value)" bs-tooltip="'<?php echo _('Add filter to match this value'); ?>'"></i>
                    <i class='fa-ban-circle pointer' ng-click="build_search(key,value,true)" bs-tooltip="'<?php echo _('Add filter to NOT match this value'); ?>'"></i>
                    <i class="pointer fa-th" ng-click="toggle_field(key)" bs-tooltip="'<?php echo _('Toggle table column'); ?>'"></i>
                  </td>
                  <!-- At some point we need to create a more efficient way of applying the filter pipeline -->
                  <td style="white-space:pre-wrap;word-wrap:break-word" bo-html="(event.kibana.highlight[key]||event.kibana._source[key]) | tableHighlightLinkNoXML | stringify"></td>
                  <td>
                      <div class="btn-group" style="width:150px;width:100%">
                        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" style="float: right;"><i class="fa fa-search"></i> <span style="margin-left: 4px;" class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu" style="min-width:120px;margin:0 0 10px 25px">
                            <li><a href="https://www.google.com/#q={{event.kibana._source[key]|removeiphostnames|queryencode|tableTruncate:2000:1}}" target="_blank" title="<?php echo _('Search for this entry on Google'); ?>">Google</a></li>
                            <li><a href="http://www.bing.com/search?q={{event.kibana._source[key]|removeiphostnames|queryencode|tableTruncate:2000:1}}" target="_blank" title="<?php echo _('Search for this entry on Bing'); ?>">Bing</a></li>
                            <li><a href="http://stackoverflow.com/search?q={{event.kibana._source[key]|removeiphostnames|queryencode|tableTruncate:2000:1}}" target="_blank" title="<?php echo _('Search for this entry on StackOverflow'); ?>">StackOverflow</a></li>
                        </ul>
                    </div>
                </td>
                </tr>
              </table>
              </div>
              <pre style="white-space:pre-wrap;word-wrap:break-word"  bo-html="without_kibana(event)|tableJson:2" ng-switch-when="json"></pre>
              <pre bo-html="without_kibana(event)|tableJson:1" ng-switch-when="raw"></pre>
            </td>
            </tr>
          </tbody>
      </table>
      <div class="row-fluid" ng-show="panel.paging">
        <div class="span1 offset3" style="text-align:right">
          <i ng-click="panel.offset = 0" ng-show="panel.offset > 0" class='fa-circle-arrow-left pointer'></i>
          <i ng-click="panel.offset = (panel.offset - panel.size)" ng-show="panel.offset > 0" class='fa-arrow-left pointer'></i>
        </div>
        <div class="span4" style="text-align:center">
          <strong>{{panel.offset}}</strong> <?php echo _('to'); ?> <strong>{{panel.offset + data.slice(panel.offset,panel.offset+panel.size).length}}</strong>
          <small> <?php echo _('of'); ?> {{data.length}} <?php echo _('available for paging'); ?></small>
        </div>
        <div class="span1" style="text-align:left">
          <i ng-click="panel.offset = (panel.offset + panel.size)" ng-show="data.length > panel.offset+panel.size" class='fa-arrow-right pointer'></i>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>