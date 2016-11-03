<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('LDAP/AD Integration'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
        	<?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('LDAP / Active Directory Integration'); ?></h2>
                <p><?php echo _('Manage authentication servers can be used to authenticate users against during login. Once a server has been added you can'); ?> <a href="<?php echo site_url('admin/users/import'); ?>"><?php echo _('import users'); ?></a>.</p>
                <p style="margin-bottom: 15px;"><a href="<?php echo site_url('admin/add_auth_server'); ?>" class="btn btn-default"><i class="fa fa-plus"></i> <?php echo _('Add Server'); ?></a></p>

                <?php if (!empty($message)) { ?>
                <div class="alert alert-info"><?php echo $message; ?><a href="#" class="close" data-dismiss="alert">&times;</a></div>
                <?php } ?>

                <table class="table table-striped table-hover table-bordered" style="width: auto; min-width: 60%;">
                    <thead>
                        <tr>
                            <th style="width: 20px; text-align: center;"></th>
                            <th><?php echo _('Name'); ?></th>
                            <th><?php echo _('Servers'); ?></th>
                            <th style="width: 140px;"><?php echo _('Type'); ?></th>
                            <th style="width: 80px;"><?php echo _('Encryption'); ?></th>
                            <th style="width: 120px;"><?php echo _('Associated Users'); ?></th>
                            <th style="width: 80px; text-align: center;"><?php echo _('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($servers) > 0) {
                            foreach ($servers as $server) {
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php if ($server['active'] == 1) { echo '<img src="'.base_url('media/icons/accept.png').'" title="'._('Enabled').'">'; } ?></td>
                            <td><?php echo $server['name']; ?></td>
                            <td><?php if ($server['type'] == "ad") { echo $server['controllers']; } else { echo $server['host']; } ?></td>
                            <td><?php if ($server['type'] == "ad") { echo _('Active Directory'); } else if ($server['type'] == "ldap") { echo 'LDAP'; } ?></td>
                            <td><?php echo strtoupper($server['encryption']); ?></td>
                            <td><?php echo $server['associated_users']; ?></td>
                            <td style="font-size: 18px; text-align: center;">
                                <a href="<?php echo site_url('admin/edit_auth_server/'.$server['id']); ?>" title="<?php echo _('Edit'); ?>"><i class="fa fa-wrench"></i></a>
                                <?php if ($server['associated_users'] == 0) { ?><a href="<?php echo site_url('admin/delete_auth_server/'.$server['id']); ?>" title="<?php echo _('Remove server'); ?>" style="margin-left: 10px;"><i class="fa fa-times"></i></a><?php } ?>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="7"><?php echo _('No LDAP/AD auth servers have been added.'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>