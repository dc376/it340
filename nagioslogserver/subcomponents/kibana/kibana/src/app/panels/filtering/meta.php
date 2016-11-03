<?php include_once('../../setlang.inc.php'); ?>

<div>
  <style>
    .input-query-alias {
      margin-bottom: 5px !important;
    }
  </style>
  <a class="close" ng-click="render();dismiss();" href="">×</a>
  <h6><?php echo _('Query Alias'); ?></h6>
  <form>
    <input class="input-medium input-query-alias" type="text" ng-model="queries.list[id].alias" placeholder='<?php echo _('Alias'); ?>...' />
    <div>
      <i ng-repeat="color in queries.colors" class="pointer" ng-class="{'fa-circle-blank':queries.list[id].color == color,'fa-circle':queries.list[id].color != color}" style="color:{{color}}" ng-click="queries.list[id].color = color;render();"> </i>
    </div>
  </form>
</div>