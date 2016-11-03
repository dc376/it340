<?php include_once('../../setlang.inc.php'); ?>

<div ng-controller='text' ng-init="init()">
  <!--<p ng-style="panel.style" ng-bind-html-unsafe="panel.content | striphtml | newlines"></p>-->
  <markdown ng-show="ready && panel.mode == 'markdown'">
    {{panel.content}}
  </markdown>
  <p ng-show="panel.mode == 'text'" ng-style='panel.style' ng-bind-html="panel.content | striphtml | newlines">
  </p>
  <div ng-show="panel.mode == 'html'" ng-bind-html-unsafe="panel.content">
  </div>
</div>