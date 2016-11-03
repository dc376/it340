<?php echo $header; ?>

<div class="container" style="margin: 20px auto; width: 1170px;">
    <div class="row">
        <div class="span8 offset2">
            <div class="well">
                <?php echo form_open(current_url(), array('class' => 'form-horizontal login')); ?>
                    <h2 class="login-header"><?php echo _('Forgot Password'); ?></h2>
                    <?php echo _('Please enter your account username to send a password reset request to.');?>
                    <?php if ($message) { echo '<div class="alert" style="margin: 10px 0 0 0;">' . $message . '</div>'; } ?>
                    <div style="margin: 15px 0;">
                        <label for="username">
                        	<strong><?php echo _('Username');?>:</strong>
                        	<input type="text" class="input" name="username" id="username"></input>
                        </label>
      				</div>
                    <div>
                        <button type="submit" class="btn btn-primary"><?php echo _('Send Email'); ?></button>
                        <a href="<?php echo site_url('login'); ?>" class="btn"><?php echo _('Cancel'); ?></a>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>