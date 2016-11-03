<?php include_once('../setlang.inc.php'); ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3>{{modal.title}}</h3>
</div>
<div class="modal-body">

  <div ng-bind-html='modal.body'></div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" ng-click="dismiss()"><?php echo _('Close'); ?></button>
</div>