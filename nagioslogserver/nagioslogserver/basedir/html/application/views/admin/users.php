<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Users'); ?></li>
</ul>

<script type="text/javascript">
$(document).ready(function() {

    $('.rm').click(function() {
        var id = $(this).data('id');

        <?php if ($demo_mode) { ?>
        alert('<?php echo _("This action is not available in Demo Mode."); ?>');
        <?php } else { ?>
        // Confirm remove
        var conf = confirm("<?php echo _('This action will permanently delete the user.'); ?>");

        if (conf == true) {
            $.post(site_url + 'admin/users/delete', { id: id }, function(data) {
                if (data.success == 0) {
                    alert(data.errormsg);
                } else {
                    window.location.href = "<?php echo current_url(); ?>";
                }
            }, 'json');
        }
        <?php } ?>
    });

});
</script>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('User Management');?></h2>
                <p>
                    <a href="<?php echo site_url('admin/users/create'); ?>" class="btn"><i class="fa fa-plus"></i> <?php echo _('Create User'); ?></a>
                    <a href="<?php echo site_url('admin/users/import'); ?>" class="btn" style="margin-left: 5px;"><i class="fa fa-users"></i> <?php echo _('Add Users from LDAP/AD'); ?></a>
                </p>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th><?php echo _('Username'); ?></th>
                        <th><?php echo _('Email'); ?></th>
                        <th><?php echo _('Access Level'); ?></th>
                        <th><?php echo _('Account Type'); ?></th>
                        <th style="width: 100px;"><?php echo _('API Access'); ?></th>
                        <th style="width: 120px; text-align: center;"><?php echo _('Action'); ?></th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <?php
                                echo $user['username'];
                                if (!empty($user['name'])) { 
                                    echo ' (' . $user['name'] . ')'; 
                                }
                                ?>
                            </td>
                            <td><?php echo $user['email'];?></td>
                            <td>
                                <?php
                                if ($user['auth_type'] == "admin") {
                                    echo _("Admin");
                                } else {
                                    echo _("User (Limited Access)");
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($user['auth_settings'])) {
                                    $id = $user['auth_settings']['auth_server_id'];
                                    if ($user['auth_settings']['type'] == "ad") {
                                        $type = _('Active Directory');
                                    } else if ($user['auth_settings']['type'] == "ldap") {
                                        $type = 'LDAP';
                                    }

                                    // Find the server they are a part of
                                    foreach ($auth_servers as $as) {
                                        if ($as['id'] == $id) {
                                            echo $type . ' - ' . $as['name'];
                                            break;
                                        }
                                    }
                                } else {
                                    echo _('Local');
                                }
                                ?>
                            </td>
                            <td><?php if ($user['apiaccess'] == 1) { echo _("Yes"); } else { echo _("No"); } ?></td>
                            <td style="width: 120px; text-align: center;">
                                <?php echo anchor("admin/users/edit/".$user['id'], '<i class="fa fa-pencil" style="font-size: 14px; margin-right: 5px;"></i>'._("Edit")) ;?>
                                <?php if ($user['id'] != $myuserid && $user['id'] != "1") { ?>
                                <a class="rm" data-id="<?php echo $user['id']; ?>" style="margin-left: 10px;"><i class="fa fa-trash-o" style="font-size: 14px; margin-right: 5px;"></i><?php echo _("Delete"); ?></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>