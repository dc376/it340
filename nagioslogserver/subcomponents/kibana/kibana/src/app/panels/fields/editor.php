<?php include_once('../../setlang.inc.php'); ?>

  <div class="row-fluid">    
    <div class="span3"><h6><?php echo _('Popup Position'); ?></h6> 
      <select class="input-small" ng-model="panel.micropanel_position" ng-options="f for f in ['top','right','bottom','left']" ng-change="reload_list();"></select></span>
    </div>
    <div class="span3"><h6><?php echo _('List Arrangement'); ?></h6> 
      <select class="input-small" ng-model="panel.arrange" ng-options="f for f in ['horizontal','vertical']"></select></span>
    </div>
    <div class="span3"><h6><?php echo _('Font Size'); ?></h6> 
      <select class="input-small" ng-model="panel.style['font-size']" ng-options="f for f in ['6pt','7pt','8pt','9pt','10pt','12pt','14pt','16pt','18pt','20pt','24pt','28pt','32pt','36pt','42pt','48pt','52pt','60pt','72pt']"></select></span>
  </div>
