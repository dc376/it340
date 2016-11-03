<?php include_once('../setlang.inc.php'); ?>

<div bindonce class="modal-body">
  <div class="pull-right editor-title" bo-text="lang(panel.type)+' <?php echo _('settings'); ?>'"></div>
  <div ng-model="editor.index" bs-tabs>
    <div ng-repeat="tab in setEditorTabs(panelMeta)" data-title="{{tab}}">
    </div>
  </div>
  <div ng-show="editorTabs[editor.index] == '<?php echo _('General'); ?>'">
    <div ng-include src="'app/partials/panelgeneral.php'"></div>
  </div>
  <div ng-show="editorTabs[editor.index] == '<?php echo _('Panel'); ?>'">
    <div ng-include src="edit_path(panel.type)"></div>
  </div>
  <div ng-repeat="tab in panelMeta.editorTabs" ng-show="editorTabs[editor.index] == tab.title">
    <div ng-include src="tab.src"></div>
  </div>
</div>

<div class="modal-footer">
  <!-- close_edit() is provided here to allow for a scope to perform action on dismiss -->
  <button type="button" class="btn btn-success" ng-click="editor.index=0;editSave(panel);close_edit();dismiss()"><?php echo _('Save'); ?></button>
  <button type="button" class="btn btn-default" ng-click="editor.index=0;dismiss()"><?php echo _('Cancel'); ?></button>
</div>