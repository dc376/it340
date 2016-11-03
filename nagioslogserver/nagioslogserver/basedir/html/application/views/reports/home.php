<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('reports'); ?>"><?php echo _('Reports'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo ucfirst($tab); ?></li>
</ul>

<div>
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
<script src="vendor/require/require.js?ver=<?php echo get_product_version(); ?>"></script>
<script src="app/components/require.config.js?ver=<?php echo get_product_version(); ?>"></script>
<script src="app/components/language.php?ver=<?php echo get_product_version(); ?>"></script>
<script type="text/javascript">
    require(['app'], function () {});
    var apikey = "<?php echo $user['apikey']; ?>";
</script>
<noscript>
	<div class="container">
		<center>
			<h3><?php echo _("You must enable javascript to use Log Server"); ?></h3>
		</center>
	</div>
</noscript>
<link rel="stylesheet" href="css/bootstrap-responsive.min.css?ver=<?php echo get_product_version(); ?>">
<link rel="stylesheet" href="css/font-awesome.min.css?ver=<?php echo get_product_version(); ?>">
<style>
div div.main{
	margin-left:-10px;
    padding-right: 0px;
}
.bgNav, .top-row-open{
	background: none repeat scroll 0 0 #ffffff;
}
div.row-open:hover{left:-30px}
</style>

<div ng-cloak="" class="navbar navbar-static-top">
	<div ng-controller="dashLoader" ng-init="init()" ng-include="'app/partials/dashLoader.php'"></div>
</div>

<div ng-cloak="" ng-repeat="alert in dashAlerts.list" class="alert-{{alert.severity}} dashboard-notice" ng-show="$last">
	<button type="button" class="close" ng-click="dashAlerts.clear(alert)" style="padding-right:50px">&times;</button> <strong>{{alert.title}}</strong> <span ng-bind-html="alert.text"></span>
	<div style="padding-right:10px" class="pull-right small">{{$index + 1}} <?php echo _("alert(s)"); ?></div>
</div>

<div ng-cloak="" ng-view=""></div>

</div>
        </div>
    </div>
</div>

<?php echo $footer; ?>
