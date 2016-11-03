<?php include_once('../../setlang.inc.php'); ?>

  <div class="editor-row">
    <div class="editor-option">
      <form>
        <h6><?php echo _('Coordinate Field'); ?> <tip>geoJSON <?php echo _('array'); ?>! Long,Lat <?php echo _('NOT'); ?> Lat,Long</tip></h6>
        <input  bs-typeahead="fields.list" type="text" class="input-small" ng-model="panel.field">
      </form>
    </div>
    <div class="editor-option">
      <form>
        <h6><?php echo _('Tooltip Field'); ?></h6>
        <input  bs-typeahead="fields.list" type="text" class="input-small" ng-model="panel.tooltip">
      </form>
    </div>
    <div class="editor-option"><h6><?php echo _('Max Points'); ?></h6>
      <input type="number" class="input-small" ng-model="panel.size">
    </div>
  </div>
