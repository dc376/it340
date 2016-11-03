<?php include_once('../../setlang.inc.php'); ?>

<div>
  <div class="row-fluid">
    <div class="span4">
      <label class="small"><?php echo _('Mode'); ?></label> <select class="input-medium" ng-model="panel.mode" ng-options="f for f in ['html','markdown','text']"></select>
    </div>
    <div class="span2" ng-show="panel.mode == 'text'">
      <label class="small"><?php echo _('Font Size'); ?></label> <select class="input-mini" ng-model="panel.style['font-size']" ng-options="f for f in ['6pt','7pt','8pt','10pt','12pt','14pt','16pt','18pt','20pt','24pt','28pt','32pt','36pt','42pt','48pt','52pt','60pt','72pt']"></select>
    </div>
  </div>

  <label class=small><?php echo _('Content'); ?> 
    <span ng-show="panel.mode == 'html'">(<?php echo _('This area uses HTML sanitized via AngularJS'); ?>'s <a href='http://docs.angularjs.org/api/ngSanitize.$sanitize'>$sanitize</a> <?php echo _('service'); ?>)</span>
    <span ng-show="panel.mode == 'markdown'">(<?php echo _('This area uses'); ?> <a target="_blank" href="http://en.wikipedia.org/wiki/Markdown"><?php echo _('Markdown'); ?></a>. <?php echo _('HTML is not supported'); ?>)</span>
  </label>
  <textarea ng-model="panel.content" rows="6" style="width:95%"></textarea>
</div>