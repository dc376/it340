<?php include_once('../setlang.inc.php'); ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3><?php echo _('Manage Queries'); ?></h3>
</div>
<div class="modal-body delete-modal-on-close manage-queries">
    <div class="queries hide" style="margin: 0;">
        <div class="queries-message"></div>
    </div>
    <div style="margin-bottom: 15px;">
        <div id="query_alert"></div>
        <div>
            <input type="text" style="margin: 0; width: 300px;" id="query_name" onkeydown="do_key_event(event);" placeholder="<?php echo _('Save current dashboard query as'); ?>...">
            <label id="show_everyone" style="display: inline-block; margin-right: 5px;" class="admin_only hide">
                <input type="checkbox" id="query_show_everyone" style="vertical-align: middle; margin: 0 0 0 5px;"> <?php echo _('Make global'); ?> <i class="fa fa-question-circle" bs-tooltip="'<?php echo _('Global queries can be seen and used by anyone. Only admins can overwrite/delete global queries.'); ?>'" data-placement="bottom"></i>
            </label>
            <button class="btn btn-primary" id="query-create-btn" ng-click="dashboard.create_nls_query();"><?php echo _('Create'); ?></button>
        </div>
    </div>
    <div class="queries-body" style="margin-top: 10px; border-top: 1px dotted #DDD; padding-top: 15px;">
        <div class="row-fluid">
            <div class="span6">
                <h4 style="margin: 0; line-height: 28px;"><?php echo _('Queries Available'); ?> <button class="btn btn-mini" onclick="show_import();"><i class="fa fa-upload"></i> <?php echo _('Import'); ?></button></h4>
            </div>
            <div class="span6" style="text-align: right;">
                <input style="width: 150px; margin: 0;" type="text" id="qsearch" placeholder="<?php echo _('Search'); ?>..." onkeypress="search(event);">
                <button class="btn btn-default" onclick="do_search();"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div id="import-box" class="hide" style="margin-top: 15px; border-top: 1px dotted #CCC; padding-top: 15px;">
            <?php echo _('Import File'); ?>
            <input id="import-file" type="file" name="file" style="line-height: 20px; height: 26px;" onchange="prepare_files(event);">
            <label style="display: inline-block; margin-right: 5px;" class="admin_only hide">
                <input id="import-global" style="margin: 0;" type="checkbox"> <?php echo _('Make global'); ?>
            </label>
            <button onclick="do_query_import();" class="btn btn-small"><?php echo _('Import Query'); ?></button>
        </div>
        <table class="table table-bordered table-striped table-condensed" style="margin: 10px 0 0 0;">
            <thead>
                <th><?php echo _('Name'); ?></th>
                <th><?php echo _('Created By'); ?></th>
                <th style="width: 60px; text-align: center;"><?php echo _('Actions'); ?></th>
            </thead>
            <tbody class="queries-list">
            </tbody>
        </table>
        <input id="load_query" type="hidden" value="" ng-click="dashboard.reload_nls_dash();">
        <input id="overwrite_query" type="hidden" value="" ng-click="dashboard.overwrite_nls_dash(this);">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" ng-click="dismiss();"><?php echo _('Close'); ?></button>
</div>

<script>
var files;

function get_queries_list(search) {
    html = '';
    var cachebuster = Date.now(); 
    $.get(site_url+"api/check/get_queries", { cb: cachebuster, search: search }, function(data) {
        if (data.length > 0) {
            $.each(data, function(k, v) {

                // Add actions
                var actions = '';
                actions += '<a title="<?php echo _('Export query to file'); ?>" href="'+site_url+'api/check/export_query?id='+v.id+'");"><i class="fa fa-download"></i></a> ';
                if (v.show_everyone == 1 && is_admin || v.show_everyone != 1) {
                    actions += '<a title="<?php echo _('Overwrite this query with your current dashboard query'); ?>" onclick="overwrite_query(\''+v.id+'\', \''+v.name+'\');"><i class="fa fa-floppy-o"></i></a> ';
                }
                if (v.show_everyone == 1 && is_admin || v.show_everyone != 1) {
                    actions += '<a onclick="remove_query(\''+v.id+'\');" title="<?php echo _('Delete query'); ?>"><i class="fa fa-trash-o"></i></a>';
                }

                var global = '';
                if (v.show_everyone) {
                    global = '<i class="fa fa-globe" title="<?php echo _('Can be used by anyone. Only admins can edit.'); ?>"></i> ';
                }

                // Complete
                html += '<tr><td class="name"><a title="<?php echo _('Load this query in current dashboard'); ?>" onclick="load_query(\''+v.id+'\');"><i class="fa fa-desktop"></i></a> '+global+v.name+'</td><td>'+v.created_by+'</td><td class="actions">'+actions+'</td></tr>';
            });
        } else {
            html = '<tr><td colspan="9"><?php echo _('No queries have been created'); ?>.</td></tr>';
        }
        $('.queries-list').html(html);
    }, 'json');
}

function overwrite_query(id, name) {
    if (confirm("<?php echo _('Are you sure you want to overwrite the query:'); ?>\n\n"+name+"\n\n<?php echo _('This will overwrite it with your current dashboard query'); ?>.\n<?php echo _('This action cannot be undone'); ?>.")) {
    	$('#overwrite_query').val(id);
    	$('#overwrite_query').trigger('click');
    }
}

function remove_query(id) {
    if (confirm("<?php echo _('Are you sure you want to delete this query?'); ?>")) {
        $.post(site_url+"api/check/delete_query", { id: id }, function(data) {
            get_queries_list();
        });
    }
}

function load_query(id) {
    $('#load_query').val(id);
    $('#load_query').trigger('click');
}

function search(e) {
    if (e.keyCode == 13) {
        do_search();
    }
}

function do_search() {
    $('#qsearch').focus();
    get_queries_list($('#qsearch').val());
}

function show_import() {
    if ($('#import-box').is(':visible')) {
        $('#import-box').hide();
    } else {
        $('#import-box').show();
        $('#import-file').trigger('click');
    }
}

function prepare_files(event) {
    files = event.target.files;
}

function do_query_import() {

    var reader = new FileReader();
    reader.onload = function(evt) {
        if (evt.target.readyState == FileReader.DONE) {
            var data = { global: 0 };
            if ($('#import-global').is(':checked')) {
                data.global = 1;
            }
            data.query = evt.target.result;
            $.post(site_url+"api/check/import_query", data, function(r) {
                get_queries_list();
            });
        }
    };
    reader.readAsText(files[0]);
    $('#import-box').hide();
}

function do_key_event(e) {
    if (e.keyCode == 13) {
        $('#query-create-btn').trigger('click');
    }
}
</script>