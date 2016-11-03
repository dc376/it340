<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">

    <title></title>
    <base href="<?php echo base_url(); ?>" />
    <link type="text/css" href="media/css/bootstrap-2.3.2.min.css?ver=<?php echo get_product_version(); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="media/css/kibana.css?ver=<?php echo get_product_version(); ?>" title="Light">

    <!-- load the root require context -->
    <script src="vendor/require/require.js?ver=<?php echo get_product_version(); ?>"></script>
    <script src="app/components/require.config.js?ver=<?php echo get_product_version(); ?>"></script>
    <script src="app/components/language.php?ver=<?php echo get_product_version(); ?>"></script>
    <script>require(['app'], function () {})</script>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css?ver=<?php echo get_product_version(); ?>">
    <link rel="stylesheet" href="css/font-awesome.min.css?ver=<?php echo get_product_version(); ?>">

    <style>
    .container-fluid, .container, .kibana-container, .container.kibana-container{margin: 0;padding: 0;}
    body{
    margin: 0;padding: 0;padding-right:0px;padding-left:0px
    }
    </style>
  </head>
  <body>
    <noscript>
      <div class="container">
        <center><h3><?php echo _("You must enable javascript to use Kibana"); ?></h3></center>
      </div>
    </noscript>
<div ng-controller='dashLoader' ng-init="init()" ng-include="'app/partials/dashlet.php'"></div><div ng-cloak ng-view></div>
  </body>
</html>