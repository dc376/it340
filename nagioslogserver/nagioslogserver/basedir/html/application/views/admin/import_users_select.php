<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('admin/users'); ?>"><?php echo _('Users'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Add Users from LDAP/AD'); ?></li>
</ul>

<style type="text/css">
    .table-icon { vertical-align: text-top; }
    input[type="checkbox"].ad-checkbox { vertical-align: middle; margin-right: 5px; }
    .ad-list { list-style-type: none; margin: 0; }
    .folder-list { background-color: #F9F9F9; }
    .user-list { margin: 15px 30px; }
    .sub-list li span { padding-left: 20px; }
    .ad-folder { padding: 1px 8px 1px 7px; height: 22px; display: block; margin: 2px 0; }
    .ad-folder:hover { cursor: pointer; background-color: #E9E9E9; }
    .ad-folder.active { background-color: #E9E9E9; }
    .import-button { margin-top: 20px; }
    #selected-users { margin-bottom: 15px; }
    #selected-users .num-users, #selected-users .users { font-weight: bold; }
    .user-dn { padding-left: 40px; }
    .user-toggle-show-dn { font-size: 11px; vertical-align: middle; cursor: pointer; margin-left: 2px; }
    .ad-list li label { display: inline-block; }
</style>

<script language="javascript" type="text/javascript">
// Store the selected users for multiple requests
var SELECTED_USERS = [];
var SERVER_TYPE = '<?php echo $server_type; ?>';

$(document).ready(function() {

    // Get the default root folders
    ad_generate_root();

    // When clicking on a folder we actually show the users/folders
    $('#root').on('click', '.ad-folder', function(e) {
        if (!$(this).parents('ul').hasClass('sub-list') && !$(this).hasClass('active') && $(this).parent().has('ul').length == 0) {
            $('.sub-list').remove();
        }

        $('.ad-folder').removeClass('active');
        $(this).addClass('active');

        var path = $(this).data('path');
        var type = $(this).data('type');
        grab_ad_obj('view', type, path, this);
    });

    // Select a user
    $('#view').on('change', '.ad-checkbox', function(e) {
        if ($(this).is(":checked")) {
            if (SELECTED_USERS.indexOf($(this).val()) == -1) {
                SELECTED_USERS.push($(this).val());
            }
        } else {
            // Remove user from the list if we are un-checking it
            var i = SELECTED_USERS.indexOf($(this).val());
            if (i > -1) { SELECTED_USERS.splice(i, 1); }
        }

        // Update user count at bottom of page
        var num = SELECTED_USERS.length;
        $('#selected-users .user-count').html(num);
        var html = "";
        if (num > 0) {
            html = ": "+SELECTED_USERS.join(', ');
        }
        $('#selected-users .users').html(html);

        $('#objs').val(SELECTED_USERS.join('|'));
    });

    $("#view").on('click', '.user-toggle-show-dn', function(e) {
        var userdn = $(this).parents('li').find('.user-dn');
        if (userdn.css("display") == "none") {
            userdn.show();
            $(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
        } else {
            userdn.hide();
            $(this).removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
        }
    });

    $("#view").on('click', '.toggle-users', function(e) {
        var text = $(this).parents('label').find('span');
        if ($(this).prop('checked')) {
            $('.ad-checkbox:not(:disabled)').prop('checked', true).trigger('change');
            text.html('<?php echo _("Select None"); ?>');
        } else {
            $('.ad-checkbox:not(:disabled)').prop('checked', false).trigger('change');
            text.html('<?php echo _("Select All"); ?>');
        }
    });

    $('#select-users').click(function() {
        if ($('#objs').val() == '') {
            alert("<?php echo _('Must select at least one user to import.'); ?>");
            return false;
        }
    });

});

function grab_ad_obj(target_form, type, path, folder)
{
    already_loaded = $(folder).parent().has('ul').length;
    var json_path = JSON.stringify(path);
    var target_form = "#" + target_form;
    
    if (already_loaded == 0) {
        $.ajax({
            type: "POST",
            url: site_url + "api/system/get_nav_window",
            data: { object_type: type, target_path: json_path },
            success: function(response) {
                if (response != "") {
                    // Check the level of the folder and add padding if necessary
                    var sub = $(folder).parents('ul').length;
                    var x = sub * 20;
                    $(folder).parent().append(response);
                    $(folder).parent().find('ul').find('span.ad-folder').css('padding-left', x+'px');
                }
                grab_ad_users(target_form, type, json_path);
            },
            error: function(response) { console.log("<?php echo _('Error: Unable to connect to LDAP server.'); ?>"); }
        });
    } else {
        grab_ad_users(target_form, type, json_path);
    }
}

function ad_generate_root() {
    var target = "#root";
    var type = "container";
    $.ajax({
        type: "POST",
        url: site_url + "api/system/get_nav_window",
        data: { object_type: type, target_path: "", new_list: "1" },
        success: function(response) {
            $(target).html(response);
        },
        error: function(response) { console.log("<?php echo _('Error: Unable to connect to LDAP server.'); ?>"); }
    });
}

function grab_ad_users(target_form, type, json_path) {
    $.ajax({
        type: "POST",
        url: site_url + "api/system/get_ldap_ad_users",
        data: { object_type: type, target_path: json_path, selected: JSON.stringify(SELECTED_USERS) },
        success: function(response) {
            $(target_form).html(response);

            // Go through and verify that all users are checked that need to be

        },
        error: function(response) { console.log("<?php echo _('Error: Unable to connect to LDAP server.'); ?>"); }
    });
}
    
function toggle_boxes(element) {
    $(element.parentNode).children().attr("checked", "true");
    toggle_user_add();
}
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('LDAP / Active Directory Import Users'); ?></h2>
                <p><?php echo _('Select the users you would like to give access to Log Server via LDAP / Active Directory authentication. You will be able to set user-specific permissions on the next page.'); ?></p>
                <h4><?php echo _('Select Users to Import'); ?></h4>
                <p id="selected-users"><strong class="user-count">0</strong> <?php echo _('users selected for import'); ?></p>

                <div style="display: table; min-height: 60px;">
                    <div id="root" style="min-width: 200px; display: table-cell; background-color: #F9F9F9; border-right: 1px solid #CCC; vertical-align: top;"></div>
                    <div id="view" style="min-width: 400px; max-width: 600px; display: table-cell; vertical-align: top;">
                        <ul class="ad-list user-list">
                            <li>&nbsp;</li>
                        </ul>
                    </div>
                </div>

                <?php echo form_open('admin/users/import/step2'); ?>
                <div class="import-button">
                    <input type="hidden" value="" name="objs" id="objs">
                    <button type="submit" id="select-users" class="btn btn-default"><?php echo _('Add Selected Users'); ?> <i class="fa fa-chevron-right" style="font-size: 11px; margin-left: 4px;"></i></button>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>