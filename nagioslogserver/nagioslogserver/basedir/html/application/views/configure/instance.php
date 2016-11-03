<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _("Administration"); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('configure'); ?>"><?php echo _("Configuration Editor"); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Global Configuration'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">

                <?php if ($node['_id'] == 'global') { ?>
                <h2><?php echo _("Global Configuration"); ?> <span id="not-saved" class="hide label label-important ls-tooltip" style="vertical-align: middle; margin-left: 10px;" title="<?php echo _('The changes to the config files have not been saved or applied.'); ?>"><?php echo _("Changes Not Saved"); ?></span></h2>
                <p style="margin-bottom: 15px;"><?php echo _("Manage logstash config options that will be added to all instances. Note that all applied global filters will happen before the local filters. Keep in mind the flow of the log data through the filters when creating global filters."); ?> <a href="https://www.elastic.co/guide/en/logstash/current/index.html" target="_blank"><?php echo _("View Logstash config language documentation"); ?> <i class="fa fa-external-link"></i></a></p>
                <?php } else { ?>
                <h2><?php echo _("Instance Configuration"); ?> - <?php echo $node['_source']['address']; if ($node['_source']['hostname'] != $node['_source']['address']) { echo " (".$node['_source']['hostname'].")"; } ?></h2>
                <div class="alert alert-info" style="margin-bottom: 15px;">
                    <?php echo '<strong>' . _("Advanced users only!") . '</strong> ' . _("Making changes here applies to this instance only and changes will be applied to Logstash when the apply configuration is run."); ?>
                </div>
                <?php } ?>

                <?php if ($msg) { ?>
                <div class="alert alert-<?php echo $msg_type; ?>" style="margin-bottom: 15px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $msg; ?>
                </div>
                <?php } ?>

                <?php
                if ($node['_source']['last_updated'] < time()-300 && $node['_id'] != 'global') {
                    // If the instance hasn't been updated in more than 5 minutes show an error page
                    ?>
                <div class="alert alert-error alert-offline" style="margin-bottom: 15px;">
                    <div><?php echo _("It looks like this instance hasn't checked in the last 5 minutes."); ?></div>
                    <div style="font-weight: bold;"><?php echo _("Normally this means it is not online or elasticsearch is not running."); ?></div>
                    <div style="margin: 10px 0;"><button id="prim" class="btn btn-default btn-m"><?php echo _("I've taken this instance offline permanently"); ?></button></div>
                    <div style="margin: 10px 0;"><button id="dk" class="btn btn-default btn-m"><?php echo _("I don't know why it's not online"); ?></button></div>
                    <div id="permanent" class="hide">
                        <div style="margin-top: 10px;"><?php echo _("If you have taken this instance offline permanently"); ?>:</div>
                        <div style="margin: 10px 0;">
                            <a href="<?php echo site_url("configure/remove_instance/".$node['_id']); ?>" class="btn btn-default"><?php echo _("Remove Instance from Database"); ?></a>
                        </div>
                    </div>
                    <div id="dont-know" class="hide">
                        <div style="margin-top: 10px;"><?php echo _("If you don't know why it's offline, try these"); ?>:</div>
                        <ul style="margin: 10px 30px;">
                            <li><?php echo _("Verify that elasticsearch is running on the instance and start elasticsearch if necessary"); ?></li>
                            <li><?php echo _("Check the connection (firewall, cable link) to the instance from this instance"); ?></li>
                            <li><?php echo _("Wait for the instance to return to an online state and check in"); ?></li>
                        </ul>
                    </div>
                </div>
                <?php
                } else {
                ?>

                <?php if ($node['_source']['logstash']['status'] == 'stopped') { ?>
                <div class="alert alert-danger" style="margin-bottom: 15px;">
                    <?php echo _("The instance reports that it's local"); ?> <strong><?php echo _("Logstash"); ?></strong> <?php echo _("is not running. You will not be able to collect logs on this instance until you start Logstash."); ?>
                </div>
                <?php } ?>

                <?php echo form_open('configure/save/'.$node['_id']); ?>
                <div class="row-fluid" style="padding-bottom: 20px;">
                    <div class="span6">
                        <input id="apply-after" type="hidden" value="0" name="apply_after">
                        <button disabled type="submit" class="save-btn btn"><?php echo _("Save"); ?></button>
                        <button disabled type="button" id="save-and-apply" class="btn btn-default ls-tooltip" title="<?php echo _("Save configuration and apply to ALL available instances. This will cause logstash to restart on all instances."); ?>"><i class="fa fa-external-link"></i> <?php echo _("Save &amp; Apply"); ?></button>
                        <button type="button" id="verify" class="btn btn-default ls-tooltip" title="<?php echo _("Verify the syntax of this portion")." (".$node_name.") "._("of the config file."); ?>"><i class="fa fa-check-square-o"></i> <?php echo _("Verify"); ?></button>
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-file"></i><?php echo _("View"); ?> <span style="margin-left: 4px;" class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="view-file" data-type="input"><?php echo _("Inputs File"); ?></a></li>
                                <li><a class="view-file" data-type="filter"><?php echo _("Filters File"); ?></a></li>
                                <li><a class="view-file" data-type="output"><?php echo _("Outputs File"); ?></a></li>
                                <li class="divider"></li>
                                <li><a class="view-file" data-type="all"><?php echo _("All Files Combined"); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="span6" style="text-align: right;">
                        <a id="output-manager" class="btn btn-default"><?php echo _("Show Outputs"); ?></a>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span6" id="input-col">
                        <div class="row-fluid">
                            <div class="span6">
                                <h4><?php echo _("Inputs"); ?></h4>
                            </div>
                            <div class="span6" style="text-align: right;">
                                <div class="btn-group">
                                    <a class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-plus"></i>
                                        <span class="text"><?php echo _("Add Input"); ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="margin-left: -70px;">
                                        <!--<li><a href="#"><i class="fa fa-magic"></i> <?php echo _("Run Wizard"); ?></a></li>-->
                                        <li><a class="custom" data-type="input"><i class="fa fa-file-code-o"></i> <?php echo _("Custom"); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="well">
                            <div class="config-box input" data-type="input">
                                <?php if (count($node_inputs) > 0) {
                                foreach ($node_inputs as $k => $input) { ?>
                                <div class="block">
                                    <div>
                                        <div class="fl name">
                                            <span class="label label-success toggle-activity active ls-tooltip <?php if ($input['active'] == 0) { echo "hide"; } ?>" title="<?php echo _("Make this block inactive"); ?>"><?php echo _("Active"); ?></span>
                                            <span class="label toggle-activity inactive ls-tooltip <?php if ($input['active'] == 1) { echo "hide"; } ?>" title="<?php echo _("Make this block active"); ?>"><?php echo _("Inactive"); ?></span>
                                            <span class="name"><?php echo $input['name']; ?></span>
                                            <input type="hidden" class="name" style="margin: 0;" name="input_names[<?php echo $k; ?>]" value="<?php echo $input['name']; ?>">
                                            <input type="hidden" class="active" style="margin: 0;" name="input_active[<?php echo $k; ?>]" value="<?php echo $input['active']; ?>">
                                        </div>
                                        <a class="edit fl"><i class="fa fa-pencil"></i></a>
                                        <div class="fr actions">
                                            <a class="open" title="<?php echo _('Open configuration'); ?>"><i class="fa fa-plus"></i></a>
                                            <a class="copy" title="<?php echo _('Copy'); ?>"><i class="fa fa-files-o"></i></a>
                                            <a class="delete" title="<?php echo _('Remove'); ?>"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?php
                                    $height = '100';
                                    $numlines = substr_count($input['raw'], "\n")+1;
                                    foreach (explode("\n", $input['raw']) as $line) {
                                        if (strlen($line) > 100) {
                                            $extra = ceil(strlen($line) / 100);
                                        }
                                    }
                                    if ($numlines > 4) {
                                        $height = $numlines * 17 + ($extra * 17);
                                    }
                                    ?>
                                    <div class="raw hide">
                                        <textarea name="inputs[<?php echo $k; ?>]" style="height: <?php echo $height; ?>px;"><?php echo $input['raw']; ?></textarea>
                                    </div>
                                </div>
                                <?php }
                                } else { ?>
                                <div class="no-blocks"><?php echo _("There are no inputs created for this configuration."); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="span6" id="filter-col">
                        <div class="row-fluid">
                            <div class="span6">
                                <h4><?php echo _("Filters"); ?></h4>
                            </div>
                            <div class="span6" style="text-align: right;">
                                <div class="btn-group">
                                    <a class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-plus"></i>
                                        <span class="text"><?php echo _("Add Filter"); ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="margin-left: -70px;">
                                        <!--<li><a href="#"><i class="fa fa-magic"></i> <?php echo _("Run Wizard"); ?></a></li>-->
                                        <li><a class="custom" data-type="filter"><i class="fa fa-file-code-o"></i> <?php echo _("Custom"); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="well">
                            <div class="config-box filter" data-type="filter">
                                <?php if (count($node_filters) > 0) {
                                foreach ($node_filters as $k => $filter) { ?>
                                <div class="block">
                                    <div>
                                        <div class="fl name">
                                            <span class="label label-success toggle-activity active ls-tooltip <?php if ($filter['active'] == 0) { echo "hide"; } ?>" title="<?php echo _("Make this block inactive"); ?>"><?php echo _("Active"); ?></span>
                                            <span class="label toggle-activity inactive ls-tooltip <?php if ($filter['active'] == 1) { echo "hide"; } ?>" title="<?php echo _("Make this block active"); ?>"><?php echo _("Inactive"); ?></span>
                                            <span class="name"><?php echo $filter['name']; ?></span>
                                            <input type="hidden" class="name" style="margin: 0;" name="filter_names[<?php echo $k; ?>]" value="<?php echo $filter['name']; ?>">
                                            <input type="hidden" class="active" style="margin: 0;" name="filter_active[<?php echo $k; ?>]" value="<?php echo $filter['active']; ?>">
                                        </div>
                                        <a class="edit fl"><i class="fa fa-pencil"></i></a>
                                        <div class="fr actions">
                                            <a class="open" title="<?php echo _('Open configuration'); ?>"><i class="fa fa-plus"></i></a>
                                            <a class="copy" title="<?php echo _('Copy'); ?>"><i class="fa fa-files-o"></i></a>
                                            <a class="delete" title="<?php echo _('Remove'); ?>"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?php
                                    $height = '100';
                                    $numlines = substr_count($filter['raw'], "\n")+1;
                                    foreach (explode("\n", $filter['raw']) as $line) {
                                        if (strlen($line) > 100) {
                                            $extra = ceil(strlen($line) / 100);
                                        }
                                    }
                                    if ($numlines > 4) {
                                        $height = $numlines * 17 + ($extra * 17);
                                    }
                                    ?>
                                    <div class="raw hide">
                                        <textarea name="filters[<?php echo $k; ?>]" style="height: <?php echo $height; ?>px;"><?php echo $filter['raw']; ?></textarea>
                                    </div>
                                </div>
                                <?php }
                                } else { ?>
                                <div class="no-blocks"><?php echo _("There are no filters created for this configuration."); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="span4 hide" id="output-col">
                        <div class="row-fluid">
                            <div class="span6">
                                <h4><?php echo _("Outputs"); ?></h4>
                            </div>
                            <div class="span6" style="text-align: right;">
                                <div class="btn-group">
                                    <a class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-plus"></i>
                                        <span class="text"><?php echo _("Add Output"); ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" style="margin-left: -60px;">
                                        <!--<li><a href="#"><i class="fa fa-magic"></i> <?php echo _("Run Wizard"); ?></a></li>-->
                                        <li><a class="custom" data-type="output"><i class="fa fa-file-code-o"></i> <?php echo _("Custom"); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="well">
                            <div class="config-box output" data-type="output">
                                <?php if (count($node_outputs) > 0) {
                                foreach ($node_outputs as $k => $output) { ?>
                                <div class="block">
                                    <div>
                                        <div class="fl name">
                                            <span class="label label-success toggle-activity active ls-tooltip <?php if ($output['active'] == 0) { echo "hide"; } ?>" title="<?php echo _("Make this block inactive"); ?>"><?php echo _("Active"); ?></span>
                                            <span class="label toggle-activity inactive ls-tooltip <?php if ($output['active'] == 1) { echo "hide"; } ?>" title="<?php echo _("Make this block active"); ?>"><?php echo _("Inactive"); ?></span>
                                            <span class="name"><?php echo $output['name']; ?></span>
                                            <input type="hidden" class="name" style="margin: 0;" name="output_names[<?php echo $k; ?>]" value="<?php echo $output['name']; ?>">
                                            <input type="hidden" class="active" style="margin: 0;" name="output_active[<?php echo $k; ?>]" value="<?php echo $output['active']; ?>">
                                        </div>
                                        <a class="edit fl"><i class="fa fa-pencil"></i></a>
                                        <div class="fr actions">
                                            <a class="open" title="<?php echo _('Open configuration'); ?>"><i class="fa fa-plus"></i></a>
                                            <a class="copy" title="<?php echo _('Copy'); ?>"><i class="fa fa-files-o"></i></a>
                                            <a class="delete" title="<?php echo _('Remove'); ?>"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?php
                                    $height = '100';
                                    $numlines = substr_count($output['raw'], "\n")+1;
                                    foreach (explode("\n", $output['raw']) as $line) {
                                        if (strlen($line) > 100) {
                                            $extra = ceil(strlen($line) / 100);
                                        }
                                    }
                                    if ($numlines > 4) {
                                        $height = $numlines * 17 + ($extra * 17);
                                    }
                                    ?>
                                    <div class="raw hide">
                                        <textarea name="outputs[<?php echo $k; ?>]" style="height: <?php echo $height; ?>px;"><?php echo $output['raw']; ?></textarea>
                                    </div>
                                </div>
                                <?php }
                                } else { ?>
                                <div class="no-blocks"><?php echo _("There are no outputs created for this configuration."); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button disabled type="submit" class="save-btn btn"><?php echo _("Save"); ?></button>
                <?php
                echo form_close();
                } ?>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    $('.view-file').click(function() {
        var type = $(this).data("type");
        $('#view').modal('show');
        $('#view-title').html($(this).text());

        // Grab the actual file and insert it into the textarea
        $.post(site_url+"api/system/view_file_by_type", { type: type, node: '<?php echo $node['_id']; ?>' }, function(file) {
            $('#view-file').html(file);
        });
    });

    $('#verify').click(function() {
        $('#verify-modal').modal({backdrop: 'static'});
        $('#verify-loader').show();
        $('#verify-message').hide();
        $('#verify-config-output').hide();
        $('#verify-running').html('<?php echo _("Verifying configuration... This may take a moment."); ?>');

        // Do the actual config verification...
        $.post(site_url+"api/system/verify_config_syntax", { node: '<?php echo $node['_id']; ?>' }, function(data) {
            $('#verify-loader').hide();
            if (data.result == "success") {
                $('#verify-message').removeClass('alert-danger').addClass('alert-success').html('<?php echo _("Configuration is OK!"); ?>').show();
            } else {
                $('#verify-message').removeClass('alert-success').addClass('alert-danger').html('<?php echo _("There was an error in the configuration!"); ?>').show();
                
                var error = "";
                $.each(data.output, function(k, v) {
                    error += v + "\n";
                });

                $('#verify-config-output').html(error).show();
            }
        }, 'json');

    });

    $('#save-and-apply').click(function() {
        $('#apply-after').val('1');
        $('form').submit();
    });

    // Make a new custom block
    $('.custom').click(function() {
        var type = $(this).data('type');
        // Verify there is no "no xxx" div's
        $('.config-box.'+type).find('.no-blocks').hide();
        $('.config-box.'+type).append(create_new_block_string(type));
        save_needed();
    });

    // When clicking on the edit button for any type of thing...
    $(".configure-layout").on('click', 'a.edit', function() {
        $(this).hide();
        $(this).parents('.block').find('.name span.name').hide();
        $(this).parents('.block').find('.name input.name').attr('type', "text");
        $(this).parents('.block').find('.actions').addClass('pad');
    });

    // When clicking the active/inactive button
    $(".configure-layout").on('click', '.toggle-activity', function() {
        $(this).hide();
        if ($(this).hasClass('active')) {
            $(this).parents('.block').find('.name input.active').val('0');
            $(this).parents('.block').find('.inactive').show();
        } else {
            $(this).parents('.block').find('.name input.active').val('1');
            $(this).parents('.block').find('.active').show();
        }
        save_needed();
    });

    // When clicking on the edit button for any type of thing...
    $(".configure-layout").on('click', 'a.open', function() {
        if ($(this).parents('.block').find('.raw').is(':visible')) {
            $(this).html('<i class="fa fa-plus"></i>');
            $(this).parents('.block').find('.raw').hide();
        } else {
            $(this).html('<i class="fa fa-minus"></i>');
            $(this).parents('.block').find('.raw').show();
        }
    });

    // Copy a block
    $(".configure-layout").on('click', 'a.copy', function() {
        var type = $(this).parents('.config-box').data('type');
        var name = $(this).parents('.block').find('input').val();
        var raw = $(this).parents('.block').find('textarea').text();
        $('.config-box.'+type).append(create_new_block_string(type, name, raw));
        save_needed();
    });

    // Remove the block from the config area
    $(".configure-layout").on('click', 'a.delete', function() {
        if ($(this).parents('.config-box').find('.block').length == 1) {
            if ($(this).parents('.config-box').find('.no-blocks').length == 0) {
                $(this).parents('.config-box').append('<div class="no-blocks"><?php echo _("There are no blocks for this configuration."); ?></div>');
            } else {
                $(this).parents('.config-box').find('.no-blocks').show();
            }
        }
        $(this).parents('.block').remove();
        save_needed();
    });

    $('#prim').click(function() {
        $('.alert-offline button.btn-m').hide();
        $('#permanent').show();
    });

    $('#dk').click(function() {
        $('.alert-offline button.btn-m').hide();
        $('#dont-know').show();
    });

    // Set up sortability
    $('.config-box').sortable({
        items: ".block",
        placeholder: "whitespace-holder",
        delay: 200,
        stop: function(event, ui) {
            var type = $(ui.item).parents('.config-box').data('type');
            reorder_input_names(type);
            save_needed();
        }
    });

    // Output hiding...
    $('#output-manager').click(function() { 
        if ($('#output-col').is(":visible")) {
            $('#output-manager').html('<?php echo _("Show Outputs"); ?>');
            $('#output-col').hide();
            $('#input-col').removeClass('span4').addClass('span6');
            $('#filter-col').removeClass('span4').addClass('span6');
        } else {
            $('#output-manager').html('<i class="fa fa-eye-slash"></i> <?php echo _("Hide Outputs"); ?>');
            $('#output-col').show();
            $('#input-col').removeClass('span6').addClass('span4');
            $('#filter-col').removeClass('span6').addClass('span4');
        }
    });

    $('textarea').on('keydown', function(e) {
        if ((e.which < 16 || e.which > 45) && e.which != 91 && e.which != 92 && (e.which < 112 || e.which > 123)) {
            save_needed();
        }
    });

    $('.name input.name').on('keydown', function(e) {
        if ((e.which < 16 || e.which > 45) && e.which != 91 && e.which != 92 && (e.which < 112 || e.which > 123)) {
            save_needed();
        }
    });
});

function create_new_block_string(type, name, raw)
{
    if (name == undefined) { name = ''; }
    if (raw == undefined) { raw = ''; }
    html = '<div class="block"><div><div class="fl name"><span class="label label-success toggle-activity active ls-tooltip" title="<?php echo _("Make this block inactive"); ?>"><?php echo _("Active"); ?></span><span class="label toggle-activity inactive ls-tooltip hide" title="<?php echo _("Make this block active"); ?>"><?php echo _("Inactive"); ?></span><input type="text" class="name" name="'+type+'_names[]" placeholder="<?php echo _('Block Name'); ?>" style="margin-left: 3px;" value="'+name+'"><input type="hidden" class="active" style="margin: 0;" name="'+type+'_active[]" value="1"></div><div class="fr actions pad"><a class="open" title="<?php echo _('Open configuration'); ?>"><i class="fa fa-minus"></i></a> <a class="copy" title="<?php echo _('Copy'); ?>"><i class="fa fa-files-o"></i></a> <a class="delete" title="<?php echo _('Remove'); ?>"><i class="fa fa-trash-o"></i></a></div><div class="clear"></div></div><div class="raw"><textarea name="'+type+'s[]">'+raw+'</textarea></div></div>';
    return html;
}

// Goes through the list of items and re-orders them one by one
function reorder_input_names(type)
{
    $('.config-box.'+type+' .block').each(function(k, v) {
        $(v).find('input.name').prop('name', type+'_names['+k+']');
        $(v).find('input.active').prop('name', type+'_active['+k+']');
        $(v).find('textarea').prop('name', type+'s['+k+']');
    });
}

function save_needed()
{
    $('.save-btn').prop('disabled', false).addClass('btn-danger');
    $('#save-and-apply').prop('disabled', false);
    $('#not-saved').show();
}
</script>

<!-- View config modal -->
<div id="view" class="modal hide fade" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><?php echo _("View"); ?> - <span id="view-title"></span></h3>
    </div>
    <div class="modal-body configure">
        <div class="box-wrapper">
            <textarea id="view-file"></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo _("Close"); ?></button>
    </div>
</div>

<!-- Verify configuration modal -->
<div id="verify-modal" class="modal hide fade" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><?php echo _("Verify Configuration"); ?></h3>
    </div>
    <div class="modal-body">
        <div>
            <div id="verify-loader" class="hide"><img width="20" height="20" src="<?php echo base_url('media/images/ajax-loader.gif'); ?>" style="padding-right: 8px;"> <span id="verify-running"></span></div>
            <div id="verify-message" class="alert hide"></div>
        </div>
        <div class="configure">
            <div class="box-wrapper">
                <textarea id="verify-config-output" class="hide"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo _("Close"); ?></button>
    </div>
</div>

<?php echo $footer; ?>