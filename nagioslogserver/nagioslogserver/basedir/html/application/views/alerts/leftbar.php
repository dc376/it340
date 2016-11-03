		<div class="lside config-editor-side">
			<div class="well">
				<ul class="nav nav-list">
					<li class="nav-header"><?php echo _("Alerting"); ?></li>
					<?php if ($tab == "alerts") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('alerts'); ?>"><i class="fa fa-bell-o"></i> <?php echo _("Alerts"); ?></a></li>
					<?php if ($tab == "templates") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('alerts/templates'); ?>"><i class="fa fa-envelope"></i> <?php echo _("Email Templates"); ?></a></li>
					<?php if (is_admin()) { ?>
					<li class="nav-header"><?php echo _("Configure Alert Methods"); ?></li>
					<?php if ($tab == "nrdp") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('alerts/nrdp'); ?>"><i class="fa fa-hdd-o"></i> <?php echo _("Nagios Servers (NRDP)"); ?></a></li>
					<?php if ($tab == "reactor") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('alerts/reactor'); ?>"><i class="fa fa-sitemap"></i> <?php echo _("Nagios Reactor Servers"); ?></a></li>
					<?php if ($tab == "snmp") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('alerts/snmp'); ?>"><i class="fa fa-crosshairs"></i> <?php echo _("SNMP Trap Receivers"); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>