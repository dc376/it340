<?php include_once('../../setlang.inc.php'); ?>

  <div class="editor-row">
    <div class="section">
      <div class="editor-option">
        <h6><?php echo _('Show Controls'); ?></h6><input type="checkbox" ng-model="panel.paging" ng-checked="panel.paging">
      </div>
      <div class="editor-option">
        <h6><?php echo _('Overflow'); ?></h6>
        <select class="input-small" ng-model="panel.overflow" ng-options="f.value as f.key for f in [{key:'scroll',value:'height'},{key:'expand',value:'min-height'}]"></select>
      </div>
    </div>

    <div class="section">
      <div class="editor-option">
        <h6><?php echo _('Per Page'); ?></h6>
        <input type="number" class="input-mini" ng-model="panel.size" ng-change="get_data()">
      </div>
      <div class="editor-option">
        <h6>&nbsp;</h6>
        <center><i class='fa-remove'></i><center>
      </div>
      <div class="editor-option">
        <h6><?php echo _('Page limit'); ?></h6>
        <input type="number" class="input-mini" ng-model="panel.pages" ng-change="get_data()">
      </div>
      <div class="editor-option large">
        <h6><?php echo _('Pageable'); ?></h6>
        <strong class="large">= {{panel.size * panel.pages}}</strong>
      </div>
    </div>

  </div>

