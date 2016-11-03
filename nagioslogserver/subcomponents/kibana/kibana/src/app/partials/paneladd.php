<?php include_once('../setlang.inc.php'); ?>

  <div ng-include="'app/partials/panelgeneral.php'"></div>
  <div ng-include="edit_path(panel.type)"></div>
  <div ng-repeat="tab in panelMeta.editorTabs">
    <h5>{{tab.title}}</h5>
    <div ng-include="tab.src"></div>
  </div>