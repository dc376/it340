<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _("Administration"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _("Configuration Editor"); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _("Configuration Editor"); ?></h2>
                <p><?php echo _("The configuration editor is used to write configurations for logstash running on each of the Log Server instances."); ?></p>
                <p><?php echo _("As well as editing each local logstash configuration file here, you can also add <strong>global config options</strong> which will be applied to all configuration files on every Log Server instance in the cluster."); ?></p>
                <?php if (!empty($ports)) { ?>
                <div class="alert alert-info">
                    <?php echo _("<strong>Logstash</strong> is currently collecting locally on"); ?>: <strong style="margin-left: 5px;"><?php echo $_SERVER['SERVER_ADDR'] ?></strong> <?php foreach ($ports as $type => $p) { echo '<span style="margin: 0 5px;"><strong>'.$type.": ".implode(', ', $p)."</strong></span>"; } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>