<?php include_once('../../../setlang.inc.php'); ?>

  <fieldset>
    <label class="small"><?php echo _('Field'); ?></label><br>
    <input ng-model="dashboard.current.services.query.list[id].field" type="text" bs-typeahead="fields.list" placeholder="<?php echo _('Field'); ?>">
    <p>
    <label class="small"><?php echo _('Count'); ?></label><br>
    <input ng-model="dashboard.current.services.query.list[id].size" type="number">
    <p>
    <label class="small"><?php echo _('Union'); ?></label><br>
      <select class="input-small" ng-model="dashboard.current.services.query.list[id].union">
      <option ng-repeat="mode in ['none','AND','OR']">{{mode}}</option>
    </select>
  </fieldset>
