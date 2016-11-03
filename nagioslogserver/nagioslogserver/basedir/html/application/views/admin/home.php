<?php echo $header; ?>

<ul class="breadcrumb">
    <li class="active"><?php echo _('Administration'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _("Admin Overview"); ?></h2>

                <?php if (!$maintenance_active) { ?>
                <div class="alert alert-warn" style="margin-bottom: 15px;">
                <?php echo _("It looks like log backups are currently <strong>turned off</strong>. For increased redundancy we recommend configuring log backups."); ?> <a href="<?php echo site_url('admin/backup'); ?>"><?php echo _("Configure your log backup settings."); ?></a>
                </div>
                <?php } ?>

                <?php if (!empty($ports)) { ?>
                <div class="alert alert-info" style="margin-bottom: 15px;">
                    <?php echo _("<strong>Logstash</strong> is currently collecting locally on"); ?>: <strong style="margin-left: 5px;"><?php echo $_SERVER['SERVER_ADDR'] ?></strong> <?php foreach ($ports as $type => $p) { echo '<span style="margin: 0 5px;"><strong>'.$type.": ".implode(', ', $p)."</strong></span>"; } ?>
                </div>
                <?php } ?>

                <div class="admin-dash">
                    <div class="row-fluid">
                        <div style="margin-top: 0;" class="grid">
                            <div class="grid-title">
                                <div class="pull-left">
                                    <div class="table-title"><i class="fa fa-bar-chart"></i></div>
                                    <span><?php echo _("Cluster Statistics"); ?></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="grid-content overflow">
                                <div class="row-fluid center-table">
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo number_format($cluster['stats']['indices']['docs']['count']); ?></span><span><?php echo _("Documents"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($index['stats']['_all']['primaries']['store']['size']); ?></span><span><?php echo _("Primary Size"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($index['stats']['_all']['total']['store']['size']); ?></span><span><?php echo _("Total Size"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $cluster['health']['number_of_data_nodes']; ?></span><span><?php echo _("Data Instances"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $index['stats']['_shards']['total']; ?></span><span><?php echo _("Total Shards"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $cluster['stats']['indices']['count']; ?></span><span><?php echo _("Indices"); ?></span></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-dash">
                    <div class="row-fluid" style="width: 20%; min-height: 200px;">
                        <div style="margin-top: 15px;" class="grid">
                            <div class="grid-title">
                                <div class="pull-left">
                                    <div class="table-title"><i class="fa fa-bar-chart"></i></div>
                                    <span><?php echo _("Versions"); ?></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="grid-content overflow">
                                <table>
                                    <tr>
                                        <td style="text-align: right; padding: 0 10px 0 20px; font-weight: bold;"><?php echo _('Nagios Log Server'); ?></td>
                                        <td><?php echo get_product_version(); ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; padding: 0 10px 0 20px; font-weight: bold;"><?php echo _('Elasticsearch'); ?></td>
                                        <td>1.6.0</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; padding: 0 10px 0 20px; font-weight: bold;"><?php echo _('Logstash'); ?></td>
                                        <td>1.5.1</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; padding: 0 10px 0 20px; font-weight: bold;"><?php echo _('Kibana'); ?></td>
                                        <td>3.1.1-nagios3</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>