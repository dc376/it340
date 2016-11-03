<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Index Status'); ?></li>
</ul>

<script>
var lastChecked = null;

$(document).ready(function() {

    add_checkbox_magic();

    $('#cb-toggle').click(function() {
        if ($(this).is(':checked')) {
            $('input[name="sel"]').prop('checked', true);
        } else {
            $('input[name="sel"]').prop('checked', false);
        }
    });

    $('#index-action').change(function() {
        var action = $(this).val();
        var indicies = [];
        $('input[name="sel"]:checked').each(function(k, v) { indicies.push($(v).val()); });

        switch (action) {

            case 'open':
                var conf = confirm("<?php echo _('Are you sure you want to open all the selected indexes?'); ?>");
                if (conf == true) {
                    $.each(indicies, function(k, v) {
                        open_index(v);
                    });
                }
                break;

            case 'close':
                var conf = confirm("<?php echo _('Are you sure you want to close all the selected indexes?'); ?>");
                if (conf == true) {
                    $.each(indicies, function(k, v) {
                        close_index(v);
                    });
                }
                break;

            case 'delete':
                var conf = confirm("<?php echo _('Are you sure you want to delete all the selected indexes?'); ?>");
                if (conf == true) {
                    $.each(indicies, function(k, v) {
                        delete_index(v);
                    });
                }
                break;

        }

        window.location.href = window.location.href;
    });

});

function close_index(index) {
    $.ajax({
        url: site_url + 'api/backend/' + index + '/_close',
        type: 'POST',
        async: false,
        success: function(data) {
            if (data.success == 0) {
                alert(data.errormsg);
            }
        }
    });
}

function open_index(index) {
    $.ajax({
        url: site_url + 'api/backend/' + index + '/_open',
        type: 'POST',
        async: false,
        success: function(data) {
            if (data.success == 0) {
                alert(data.errormsg);
            }
        }
    });
}

function delete_index(index) {
    $.ajax({
        url: site_url + 'api/backend/' + index + '/',
        type: 'DELETE',
        async: false,
        success: function(data) {
            if (data.success == 0) {
                alert(data.errormsg);
            }
        }
    });
}

function add_checkbox_magic() {
    var $chkboxes = $('input[name="sel"]');
    $chkboxes.click(function(e) {
        if (!lastChecked) {
            lastChecked = this;
            return;
        }
        if (e.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);
            $chkboxes.slice(Math.min(start,end), Math.max(start,end)+ 1).prop('checked', lastChecked.checked);
        }
        lastChecked = this;
    });
}
</script>


