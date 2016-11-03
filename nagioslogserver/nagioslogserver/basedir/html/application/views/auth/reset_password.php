<?php echo $header; ?>

<div class="container" style="margin: 20px auto; width: 1170px;">
    <div class="row">
        <div class="span8 offset2">
            <div class="well">
                <?php echo form_open(current_url(), array('class' => 'form-horizontal login')); ?>
                    <h2 class="login-header"><?php echo _('Reset Password'); ?></h2>
                    <?php echo _('Please enter a new password for your account.');?>
                    <?php if ($message) { echo '<div class="alert" style="margin: 10px 0 0 0;">' . $message . '</div>'; } ?>
                    <div style="margin: 15px 0;">
                        <label for="new_password">
                        	<strong><?php echo _('New Password'); ?>:</strong>
                        	<?php echo form_input($new_password);?>
                        </label>
                        <label for="new_password_conf">
                        	<strong><?php echo _('Confirm New Password');?>:</strong>
                        	<?php echo form_input($new_password_confirm);?>
                        </label>
                        <?php echo form_input($user_id);?>
						<?php echo form_hidden($csrf); ?>
      				</div>
                    <div>
                        <button type="submit" class="btn btn-primary"><?php echo _('Reset'); ?></button>
                        <a href="<?php echo site_url('login'); ?>" class="btn"><?php echo _('Cancel'); ?></a>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>