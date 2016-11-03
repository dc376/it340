<?php include_once('../setlang.inc.php'); ?>

<div class="modal-body">
  <div class="pull-right editor-title"><?php echo _('Row settings'); ?></div>

  <div ng-model="editor.index" bs-tabs>
    <div ng-repeat="tab in ['<?php echo _('General'); ?>','<?php echo _('Panels'); ?>','<?php echo _('Add Panel'); ?>']" data-title="{{tab}}">
    </div>
  </div>

  <div class="editor-row" ng-if="editor.index == 0">
    <div class="editor-option">
      <label class="small"><?php echo _('Title'); ?></label><input type="text" class="input-medium" ng-model='row.title'></input>
    </div>
    <div class="editor-option">
      <label class="small"><?php echo _('Height'); ?></label><input type="text" class="input-mini" ng-model='row.height'></input>
    </div>
    <div class="editor-option">
      <label class="small"> <?php echo _('Editable'); ?> </label><input type="checkbox" ng-model="row.editable" ng-checked="row.editable" />
    </div>
    <div class="editor-option">
      <label class="small"> <?php echo _('Collapsable'); ?> </label><input type="checkbox" ng-model="row.collapsable" ng-checked="row.collapsable" />
    </div>
  </div>
  <div class="row-fluid" ng-if="editor.index == 1">
    <div class="span12">
      <h4><?php echo _('Panels'); ?></h4>
      <table class="table table-condensed table-striped">
        <thead>
          <th><?php echo _('Title'); ?></th>
          <th><?php echo _('Type'); ?></th>
          <th><?php echo _('Span'); ?> <span class="small">({{rowSpan(row)}}/12)</span></th>
          <th><?php echo _('Delete'); ?></th>
          <th><?php echo _('Move'); ?></th>
          <th></th>
          <th><?php echo _('Hide'); ?></th>
        </thead>
        <tr ng-repeat="panel in row.panels">
          <td>{{panel.title}}</td>
          <td>{{panel.type}}</td>
          <td><select ng-hide="panel.sizeable == false" class="input-mini" ng-model="panel.span" ng-options="size for size in [1,2,3,4,5,6,7,8,9,10,11,12]"></select></td>
          <td><i ng-click="row.panels = _.without(row.panels,panel)" class="pointer fa-remove"></i></td>
          <td><i ng-click="_.move(row.panels,$index,$index-1)" ng-hide="$first" class="pointer fa-arrow-up"></i></td>
          <td><i ng-click="_.move(row.panels,$index,$index+1)" ng-hide="$last" class="pointer fa-arrow-down"></i></td>
          <td><input type="checkbox" ng-model="panel.hide" ng-checked="panel.hide"></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row-fluid" ng-if="editor.index == 2">
    <h4><?php echo _('Select Panel Type'); ?></h4>
    <form class="form-inline">
      <select class="input-medium" ng-model="panel.type" ng-options="panelType for panelType in dashboard.availablePanels|stringSort"></select>
      <small ng-show="rowSpan(row) > 11">
        <?php echo _('Note: This row is full, new panels will wrap to a new line. You should add another row.'); ?>
      </small>
    </form>

    <div ng-show="!(_.isUndefined(panel.type))">
      <div add-panel="{{panel.type}}"></div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button ng-show="editor.index == 1" ng-click="editor.index = 2;" class="btn btn-info" ng-disabled="panel.loadingEditor"><?php echo _('Add Panel'); ?></button>
  <button ng-show="panel.type && editor.index == 2" ng-click="editSave(row);add_panel(row,panel);reset_panel();editor.index = 0;dismiss();" class="btn btn-success" ng-disabled="panel.loadingEditor"><?php echo _('Save'); ?></button>
  <button ng-hide="panel.type && editor.index == 2" ng-click="editor.index=0;editSave(row);dismiss();reset_panel();close_edit()" class="btn btn-success"><?php echo _('Save'); ?></button>
  <button type="button" class="btn btn-default" ng-click="editor.index=0;dismiss();reset_panel();close_edit()"><?php echo _('Cancel'); ?></button>
</div>