<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <div id="workspace">
                <div class="well">
                    <div class="span2 pull-left"></div>
                    <div class="text-center span8"><span style="font-size: 28px;"><?php echo ($index['stats']['count'] != 1 ) ? _("Index Overview") : _("Index - ") . "<strong>" . key($index['stats']['indices']) . "</strong>"; ?></span></div>
                    <div class="pull-right">
                    
                    </div>
                </div>
                <div class="row-fluid">
                    <div style="margin-top: 0; margin-bottom: 15px;" class="grid">
                        <div class="grid-title">
                            <div class="pull-left">
                                <div class="table-title"><i class="fa fa-bar-chart"></i></div>
                                <span><?php echo _("Index Statistics"); ?></span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="grid-content overflow">
                            <div class="row-fluid center-table">
                                <div class="span2">
                                    <div class="well stat-box"><span class="stat-detail"><?php echo number_format($index['stats']['_all']['primaries']['docs']['count']); ?></span><span><?php echo _("Documents"); ?></span></div>
                                </div>
                                <div class="span2">
                                    <div class="well stat-box"><span class="stat-detail"><?php echo $index['stats']['_shards']['total']; ?></span><span><?php echo _("Total Shards"); ?></span></div>
                                </div>
                                <div class="span2">
                                    <div class="well stat-box"><span class="stat-detail"><?php echo $index['stats']['_shards']['successful']; ?></span><span><?php echo _("Successful Shards"); ?></span></div>
                                </div>
                                <div class="span2">
                                    <div class="well stat-box"><span class="stat-detail"><?php echo $index['stats']['count']; ?></span><span><?php echo _("Indices"); ?></span></div>
                                </div>
                                <div class="span2">
                                    <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($index['stats']['_all']['primaries']['store']['size']); ?></span><span><?php echo _("Primary Size"); ?></span></div>
                                </div>
                                <div class="span2">
                                    <div class="well stat-box"><span class="stat-detail"><?php echo strtoupper($index['stats']['_all']['total']['store']['size']); ?></span><span><?php echo _("Total Size"); ?></span></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <?php if ($index['stats']['count'] != 1): ?>
                        <div style="margin-top: 0;" class="grid">
                            <div class="grid-title">
                                <div class="pull-left">
                                    <div class="table-title"><i class="fa fa-database"></i></div>
                                    <span><?php echo _("Indices"); ?></span>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="grid-content overflow">
                                <table id="indicesTable" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 18px; text-align: center;"><input type="checkbox" id="cb-toggle"></th>
                                            <th><?php echo _("Index"); ?></th>
                                            <th style="text-align:right"># <?php echo _("Docs"); ?></th>
                                            <th style="text-align:right"><?php echo _("Primary Size"); ?></th>
                                            <th style="text-align:right"># <?php echo _("Shards"); ?></th>
                                            <th style="text-align:right"># <?php echo _("Replicas"); ?></th>
                                            <th><?php echo _("Action"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($index['stats']['indices'] as $index_id => $indices): ?>
                                        <tr>
                                            <td style="text-align: center;"><input type="checkbox" name="sel" value="<?php echo $index_id; ?>"></td>
                                            <td>
                                                <?php if ($indices['state'] == "open"): ?>
                                                <a data-title="Index Information" data-placement="bottom" rel="tipRight" href="<?php echo site_url('admin/index_status/'.$index_id); ?>" data-original-title="" title=""><?php echo $index_id; ?></a>
                                                <?php else: ?>
                                                    <?php echo $index_id; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td style="text-align:right"><?php echo number_format($indices['primaries']['docs']['count']); ?></td>
                                            <td style="text-align:right"><?php echo strtoupper($indices['primaries']['store']['size']); ?></td>
                                            <td style="text-align:right"><?php echo $indices['settings']['index']['number_of_shards']; ?></td>
                                            <td style="text-align:right"><?php echo $indices['settings']['index']['number_of_replicas']; ?></td>
                                            <td style="width: 120px; text-align: center;">
                                                <?php if ($indices['state'] == 'close'): ?>
                                                    <button id="<?php echo $index_id; ?>" class="btn btn-mini open-index" type="button"><i class="fa fa-history"></i> <?php echo _("open"); ?></button>
                                                <?php else: ?>
                                                    <button id="<?php echo $index_id; ?>" class="btn btn-mini close-index" type="button"><i class="fa fa-stop"></i> <?php echo _("close"); ?></button>
                                                <?php endif; ?>
                                                <button class="btn btn-mini delete-index" type="button"><input type="hidden" value="<?php echo $index_id; ?>"/><i class="fa fa-times-circle"></i> <?php echo _("delete"); ?></button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div style="margin-top: 10px;">
                                    <?php echo _('With selected indices'); ?>: 
                                    <select id="index-action" style="width: 100px; margin: 0;">
                                        <option></option>
                                        <option value="open"><?php echo _('Open'); ?></option>
                                        <option value="close"><?php echo _('Close'); ?></option>
                                        <option value="delete"><?php echo _('Delete'); ?></option>
                                    </select>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    
                    <?php else: ?>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="grid" style="margin-top: 0;">
                                <div class="pad">
                                    <table class="table table-bordered table-striped grid-table">
                                        <thead>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="grid-table-title">
                                                        <div class="pull-left">
                                                            <div class="table-title"><i class="fa fa-search"></i></div>
                                                            <span class="text-left"><?php echo _("Search Totals"); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="span3"><?php echo _("Query Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['search']['query_total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Query Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['search']['query_time']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Fetch Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['search']['fetch_total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Fetch Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['search']['fetch_time']; ?></td>
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
                                                            <div class="table-title"><i class="fa fa-file"></i></div>
                                                            <span class="text-left"><?php echo _("Get Totals"); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="span3"><?php echo _("Get Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['get']['total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Get Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['get']['get_time']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Exists Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['get']['exists_total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Exists Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['get']['exists_time']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Missing Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['get']['missing_total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Missing Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['get']['missing_time']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="grid" style="margin-top: 0;">
                                <div class="pad">
                                    <table class="table table-bordered table-striped grid-table">
                                        <thead>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="grid-table-title">
                                                        <div class="pull-left">
                                                            <div class="table-title"><i class="fa fa-file"></i></div>
                                                            <span class="text-left"><?php echo _("Documents"); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="span3"><?php echo _("Primary Documents"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['primaries']['docs']['count']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="span3"><?php echo _("Total Documents"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['docs']['count']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Deleted Documents"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['docs']['deleted']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Primary Size"); ?>:</td>
                                                <td><?php echo strtoupper($index['stats']['_all']['primaries']['store']['size']); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Total Size"); ?>:</td>
                                                <td><?php echo strtoupper($index['stats']['_all']['total']['store']['size']); ?></td>
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
                                                            <div class="table-title"><i class="fa fa-list"></i></div>
                                                            <span class="text-left"><?php echo _("Indexing Totals"); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="span3"><?php echo _("Index Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['indexing']['index_total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="span3"><?php echo _("Index Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['indexing']['index_time']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Delete Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['indexing']['delete_total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Delete Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['indexing']['delete_time']; ?></td>
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
                                                            <div class="table-title"><i class="fa fa-cog"></i></div>
                                                            <span class="text-left"><?php echo _("Operations"); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="span3"><?php echo _("Refresh Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['refresh']['total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="span3"><?php echo _("Refresh Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['refresh']['total_time']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Flush Total"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['flush']['total']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo _("Flush Time"); ?>:</td>
                                                <td><?php echo $index['stats']['_all']['total']['flush']['total_time']; ?></td>
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