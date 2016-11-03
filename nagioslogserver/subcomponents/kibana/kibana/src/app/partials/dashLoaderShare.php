<?php include_once('../setlang.inc.php'); ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3>{{share.title}} <small><?php echo _('shareable link'); ?></small></h3>
</div>
<div class="modal-body">
  <label><?php echo _('Share this dashboard with this URL'); ?></label>
  <input ng-model='share.link' type="text" style="width:90%" onclick="this.select()" onfocus="this.select()" ng-change="share = dashboard.share_link(share.title,share.type,share.id)">
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success" ng-click="dismiss();$broadcast('render')"><?php echo _('Close'); ?></button>
</div>
