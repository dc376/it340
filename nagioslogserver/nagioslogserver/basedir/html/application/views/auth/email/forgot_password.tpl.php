<html>
<body>
	<h2><?php echo _("Forgot Password Verification"); ?></h2>
	<p><?php echo _("There has been a request to change your password for Nagios Log Server. Please either click the link below or disregard the message."); ?></p>
	<p><?php echo site_url('auth/reset_password/'. $forgotten_password_code);?></p>
</body>
</html>