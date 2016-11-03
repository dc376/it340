<?php echo $header; ?>
<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Instance Status'); ?></li>
</ul>
<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <div id="workspace">
                    <div class="well">
                        <div class="row-fluid">
                            <div class="text-center span12">
                                <span style="font-size: 28px; vertical-align: middle;"><?php echo ($nodes['stats']['count'] != 1 ) ? _("Instance Overview") : _("Instance Status - ") ?> </span>
                                <?php if ($nodes['stats']['count'] == 1 ): ?>
                                <span><input type="text" class="text-center select-all" name="node_id" style="padding: 8px 12px; margin: 0; width: 400px; font-size: 20px;" value="<?php echo $nodes['stats']['nodes'][key($nodes['stats']['nodes'])]['name']; ?>" class="input-xlarge" readonly></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if ($nodes['stats']['count'] != 1 ): ?>
                    <div class="row-fluid">
                        <div style="margin-top: 0;" class="grid">
                            <div class="grid-title">
                                <div class="pull-left">
                                    <div class="table-title"><i class="fa fa-bar-chart"></i></div>
                                    <span><?php echo _("Global Stats"); ?></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="grid-content overflow">
                                <div class="row-fluid center-table">
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $nodes['stats']['global']['nodes']['count']['total'] ; ?></span><span><?php echo _("Total Instances"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $nodes['stats']['global']['nodes']['count']['client']; ?></span><span><?php echo _("Client"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $nodes['stats']['global']['nodes']['count']['master_data']; ?></span><span><?php echo _("Master/Data"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $nodes['stats']['global']['nodes']['os']['available_processors']; ?></span><span><?php echo _("Processors"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo $nodes['stats']['global']['nodes']['process']['cpu']['percent']; ?>%</span><span><?php echo _("Process CPU"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['global']['nodes']['os']['mem']['total']); ?></span><span><?php echo _("Memory Used"); ?></span></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="grid-content overflow">
                                <div class="row-fluid center-table">
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['global']['nodes']['os']['swap']['used']); ?></span><span><?php echo _("Swap"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['global']['nodes']['fs']['total']); ?></span><span><?php echo _("Total Storage"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['global']['nodes']['fs']['free']); ?></span><span><?php echo _("Free Storage"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['global']['nodes']['fs']['disk_read_size']); ?></span><span><?php echo _("Data Read"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['global']['nodes']['fs']['disk_write_size']); ?></span><span><?php echo _("Data Written"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['global']['nodes']['fs']['disk_io_size']); ?></span><span><?php echo _("I/O Size"); ?></span></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row-fluid">
                        <div style="margin-top: 0;" class="grid">
                            <div class="grid-title">
                                <div class="pull-left">
                                    <div class="table-title"><i class="fa fa-bar-chart"></i></div>
                                    <span><?php echo _("Instance Stats"); ?></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="grid-content overflow">
                                <div class="row-fluid center-table">
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['os']['swap']['used_in_bytes']); ?></span><span><?php echo _("Swap"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($nodes['stats']['nodes'][$nodeid]['fs']['total']['total']); ?></span><span><?php echo _("Total Storage"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($nodes['stats']['nodes'][$nodeid]['fs']['total']['free']); ?></span><span><?php echo _("Free Storage"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($nodes['stats']['nodes'][$nodeid]['fs']['total']['disk_read_size']); ?></span><span><?php echo _("Data Read"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($nodes['stats']['nodes'][$nodeid]['fs']['total']['disk_write_size']); ?></span><span><?php echo _("Data Written"); ?></span></div>
                                    </div>
                                    <div class="span2">
                                        <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($nodes['stats']['nodes'][$nodeid]['fs']['total']['disk_io_size']); ?></span><span><?php echo _("I/O Size"); ?></span></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row-fluid">
                        <div class="span12">
                            <?php if (count($all_nodes) != 1): ?>
                            <div class="grid" style="margin-top: 15px;">
                                <div class="grid-title">
                                    <div class="pull-left">
                                        <div class="table-title"><i class="fa fa-building-o"></i></div>
                                        <span><?php echo _("Instances"); ?></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="grid-content overflow">
                                    <table id="indicesTable" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo _("IP"); ?></th>
                                                <th><?php echo _("Hostname"); ?></th>
                                                <th><?php echo _("Port"); ?></th>
                                                <th><?php echo _("1m, 5m, 15m Load"); ?></th>
                                                <th><?php echo _("CPU") . " %"; ?></th>
                                                <th><?php echo _("Memory Used"); ?></th>
                                                <th><?php echo _("Memory Free"); ?></th>
                                                <th><?php echo _("Storage Total"); ?></th>
                                                <th><?php echo _("Storage Available"); ?></th>
                                                <th style="text-align: center; width: 100px;"><?php echo _("Elasticsearch"); ?></th>
                                                <th style="text-align: center; width: 80px;"><?php echo _("Logstash"); ?></th>
                                                <th style="text-align: center; width: 60px;"><?php echo _("Actions"); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($all_nodes as $node_id => $node): ?>
                                            <tr>
                                                <td>
                                                    <a data-title="Index Information" data-placement="bottom" rel="tipRight" href="<?php echo site_url('admin/instance_status/'.$node['name']); ?>" data-original-title="" title=""><?php if (!empty($node['ip'])) { echo $node['ip']; } else { echo $node['address']; } ?></a>
                                                </td>
                                                <td><?php if (!empty($node['host'])) { echo $node['host']; } else { if ($node['hostname'] != $node['address']) { echo $node['hostname']; } } ?></td>
                                                <td><?php echo $node['port']; ?></td>
                                                <td><?php if (!empty($node['os']['load_average'])) { echo number_format ($node['os']['load_average'][0], 2).', '.number_format ($node['os']['load_average'][1], 2).', '.number_format ($node['os']['load_average'][2], 2); } ?></td>
                                                <td><?php if (!empty($node['os']['cpu'])) { echo (int) $node['os']['cpu']['usage']; echo '%'; } ?></td>
                                                <td><?php if (!empty($node['os']['mem'])) { echo strtoupper($node['os']['mem']['used_percent']); echo '%'; } ?></td>
                                                <td><?php if (!empty($node['os']['mem'])) { echo strtoupper($node['os']['mem']['free_percent']); echo '%'; } ?></td>
                                                <td><?php echo strtoupper($node['fs']['total']['total']); ?></td>
                                                <td><?php echo strtoupper($node['fs']['total']['available']); ?></td>
                                                <td style="text-align: center;"><?php if ($node['elasticsearch']['status'] == 'running' && (!empty($node['name']) || !($node['last_updated'] < time()-300))) { echo '<img title="'._("Elasticsearch is running...").'" src="'.base_url('media/icons/accept.png').'">'; } else { echo '<img title="'._("Elasticsearch is not running...").'" src="'.base_url('media/icons/exclamation.png').'">'; } ?></td>
                                                <td style="text-align: center;"><?php if ($node['logstash']['status'] == 'running' && (!empty($node['name']) || !($node['last_updated'] < time()-300))) { echo '<img title="'._("Logstash is running...").'" src="'.base_url('media/icons/accept.png').'">'; } else { echo '<img title="'._("Logstash is not running...").'" src="'.base_url('media/icons/exclamation.png').'">'; } ?></td>
                                                <td class="actions">
                                                    <?php if (empty($node['os'])) { ?>
                                                    <a href="<?php echo site_url('configure/remove_instance/'.$node['id'].'/'.base64_encode('admin/instance_status')); ?>" title="<?php echo _("Remove instance form database"); ?>"><i class="fa fa-trash-o"></i></a>
                                                    <?php } else { echo '-'; } ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; // ($nodes['stats']['nodes'] as $node_id => $node) ?>
                                        </tbody>
                                    </table>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="grid" style="margin-top: 15px;">
                                        <div class="pad">
                                            <table class="table table-bordered table-striped grid-table">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="grid-table-title">
                                                                <div class="pull-left">
                                                                    <div class="table-title"><i class="fa fa-info-circle"></i></div>
                                                                    <span class="text-left"><?php echo _("Instance Information"); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo _("IP"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['ip']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Hostname"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['host']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("1m, 5m, 15m Load"); ?>:</td>
                                                        <td><?php echo number_format ($nodes['stats']['nodes'][$nodeid]['os']['load_average'][0], 2).', '.number_format ($nodes['stats']['nodes'][$nodeid]['os']['load_average'][1], 2).', '.number_format ($nodes['stats']['nodes'][$nodeid]['os']['load_average'][2], 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Memory (Used/Free)"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['os']['mem']['used_in_bytes']); ?> / <?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['os']['mem']['free_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Swap (Used/Free)"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['os']['swap']['used_in_bytes']); ?> / <?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['os']['swap']['free_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Total Memory"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['os']['mem']['free_in_bytes'] + $nodes['stats']['nodes'][$nodeid]['os']['mem']['used_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Total Swap"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['os']['swap']['free_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU User/Sys"); ?>:</td>
                                                        <td><?php echo (int) $nodes['stats']['nodes'][$nodeid]['os']['cpu']['user']; ?>% / <?php echo (int) $nodes['stats']['nodes'][$nodeid]['os']['cpu']['sys']; ?>%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU Idle"); ?>:</td>
                                                        <td><?php echo (int) $nodes['stats']['nodes'][$nodeid]['os']['cpu']['idle']; ?>%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU Vendor"); ?>:</td>
                                                        <td><?php echo $nodes['info']['nodes'][$nodeid]['os']['cpu']['vendor']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU Model"); ?>:</td>
                                                        <td><?php echo $nodes['info']['nodes'][$nodeid]['os']['cpu']['model']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Total Cores"); ?>:</td>
                                                        <td><?php echo $nodes['info']['nodes'][$nodeid]['os']['cpu']['total_cores']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="grid" style="margin-top: 15px;">
                                        <div class="pad">
                                            <table class="table table-bordered table-striped grid-table">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="grid-table-title">
                                                                <div class="pull-left">
                                                                    <div class="table-title"><i class="fa fa-database"></i></div>
                                                                    <span class="text-left"><?php echo _("Indices"); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo _("Documents"); ?>:</td>
                                                        <td><?php echo number_format($nodes['stats']['nodes'][$nodeid]['indices']['docs']['count']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Documents Deleted"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['docs']['deleted']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Store Size"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['indices']['store']['size_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Index Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['indexing']['index_total']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Delete Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['indexing']['delete_total']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Get Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['get']['total']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Get(Exists) Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['get']['exists_total']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Get(Missing) Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['get']['missing_total']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Query Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['search']['query_total']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Fetch Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['indices']['search']['fetch_total']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="grid" style="margin-top: 15px;">
                                        <div class="pad">
                                            <table class="table table-bordered table-striped grid-table">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="grid-table-title">
                                                                <div class="pull-left">
                                                                    <div class="table-title"><i class="fa fa-cog"></i></div>
                                                                    <span class="text-left"><?php echo _("Process"); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo _("Open File Descriptors"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['process']['open_file_descriptors']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU Usage"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['process']['cpu']['percent']; ?>% <?php echo _("of"); ?> <?php echo $nodes['info']['nodes'][$nodeid]['os']['available_processors'] * 100; ?>%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU System"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['process']['cpu']['sys']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU User"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['process']['cpu']['user']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("CPU Total"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['process']['cpu']['total']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Resident Memory"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['process']['mem']['resident_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Shared Memory"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['process']['mem']['share_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Total Virtual Memory"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['process']['mem']['total_virtual_in_bytes']); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="grid" style="margin-top: 15px;">
                                        <div class="pad">
                                            <table class="table table-bordered table-striped grid-table">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="grid-table-title">
                                                                <div class="pull-left">
                                                                    <div class="table-title"><i class="fa fa-coffee"></i></div>
                                                                    <span class="text-left"><?php echo _("JVM"); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo _("Heap Used"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['jvm']['mem']['heap_used_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Heap Committed"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['jvm']['mem']['heap_committed_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Non Heap Used"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['jvm']['mem']['non_heap_used_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Non Heap Committed"); ?>:</td>
                                                        <td><?php echo humanize_filesize($nodes['stats']['nodes'][$nodeid]['jvm']['mem']['non_heap_committed_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("JVM Uptime"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['jvm']['uptime']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Thread Count/Peak"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['jvm']['threads']['count']; ?> / <?php echo $nodes['stats']['nodes'][$nodeid]['jvm']['threads']['peak_count']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("GC (Old) Count"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['jvm']['gc']['collectors']['old']['collection_count']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("GC (Old)Time"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['jvm']['gc']['collectors']['old']['collection_time']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("GC (Young) Count"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['jvm']['gc']['collectors']['young']['collection_count']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("GC (Young)Time"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['jvm']['gc']['collectors']['young']['collection_time']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Java Version"); ?>:</td>
                                                        <td><?php echo $nodes['info']['nodes'][$nodeid]['jvm']['version']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("JVM Vendor"); ?>:</td>
                                                        <td><?php echo $nodes['info']['nodes'][$nodeid]['jvm']['vm_vendor']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("JVM"); ?>:</td>
                                                        <td><?php echo $nodes['info']['nodes'][$nodeid]['jvm']['vm_name']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="span5">
                                    <?php foreach($nodes['stats']['nodes'][$nodeid]['fs']['data'] as $data): ?>
                                    <div class="grid" style="margin-top: 15px;">
                                        <div class="pad">
                                            <table class="table table-bordered table-striped grid-table">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="grid-table-title">
                                                                <div class="pull-left">
                                                                    <div class="table-title"><i class="fa fa-file"></i></div>
                                                                    <span class="text-left"><?php echo _("File System"); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo _("Path"); ?>:</td>
                                                        <td><?php echo $data['path']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Mount"); ?>:</td>
                                                        <td><?php echo $data['mount']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Device"); ?>:</td>
                                                        <td><?php echo $data['dev']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Total Space"); ?>:</td>
                                                        <td><?php echo humanize_filesize($data['total_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Free Space"); ?>:</td>
                                                        <td><?php echo humanize_filesize($data['free_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Disk Reads"); ?>:</td>
                                                        <td><?php echo $data['disk_reads']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Disk Writes"); ?>:</td>
                                                        <td><?php echo $data['disk_writes']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Read Size"); ?>:</td>
                                                        <td><?php echo humanize_filesize($data['disk_read_size_in_bytes']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Write Size"); ?>:</td>
                                                        <td><?php echo humanize_filesize($data['disk_write_size_in_bytes']); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="grid" style="margin-top: 15px;">
                                        <div class="pad">
                                            <table class="table table-bordered table-striped grid-table">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="grid-table-title">
                                                                <div class="pull-left">
                                                                    <div class="table-title"><i class="fa fa-list"></i></div>
                                                                    <span class="text-left"><?php echo _("Thread Pools"); ?></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo _("Index (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['index']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['index']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['index']['active']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Get (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['get']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['get']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['get']['active']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Search (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['search']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['search']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['search']['active']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Bulk (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['bulk']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['bulk']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['bulk']['active']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Refresh (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['refresh']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['refresh']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['refresh']['active']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Flush (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['flush']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['flush']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['flush']['active']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Merge (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['merge']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['merge']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['merge']['active']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo _("Management (Queue/Peak/Active)"); ?>:</td>
                                                        <td><?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['management']['queue']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['management']['largest']; ?>/<?php echo $nodes['stats']['nodes'][$nodeid]['thread_pool']['management']['active']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>