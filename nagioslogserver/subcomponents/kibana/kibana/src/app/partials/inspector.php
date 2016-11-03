<?php include_once('../setlang.inc.php'); ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3><?php echo _('Last Elasticsearch Query'); ?></h3>
</div>
<div class="modal-body">

  <div>
    <pre>curl -XGET '{{config.elasticsearch}}/{{dashboard.indices|stringify}}/_search?pretty&token={{apikey}}' -d '{{inspector}}'
    </pre>
  </div>
  
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-success" ng-click="dismiss()"><?php echo _('Close'); ?></button>
</div>