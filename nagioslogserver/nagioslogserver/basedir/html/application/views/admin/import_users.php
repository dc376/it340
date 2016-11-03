<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('admin'); ?>"><?php echo _('Administration'); ?></a> <span class="divider">/</span></li>
    <li><a href="<?php echo site_url('admin/users'); ?>"><?php echo _('Users'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('Add Users from LDAP/AD'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <h2><?php echo _('LDAP / Active Directory Import Users'); ?></h2>
                <p><?php echo _("Log into your LDAP / Active Directory"); ?> <strong><?php echo _("administrator"); ?></strong> <?php echo _("or"); ?> <strong><?php echo _("privileged account"); ?></strong> <?php echo _("to be able to import users directly into Log Server."); ?></p>

                <?php if (!empty($errors)) { ?>
                <div class="alert alert-error" style="margin: 15px 0 10px 0;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $errors; ?>
                </div>
                <?php } ?>

                <?php echo form_open('admin/users/import'); ?>
                <div style="padding: 10px 0; margin-bottom: 20px;">
                    <div>
                        <input type="text" name="username" value="<?php if (!empty($username)) { echo $username; } ?>" placeholder="<?php echo _("Username"); ?>">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="<?php echo _("Password"); ?>">
                    </div>
                    <div>
                        <select name="auth_server_id" style="width: auto;">
                            <?php foreach ($auth_servers as $as) { ?>
                            <option value="<?php echo $as['id']; ?>" <?php if (empty($as['active'])) { echo "disabled"; } if (!empty($auth_server_id)) { if ($auth_server_id == $as['id']) { echo 'selected'; } } ?>><?php if ($as['type'] == "ad") { echo _('Active Directory').' - '.$as['name']. ' - '. $as['controllers']; } else { echo _('LDAP').' - '.$as['host']; } ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <button type="submit" value="1" name="submitted" class="btn btn-default"><?php echo _('Next'); ?> <i class="fa fa-chevron-right" style="font-size: 11px; margin-left: 4px;"></i></button>
                    </div>
                </div>
                <?php echo form_close(); ?>

                <a href="<?php echo site_url('admin/auth_servers'); ?>"><?php echo _('Manage Authentication Servers'); ?></a>

            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>