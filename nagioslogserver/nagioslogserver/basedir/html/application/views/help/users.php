<?php echo $header; ?>

<ul class="breadcrumb">
    <li><a href="<?php echo site_url('help'); ?>"><?php echo _('Help'); ?></a> <span class="divider">/</span></li>
    <li class="active"><?php echo _('User Management'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
        <div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <div class="form-horizontal">
                    <div style="margin: 30px 0;">
						<h3><?php echo _("User Management"); ?></h3>
						<p><?php echo _("This section allows an administrator to add, modify and delete users for Nagios Log Server.  Create a new user by going to Administration > User Management and select the Create User button: "); ?></p>
		                <img src="<?php echo base_url('media/images/create_user.png'); ?>" style="padding-bottom: 10px;" />
		                <p><?php echo _("To edit an existing user on the far right of each existing user there is an 'Edit' link where you can modify user fields and adjust user access."); ?></p>
		                <br>
		                <h4><?php echo _("Create"); ?></h4>
		                <p><?php echo _("Once you locate the user creation section simply fill out the form below.  Anything without an asteriks isn't required, but will help you in the future when trying to manage multiple users: "); ?></p>
		                <img src="<?php echo base_url('media/images/user_form.png'); ?>" style="padding-bottom: 10px;" />
						<br>
						<h4><?php echo _("Access"); ?></h4>
		                <p style='width:75%;'><?php echo _("If you want to grant a new user Administrator make that selection on the right side under user access level.  Here you can also set if you want to allow the user to access the API externally using an access key that's is generated upon creation of the user.  You can come back to User Management to get the user key if it is needed:"); ?></p>
		                <center><img src="<?php echo base_url('media/images/user_access.png'); ?>" style="padding-bottom: 10px;" /></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>