--
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
--
--  NagiosQL
--
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
--
--  (c) 2008, 2009 by Martin Willisegger
--
--  Project   : NagiosQL
--  Component : Complete Database
--  Website   : www.nagiosql.org
--  Date      : $LastChangedDate: 2009-05-20 15:40:00 +0200 (Mi, 20. Mai 2009) $
--  Author    : $LastChangedBy: rouven $
--  Version   : 3.0.3
--  Revision  : $LastChangedRevision: 719 $
--  SVN-ID    : $Id: nagiosQL_v3_db_mysql.sql 719 2009-05-20 13:40:00Z rouven $
--
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
--
-- 
-- Tabellenstruktur f�r Tabelle `tbl_command`
-- 

DROP TABLE IF EXISTS `tbl_command`;
CREATE TABLE `tbl_command` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `command_name` varchar(255) NOT NULL,
  `command_line` text NOT NULL,
  `command_type` tinyint(3) unsigned NOT NULL default '0',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`command_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_command`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_contact`
-- 

DROP TABLE IF EXISTS `tbl_contact`;
CREATE TABLE `tbl_contact` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `contact_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `contactgroups` int(10) unsigned NOT NULL default '0',
  `contactgroups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `host_notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `service_notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `host_notification_period` int(10) unsigned NOT NULL default '0',
  `service_notification_period` int(10) unsigned NOT NULL default '0',
  `host_notification_options` varchar(20) NOT NULL,
  `service_notification_options` varchar(20) NOT NULL,
  `host_notification_commands` int(10) unsigned NOT NULL default '0',
  `host_notification_commands_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `service_notification_commands` int(10) unsigned NOT NULL default '0',
  `service_notification_commands_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `can_submit_commands` tinyint(3) unsigned NOT NULL default '2',
  `retain_status_information` tinyint(3) unsigned NOT NULL default '2',
  `retain_nonstatus_information` tinyint(3) unsigned NOT NULL default '2',
  `email` varchar(255) default NULL,
  `pager` varchar(255) default NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `address3` varchar(255) default NULL,
  `address4` varchar(255) default NULL,
  `address5` varchar(255) default NULL,
  `address6` varchar(255) default NULL,
  `name` varchar(255) NOT NULL,
  `use_variables` tinyint(3) unsigned NOT NULL default '0',
  `use_template` tinyint(3) unsigned NOT NULL default '0',
  `use_template_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`contact_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_contact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_contactgroup`
-- 

DROP TABLE IF EXISTS `tbl_contactgroup`;
CREATE TABLE `tbl_contactgroup` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `contactgroup_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `members` int(10) unsigned NOT NULL default '0',
  `contactgroup_members` int(10) unsigned NOT NULL,
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`contactgroup_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_contactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_contacttemplate`
-- 

DROP TABLE IF EXISTS `tbl_contacttemplate`;
CREATE TABLE `tbl_contacttemplate` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `contactgroups` int(10) unsigned NOT NULL default '0',
  `contactgroups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `host_notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `service_notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `host_notification_period` int(11) NOT NULL default '0',
  `service_notification_period` int(11) NOT NULL default '0',
  `host_notification_options` varchar(20) NOT NULL,
  `service_notification_options` varchar(20) NOT NULL,
  `host_notification_commands` int(10) unsigned NOT NULL default '0',
  `host_notification_commands_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `service_notification_commands` int(10) unsigned NOT NULL default '0',
  `service_notification_commands_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `can_submit_commands` tinyint(3) unsigned NOT NULL default '2',
  `retain_status_information` tinyint(3) unsigned NOT NULL default '2',
  `retain_nonstatus_information` tinyint(3) unsigned NOT NULL default '2',
  `email` varchar(255) default NULL,
  `pager` varchar(255) default NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `address3` varchar(255) default NULL,
  `address4` varchar(255) default NULL,
  `address5` varchar(255) default NULL,
  `address6` varchar(255) default NULL,
  `use_variables` tinyint(3) unsigned NOT NULL default '0',
  `use_template` tinyint(3) unsigned NOT NULL default '0',
  `use_template_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`template_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_contacttemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_domain`
-- 

DROP TABLE IF EXISTS `tbl_domain`;
CREATE TABLE `tbl_domain` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `domain` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `basedir` varchar(255) NOT NULL,
  `hostconfig` varchar(255) NOT NULL,
  `serviceconfig` varchar(255) NOT NULL,
  `backupdir` varchar(255) NOT NULL,
  `hostbackup` varchar(255) NOT NULL,
  `servicebackup` varchar(255) NOT NULL,
  `nagiosbasedir` varchar(255) NOT NULL,
  `importdir` varchar(255) NOT NULL,
  `commandfile` varchar(255) NOT NULL,
  `binaryfile` varchar(255) NOT NULL,
  `pidfile` varchar(255) NOT NULL,
  `version` tinyint(3) unsigned NOT NULL,
  `access_rights` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL,
  `nodelete` enum('0','1') NOT NULL default '0',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Daten f�r Tabelle `tbl_domain`
-- 

INSERT INTO `tbl_domain` (`id`, `domain`, `alias`, `server`, `method`, `user`, `password`, `basedir`, `hostconfig`, `serviceconfig`, `backupdir`, `hostbackup`, `servicebackup`, `nagiosbasedir`, `importdir`, `commandfile`, `binaryfile`, `pidfile`, `version`, `access_rights`, `active`, `nodelete`, `last_modified`) VALUES (1, 'localhost', 'Local installation', 'localhost', '1', '', '', '/etc/nagiosql/', '/etc/nagiosql/hosts/', '/etc/nagiosql/services/', '/etc/nagiosql/backup/', '/etc/nagiosql/backup/hosts/', '/etc/nagiosql/backup/services/', '/etc/nagios/', '/etc/nagios/import/', '/var/nagios/rw/nagios.cmd', '/usr/local/nagios/bin/nagios', '/var/nagios/nagios.lock', 3, '00000000', '1', '1', '2008-09-03 18:54:03');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_host`
-- 

DROP TABLE IF EXISTS `tbl_host`;
CREATE TABLE `tbl_host` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `host_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `display_name` varchar(255) default '',
  `address` varchar(255) NOT NULL,
  `parents` tinyint(3) unsigned NOT NULL default '0',
  `parents_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `hostgroups` tinyint(3) unsigned NOT NULL default '0',
  `hostgroups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `check_command` text,
  `use_template` tinyint(3) unsigned NOT NULL default '0',
  `use_template_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `initial_state` varchar(20) default '',
  `max_check_attempts` int(11) default NULL,
  `check_interval` int(11) default NULL,
  `retry_interval` int(11) default NULL,
  `active_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `passive_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `check_period` int(11) NOT NULL default '0',
  `obsess_over_host` tinyint(3) unsigned NOT NULL default '2',
  `check_freshness` tinyint(3) unsigned NOT NULL default '2',
  `freshness_threshold` int(11) default NULL,
  `event_handler` int(11) NOT NULL default '0',
  `event_handler_enabled` tinyint(3) unsigned NOT NULL default '2',
  `low_flap_threshold` int(11) default NULL,
  `high_flap_threshold` int(11) default NULL,
  `flap_detection_enabled` tinyint(3) unsigned NOT NULL default '2',
  `flap_detection_options` varchar(20) default '',
  `process_perf_data` tinyint(3) unsigned NOT NULL default '2',
  `retain_status_information` tinyint(3) unsigned NOT NULL default '2',
  `retain_nonstatus_information` tinyint(3) unsigned NOT NULL default '2',
  `contacts` tinyint(3) unsigned NOT NULL default '0',
  `contacts_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `contact_groups` tinyint(3) unsigned NOT NULL default '0',
  `contact_groups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `notification_interval` int(11) default NULL,
  `notification_period` int(11) NOT NULL default '0',
  `first_notification_delay` int(11) default NULL,
  `notification_options` varchar(20) default '',
  `notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `stalking_options` varchar(20) default '',
  `notes` varchar(255) default '',
  `notes_url` varchar(255) default '',
  `action_url` varchar(255) default '',
  `icon_image` varchar(255) default '',
  `icon_image_alt` varchar(255) default '',
  `vrml_image` varchar(255) default '',
  `statusmap_image` varchar(255) default '',
  `2d_coords` varchar(255) default '',
  `3d_coords` varchar(255) default '',
  `use_variables` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`host_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_host`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_hostdependency`
-- 

DROP TABLE IF EXISTS `tbl_hostdependency`;
CREATE TABLE `tbl_hostdependency` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_name` varchar(255) NOT NULL,
  `dependent_host_name` tinyint(3) unsigned NOT NULL default '0',
  `dependent_hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `host_name` tinyint(3) unsigned NOT NULL default '0',
  `hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `inherits_parent` tinyint(3) unsigned NOT NULL default '0',
  `execution_failure_criteria` varchar(20) default '',
  `notification_failure_criteria` varchar(20) default '',
  `dependency_period` int(11) NOT NULL default '0',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`config_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_hostdependency`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_hostescalation`
-- 

DROP TABLE IF EXISTS `tbl_hostescalation`;
CREATE TABLE `tbl_hostescalation` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_name` varchar(255) NOT NULL,
  `host_name` tinyint(3) unsigned NOT NULL default '0',
  `hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `contacts` tinyint(3) unsigned NOT NULL default '0',
  `contact_groups` tinyint(3) unsigned NOT NULL default '0',
  `first_notification` int(11) default NULL,
  `last_notification` int(11) default NULL,
  `notification_interval` int(11) default NULL,
  `escalation_period` int(11) NOT NULL default '0',
  `escalation_options` varchar(20) default '',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`config_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_hostescalation`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_hostextinfo`
-- 

DROP TABLE IF EXISTS `tbl_hostextinfo`;
CREATE TABLE `tbl_hostextinfo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `host_name` int(11) DEFAULT NULL,
  `notes` varchar(255) NOT NULL,
  `notes_url` varchar(255) NOT NULL,
  `action_url` varchar(255) NOT NULL,
  `statistik_url` varchar(255) NOT NULL,
  `icon_image` varchar(255) NOT NULL,
  `icon_image_alt` varchar(255) NOT NULL,
  `vrml_image` varchar(255) NOT NULL,
  `statusmap_image` varchar(255) NOT NULL,
  `2d_coords` varchar(255) NOT NULL,
  `3d_coords` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`host_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_hostextinfo`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_hostgroup`
-- 

DROP TABLE IF EXISTS `tbl_hostgroup`;
CREATE TABLE `tbl_hostgroup` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `hostgroup_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `members` tinyint(3) unsigned NOT NULL default '0',
  `hostgroup_members` tinyint(3) unsigned NOT NULL default '0',
  `notes` varchar(255) default NULL,
  `notes_url` varchar(255) default NULL,
  `action_url` varchar(255) default NULL,
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`hostgroup_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_hostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_hosttemplate`
-- 

DROP TABLE IF EXISTS `tbl_hosttemplate`;
CREATE TABLE `tbl_hosttemplate` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `parents` tinyint(3) unsigned NOT NULL default '0',
  `parents_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `hostgroups` tinyint(3) unsigned NOT NULL default '0',
  `hostgroups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `check_command` text,
  `use_template` tinyint(3) unsigned NOT NULL default '0',
  `use_template_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `initial_state` varchar(20) default '',
  `max_check_attempts` int(11) default NULL,
  `check_interval` int(11) default NULL,
  `retry_interval` int(11) default NULL,
  `active_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `passive_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `check_period` int(11) NOT NULL default '0',
  `obsess_over_host` tinyint(3) unsigned NOT NULL default '2',
  `check_freshness` tinyint(3) unsigned NOT NULL default '2',
  `freshness_threshold` int(11) default NULL,
  `event_handler` int(11) NOT NULL default '0',
  `event_handler_enabled` tinyint(3) unsigned NOT NULL default '2',
  `low_flap_threshold` int(11) default NULL,
  `high_flap_threshold` int(11) default NULL,
  `flap_detection_enabled` tinyint(3) unsigned NOT NULL default '2',
  `flap_detection_options` varchar(20) default '',
  `process_perf_data` tinyint(3) unsigned NOT NULL default '2',
  `retain_status_information` tinyint(3) unsigned NOT NULL default '2',
  `retain_nonstatus_information` tinyint(3) unsigned NOT NULL default '2',
  `contacts` tinyint(3) unsigned NOT NULL default '0',
  `contacts_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `contact_groups` tinyint(3) unsigned NOT NULL default '0',
  `contact_groups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `notification_interval` int(11) default NULL,
  `notification_period` int(11) NOT NULL default '0',
  `first_notification_delay` int(11) default NULL,
  `notification_options` varchar(20) default '',
  `notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `stalking_options` varchar(20) default '',
  `notes` varchar(255) default '',
  `notes_url` varchar(255) default '',
  `action_url` varchar(255) default '',
  `icon_image` varchar(255) default '',
  `icon_image_alt` varchar(255) default '',
  `vrml_image` varchar(255) default '',
  `statusmap_image` varchar(255) default '',
  `2d_coords` varchar(255) default '',
  `3d_coords` varchar(255) default '',
  `use_variables` tinyint(3) unsigned NOT NULL default '0',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`template_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_hosttemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_info`
-- 

DROP TABLE IF EXISTS `tbl_info`;
CREATE TABLE `tbl_info` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `key1` varchar(200) NOT NULL,
  `key2` varchar(200) NOT NULL,
  `version` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL,
  `infotext` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `keypair` (`key1`,`key2`,`version`,`language`)
) ENGINE=MyISAM AUTO_INCREMENT=223 DEFAULT CHARSET=latin1 AUTO_INCREMENT=223 ;

-- 
-- Daten f�r Tabelle `tbl_info`
-- 

INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (1, 'domain', 'domain', 'all', 'default', 'Common name of this domain. This field is for internal use only.');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (2, 'domain', 'basedir', 'all', 'default', '<p>Absolute path to your NagiosQL configuration directory.<br><br>Examples:<br>/etc/nagiosql/ <br>/usr/local/nagiosql/etc/<br><br>Be sure, that your configuration path settings are matching with your nagios.cfg! (cfg_file=<span style="color: red;">/etc/nagiosql</span>/timeperiods.cfg)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (3, 'domain', 'hostdir', 'all', 'default', 'NagiosQL writes one configuration file for every host. It is useful to store this files inside an own subdirectory below your Nagios configuration path.<br><br>Examples:<br>/etc/nagios/hosts <br>/usr/local/nagios/etc/hosts<br><br>Be sure, that your configuration settings are matching with your nagios.cfg!<br> (cfg_dir=<font color="red">/etc/nagios/hosts</font>)');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (4, 'domain', 'servicedir', 'all', 'default', 'NagiosQL writes services grouped into files identified by the service configuration names. It is useful to store this files inside an own subdirectory below your Nagios configuration path.<br><br>Examples:<br>/etc/nagios/services <br>/usr/local/nagios/etc/services<br><br>Be sure, that your configuration settings are matching with your nagios.cfg!<br> (cfg_dir=<font color="red">/etc/nagios/services</font>)');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (5, 'domain', 'backupdir', 'all', 'default', 'Absolute path to your NagiosQL configuration backup directory.<br><br>Examples:<br>/etc/nagios/backup <br>/usr/local/nagios/etc/backup<br><br>This directory is for internal configuration backups of NagiosQL and is not used by Nagios itself. ');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (6, 'domain', 'backuphostdir', 'all', 'default', 'Absolute path to your NagiosQL host configuration backup directory.<br><br>Examples:<br>/etc/nagios/backup/hosts <br>/usr/local/nagios/etc/backup/hosts<br><br>This directory is for internal configuration backups of NagiosQL only and is not used by Nagios itself.');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (7, 'domain', 'backupservicedir', 'all', 'default', 'Absolute path to your NagiosQL service configuration backup directory.<br><br>Examples:<br>/etc/nagios/backup/services <br>/usr/local/nagios/etc/backup/services<br><br>This directory is for internal configuration backups of NagiosQL only and is not used by Nagios itself.');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (8, 'domain', 'commandfile', 'all', 'default', 'Absolute path to your Nagios command file.<br><br>Examples:<br>/var/spool/nagios/nagios.cmd<br>/usr/local/nagios/var/rw/nagios.cmd<br><br>Be sure, that your command file path settings are matching with your nagios.cfg! (command_file=<font color="red">/var/spool/nagios/nagios.cmd</font>)<br>(check_external_commands=1)<br><br>\r\nThis is used to reload Nagios directly from NagiosQL after changing a configuration.');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (9, 'common', 'accesskeys', 'all', 'default', '<p><strong>Access key/keyholes</strong></p>\r\n<p>NagiosQL uses a very simplified access control mechanism by using up to 8 keys.</p>\r\n<p>To access a secure object (menu, domain), a user must have a key for every defined keyhole.</p>\r\n<p><em>Example:</em></p>\r\n<p>User A has key 1,2,5,7 (can be defined in user management)<br>User B has key 3,5,7,8 (can be defined in user management)</p>\r\n<p>Menu 1 has keyhole 3,5<br>Menu 2 has keyhole 2,5,7<br>Menu 3 has no keyhole<br>Menu 4 has keyhole 4<br><br>User A has access to menu 2 and menu 3 (key 3 for menu 1 and key 4 for menu 4 are missing)<br>User B has access to menu 1 and menu 3 (key 2 for menu 2 and key 4 for menu 4 are missing)</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (10, 'user', 'webserverauth', 'all', 'default', '<p><strong>User - webserver authentification</strong></p>\r\n<p>If your webserver uses authentification and the NagiosQL user name is the same which is actually logged in - the NagiosQL login process will passed. This means, that NagiosQL no longer shows a login page if this user is already logged in by webserver authentification.</p>\r\n<p><span style="color: #ff0000;">This function will be implemented in a future NagiosQL version. Actually, this option is not implemented!</span></p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (11, 'domain', 'nagiosbasedir', 'all', 'default', '<p>Absolute path to your Nagios configuration directory.<br><br>Examples:<br>/etc/nagios/ <br>/usr/local/nagios/etc/</p>\r\n<p>Be sure, that your <span style="color: #ff0000;">nagios.cfg</span> and <span style="color: #ff0000;">cfg.cfg</span> ist located inside this directory. NagiosQL uses this to handle this two files.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (12, 'domain', 'importdir', 'all', 'default', '<p>Absolute path to your configuration import directory.<br><br>Examples:<br>/etc/nagiosql/import/ <br>/usr/local/nagios/etc/import/</p>\r\n<p>You can use this directory to store old or example configuration files in it which should be accessable by the importer of NagiosQL.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (13, 'domain', 'binary', 'all', 'default', '<p>Absolute path to your Nagios binary file.<br><br>Examples:<br>/usr/bin/nagios<br>/usr/local/nagios/bin/nagios<br><br> This is used to verify your configuration.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (14, 'domain', 'pidfile', 'all', 'default', '<p>Absolute path to your Nagios process file.<br><br>Examples:<br>/var/run/nagios/nagios.pid<br>/var/run/nagios/nagios.lock<br><br> This is used to check if nagios is running before sending a reload command to the nagios command file.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (15, 'domain', 'version', 'all', 'default', '<p>The nagios version which is running in this domain.</p>\r\n<p>Be sure you select the correct version here - otherweise not all configuration options are available or not supported options are shown.</p>\r\n<p>You can change this with a running configuration - NagiosQL will then upgrade or downgrade your configuration. Don''t forget to write your complete configuration after a version change!</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (16, 'host', 'hostname', 'all', 'default', '<p><strong>Host - host name</strong><br><br>This directive is used to define a short name used to identify the host. It is used in host group and service definitions to reference this particular host. Hosts can have multiple services (which are monitored) associated with them. When used properly, the $HOSTNAME$ macro will contain this short name.</p>\r\n<p><em>Parameter name:</em> host_name<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (17, 'host', 'alias', 'all', 'default', '<p><strong>Host - alias</strong><br><br>This directive is used to define a longer name or description used to identify the host. It is provided in order to allow you to more easily identify a particular host. When used properly, the $HOSTALIAS$ macro will contain this alias/description.</p>\r\n<p><em>Parameter name:</em> alias<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (18, 'host', 'address', 'all', 'default', '<p><strong>Host - address</strong></p>\r\n<p>This directive is used to define the address of the host. Normally, this is an IP address, although it could really be anything you want (so long as it can be used to check the status of the host). You can use a FQDN to identify the host instead of an IP address, but if DNS services are not availble this could cause problems. When used properly, the $HOSTADDRESS$ macro will contain this address.</p>\r\n<p><strong>Note:</strong> If you do not specify an address directive in a host definition, the name of the host will be used as its address. A word of caution about doing this, however - if DNS fails, most of your service checks will fail because the plugins will be unable to resolve the host name.</p>\r\n<p><em>Parameter name:</em> address<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (19, 'host', 'display_name', 'all', 'default', '<p><strong>Host - display name</strong></p>\r\n<p>This directive is used to define an alternate name that should be displayed in the web interface for this host. If not specified, this defaults to the value you specify for the <em>host_name</em> directive.</p>\r\n<p><strong>Note:</strong> The current CGIs do not use this option, although future versions of the web interface will.</p>\r\n<p><em>Parameter name:</em> display_name<br><em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (20, 'host', 'parents', 'all', 'default', '<p><strong>Host - parents</strong></p>\r\n<p>This directive is used to define a comma-delimited list of short names of the "parent" hosts for this particular host. Parent hosts are typically routers, switches, firewalls, etc. that lie between the monitoring host and a remote hosts. A router, switch, etc. which is closest to the remote host is considered to be that host''s "parent". Read the "Determining Status and Reachability of Network Hosts" document for more information.</p>\r\n<p>If this host is on the same network segment as the host doing the monitoring (without any intermediate routers, etc.) the host is considered to be on the local network and will not have a parent host. Leave this value blank if the host does not have a parent host (i.e. it is on the same segment as the Nagios host). The order in which you specify parent hosts has no effect on how things are monitored.</p>\r\n<p><em>Parameter name:</em> parents<br><em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (21, 'host', 'hostgroups', 'all', 'default', '<p><strong>Host - hostgroup names</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the hostgroup(s) that the host belongs to. Multiple hostgroups should be separated by commas. This directive may be used as an alternative to (or in addition to) using the members directive in hostgroup definitions.<span style="color: #ff0000;"><span style="color: #000000;"> </span></span></p>\r\n<p><span style="color: #ff0000;"><span style="color: #000000;"><strong>NagiosQL:</strong> If a hostgroup is defined here - this host will <span style="color: #ff0000;">not be selected</span> inside the member field of the same hostgroup definition! <br></span></span></p>\r\n<p><em>Parameter name:</em> hostgroups<br><em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (22, 'common', 'tploptions', '3', 'default', '<p><strong>Cancelling Inheritance of String Values</strong></p>\r\n<p>In some cases you may not want your host, service, or contact definitions to inherit values of string variables from the templates they reference. If this is the case, you can specify "<strong>null</strong>" as the value of the variable that you do not want to inherit.</p>\r\n<p><strong><br>Additive Inheritance of String Values</strong></p>\r\n<p>Nagios gives preference to local variables instead of values inherited from templates. In most cases local variable values override those that are defined in templates. In some cases it makes sense to allow Nagios to use the values of inherited <em>and</em> local variables together.</p>\r\n<p>This "additive inheritance" can be accomplished by prepending the local variable value with a plus sign (<strong>+</strong>).  This features is only available for standard (non-custom) variables that contain string values.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (23, 'host', 'check_command', 'all', 'default', '<p><strong>Host - check command</strong><br><br>This directive is used to specify the <em>short name</em> of the command that should be used to check if the host is up or down. Typically, this command would try and ping the host to see if it is "alive". The command must return a status of OK (0) or Nagios will assume the host is down.</p>\r\n<p>If you leave this argument blank, the host will <em>not</em> be actively checked. Thus, Nagios will likely always assume the host is up (it may show up as being in a "PENDING" state in the web interface). This is useful if you are monitoring printers or other devices that are frequently turned off. The maximum amount of time that the notification command can run is controlled by the host_check_timeout option.</p>\r\n<p><em>Parameter name:</em> check_command<br><em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (24, 'host', 'arguments', 'all', 'default', '<p><strong>Host - arguments</strong></p>\r\n<p>The values defined here will replace the according argument variable behind the selected command. Up to 8 argument variables are supported. Be sure, that you defines a valid value for each required argument variable.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (25, 'host', 'templateadd', 'all', 'default', '<p><strong>Host - Templates</strong></p>\r\n<p>You can add one or more host templates to a host configuration. Nagios will add the definitions from each template to a host configuration.</p>\r\n<p>If you add more than one template - the templates from the bottom to the top will be used to overwrite configuration items which are defined inside templates before.</p>\r\n<p>The host configuration itselves will overwrite all values which are defined in templates before and pass all values which are not defined.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (26, 'host', 'initial_state', '3', 'default', '<p><strong>Host - initial state</strong></p>\r\n<p>By default Nagios will assume that all hosts are in UP states when in starts. You can override the initial state for a host by using this directive. Valid options are: <strong><br>o</strong> = UP, <br><strong>d</strong> = DOWN, and <br><strong>u</strong> = UNREACHABLE.</p>\r\n<p><em>Parameter name:</em> initial_state<em><br>Required:</em> no</p>\r\n<p>&nbsp;</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (27, 'host', 'retry_interval', '3', 'default', '<p><strong>Host - retry interval</strong></p>\r\n<p>This directive is used to define the number of "time units" to wait before scheduling a re-check of the hosts. Hosts are rescheduled at the retry interval when they have changed to a non-UP state. Once the host has been retried <strong>max_check_attempts</strong> times without a change in its status, it will revert to being scheduled at its "normal" rate as defined by the <strong>check_interval</strong> value. Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes.  More information on this value can be found in the check scheduling documentation.</p>\r\n<p><em>Parameter name:</em> retry_interval<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (28, 'host', 'max_check_attempts', 'all', 'default', '<p><strong>Host - max check attempts</strong></p>\r\n<p>This directive is used to define the number of times that Nagios will retry the host check command if it returns any state other than an OK state. Setting this value to 1 will cause Nagios to generate an alert without retrying the host check again. Note: If you do not want to check the status of the host, you must still set this to a minimum value of 1. To bypass the host check, just leave the <em>check_command</em> option blank.</p>\r\n<p><em>Parameter name:</em> max_check_attempts<em><br>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (29, 'host', 'check_interval', 'all', 'default', '<p><strong>Host - check interval</strong></p>\r\n<p>This directive is used to define the number of "time units" between regularly scheduled checks of the host. Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes.  More information on this value can be found in the check scheduling documentation.</p>\r\n<p><em>Parameter name:</em> check_interval<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (30, 'host', 'active_checks_enabled', 'all', 'default', '<p><strong>Host - active checks enabled<br></strong></p>\r\n<p>This directive is used to determine whether or not active checks (either regularly scheduled or on-demand) of this host are enabled. Values: 0 = disable active host checks, 1 = enable active host checks.</p>\r\n<p><em>Parameter name:</em> active_checks_enabled<br><em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (31, 'host', 'passive_checks_enabled', 'all', 'default', '<p><strong>Host - passive checks enabled<br> </strong></p>\r\n<p>This directive is used to determine whether or not passive checks are enabled for this host. Values: 0 = disable passive host checks, 1 = enable passive host checks.</p>\r\n<p><em>Parameter name:</em> passive_checks_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (32, 'host', 'check_period', 'all', 'default', '<p><strong>Host - check period<br> </strong></p>\r\n<p>This directive is used to specify the short name of the time period during which active checks of this host can be made.</p>\r\n<p><em>Parameter name:</em> check_period<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (33, 'host', 'freshness_threshold', 'all', 'default', '<p><strong>Host - freshness threshold<br> </strong></p>\r\n<p>This directive is used to specify the freshness threshold (in seconds) for this host. If you set this directive to a value of 0, Nagios will determine a freshness threshold to use automatically.</p>\r\n<p><em>Parameter name:</em> freshness_threshold<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (34, 'host', 'check_freshness', 'all', 'default', '<p><strong>Host - check freshness<br> </strong></p>\r\n<p>This directive is used to determine whether or not freshness checks are enabled for this host. Values: 0 = disable freshness checks, 1 = enable freshness checks.</p>\r\n<p><em>Parameter name:</em> check_freshness<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (35, 'host', 'obsess_over_host', 'all', 'default', '<p><strong>Host - obsess over host<br> </strong></p>\r\n<p>This directive determines whether or not checks for the host will be "obsessed" over using the ochp_command.</p>\r\n<p><em>Parameter name:</em> obsess_over_host<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (36, 'host', 'event_handler', 'all', 'default', '<p><strong>Host - event handler<br> </strong></p>\r\n<p>This directive is used to specify the <em>short name</em> of the command that should be run whenever a change in the state of the host is detected (i.e. whenever it goes down or recovers). Read the documentation on event handlers for a more detailed explanation of how to write scripts for handling events. The maximum amount of time that the event handler command can run is controlled by the event_handler_timeout option.</p>\r\n<p><em>Parameter name:</em> event_handler<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (37, 'host', 'event_handler_enabled', 'all', 'default', '<p><strong>Host - event handler enabled<br> </strong></p>\r\n<p>This directive is used to determine whether or not the event handler for this host is enabled. Values: 0 = disable host event handler, 1 = enable host event handler.</p>\r\n<p><em>Parameter name:</em> event_handler_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (38, 'host', 'low_flap_threshold', 'all', 'default', '<p><strong>Host - low flap threshold<br> </strong></p>\r\n<p>This directive is used to specify the low state change threshold used in flap detection for this host. If you set this directive to a value of 0, the program-wide value specified by the low_host_flap_threshold directive will be used.</p>\r\n<p><em>Parameter name:</em> low_flap_threshold<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (39, 'host', 'high_flap_threshold', 'all', 'default', '<p><strong>Host - high flap threshold<br> </strong></p>\r\n<p>This directive is used to specify the high state change threshold used in flap detection for this host. If you set this directive to a value of 0, the program-wide value specified by the high_host_flap_threshold directive will be used.</p>\r\n<p><em>Parameter name:</em> high_flap_threshold<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (40, 'host', 'flap_detection_enabled', 'all', 'default', '<p><strong>Host - flap detection enabled<br> </strong></p>\r\n<p>This directive is used to determine whether or not flap detection is enabled for this host. Values: 0 = disable host flap detection, 1 = enable host flap detection.</p>\r\n<p><em>Parameter name:</em> flap_detection_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (41, 'host', 'flap_detection_options', '3', 'default', '<p><strong>Host - flap detection options<br> </strong></p>\r\n<p>This directive is used to determine what host states the flap detection logic will use for this host.  Valid options are a combination of one or more of the following: <strong><br>o</strong> = UP states, <br><strong>d</strong> = DOWN states, <br><strong>u</strong> =  UNREACHABLE states.</p>\r\n<p><em>Parameter name:</em> flap_detection_options<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (42, 'host', 'retain_status_information', 'all', 'default', '<p><strong>Host - retain status information<br></strong></p>\r\n<p>This directive is used to determine whether or not status-related information about the host is retained across program restarts. This is only useful if you have enabled state retention using the retain_state_information directive.  Value: 0 = disable status information retention, 1 = enable status information retention.</p>\r\n<p><em>Parameter name:</em> retain_status_information<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (43, 'host', 'retain_nonstatus_information', 'all', 'default', '<p><strong>Host - retain nonstatus information<br></strong></p>\r\n<p>This directive is used to determine whether or not non-status information about the host is retained across program restarts. This is only useful if you have enabled state retention using the retain_state_information directive.  Value: 0 = disable non-status information retention, 1 = enable non-status information retention.</p>\r\n<p><em>Parameter name:</em> retain_nonstatus_information<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (45, 'host', 'contacts', '3', 'default', '<p><strong>Host - contacts<br></strong></p>\r\n<p>This is a list of the <em>short names</em> of the contacts that should be notified whenever there are problems (or recoveries) with this host. Multiple contacts should be separated by commas. Useful if you want notifications to go to just a few people and don''t want to configure contact groups.  You must specify at least one contact or contact group in each host definition.</p>\r\n<p><em>Parameter name:</em> <em>contacs<br>Required:</em> yes (at least one contact <strong>or</strong> contact group)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (46, 'host', 'contactgroups', 'all', 'default', '<p><strong>Host - contact groups<br></strong></p>\r\n<p>This is a list of the <em>short names</em> of the contact groups that should be notified whenever there are problems (or recoveries) with this host. Multiple contact groups should be separated by commas. You must specify at least one contact or contact group in each host definition.</p>\r\n<p><em>Parameter name:</em> contact_groups<br><em>Required:</em> yes (at least one contact <strong>or</strong> contact group)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (47, 'host', 'notification_period', 'all', 'default', '<p><strong>Host - notification period<br></strong></p>\r\n<p>This directive is used to specify the short name of the time period during which notifications of events for this host can be sent out to contacts. If a host goes down, becomes unreachable, or recoveries during a time which is not covered by the time period, no notifications will be sent out.</p>\r\n<p><em>Parameter name:</em> notification_period<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (48, 'host', 'notification_options', 'all', 'default', '<p><strong>Host - notification options<br></strong></p>\r\n<p>This directive is used to determine when notifications for the host should be sent out. Valid options are a combination of one or more of the following: <br><strong>d</strong> = send notifications on a DOWN state, <br><strong>u</strong> = send notifications on an UNREACHABLE state, <strong><br>r</strong> = send notifications on recoveries (OK state), <br><strong>f</strong> = send notifications when the host starts and stops flapping, and <br><strong>s</strong> = send notifications when scheduled downtime starts and ends.  <br>If you do not specify any notification options, Nagios will assume that you want notifications to be sent out for all possible states.</p>\r\n<p>Example: If you specify <strong>d,r</strong> in this field, notifications will only be sent out when the host goes DOWN and when it recovers from a DOWN state.</p>\r\n<p><em>Parameter name:</em> notification_options<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (51, 'host', 'notification_enabled', 'all', 'default', '<p><strong>Host - notification enabled<br></strong></p>\r\n<p>This directive is used to determine whether or not notifications for this host are enabled. Values: 0 = disable host notifications, 1 = enable host notifications.</p>\r\n<p><em>Parameter name:</em> notification_enabled<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (52, 'host', 'stalking_options', 'all', 'default', '<p><strong>Host - stalking options<br></strong></p>\r\n<p>This directive determines which host states "stalking" is enabled for. Valid options are a combination of one or more of the following: <strong><br>o</strong> = stalk on UP states, <br><strong>d</strong> = stalk on DOWN states, and <br><strong>u</strong> = stalk on UNREACHABLE states.</p>\r\n<p><em>Parameter name:</em> stalking_options<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (53, 'host', 'process_perf_data', 'all', 'default', '<p><strong>Host - process performance data<br></strong></p>\r\n<p>This directive is used to determine whether or not the processing of performance data is enabled for this host. Values: 0 = disable performance data processing, 1 = enable performance data processing.</p>\r\n<p><em>Parameter name:</em> process_perf_data<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (54, 'host', 'notification_interval', 'all', 'default', '<p><strong>Host - notification interval<br></strong></p>\r\n<p>This directive is used to define the number of "time units" to wait before re-notifying a contact that this service is <em>still</em> down or unreachable.  Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes.  If you set this value to 0, Nagios will <em>not</em> re-notify contacts about problems for this host - only one problem notification will be sent out.</p>\r\n<p><em>Parameter name:</em> notification_interval<br><em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (55, 'host', 'first_notification_delay', 'all', 'default', '<p><strong>Host - first notification delay<br></strong></p>\r\n<p>This directive is used to define the number of "time units" to wait before sending out the first problem notification when this host enters a non-UP state. Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes. If you set this value to 0, Nagios will start sending out notifications immediately.</p>\r\n<p><em>Parameter name:</em> first_notification_delay<br><em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (56, 'host', 'notes', '3', 'default', '<p><strong>Host - notes<br> </strong></p>\r\n<p>This directive is used to define an optional string of notes pertaining to the host. If you specify a note here, you will see the it in the extended information CGI (when you are viewing information about the specified host).</p>\r\n<p><em>Parameter name:</em> notes<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (57, 'host', 'vrml_image', '3', 'default', '<p><strong>Host - vrml image<br> </strong></p>\r\n<p>This variable is used to define the name of a GIF, PNG, or JPG image that should be associated with this host. This image will be used as the texture map for the specified host in the statuswrl CGI.  Unlike the image you use for the <em>icon_image</em> variable, this one should probably <em>not</em> have any transparency.</p>\r\n<p>If it does, the host object will look a bit wierd.  Images for hosts are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> vrml_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (58, 'host', 'notes_url', '3', 'default', '<p><strong>Host - notes url<br> </strong></p>\r\n<p>This variable is used to define an optional URL that can be used to provide more information about the host. If you specify an URL, you will see a red folder icon in the CGIs (when you are viewing host information) that links to the URL you specify here. Any valid URL can be used.</p>\r\n<p>If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>). This can be very useful if you want to make detailed information on the host, emergency contact methods, etc. available to other support staff.</p>\r\n<p><em>Parameter name:</em> notes_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (59, 'host', 'status_image', '3', 'default', '<p><strong>Host - statusmap image<br> </strong></p>\r\n<p>This variable is used to define the name of an image that should be associated with this host in the statusmap CGI. You can specify a JPEG, PNG, and GIF image if you want, although I would strongly suggest using a GD2 format image, as other image formats will result in a lot of wasted CPU time when the statusmap image is generated.</p>\r\n<p>GD2 images can be created from PNG images by using the <strong>pngtogd2</strong> utility supplied with Thomas Boutell''s gd library .  The GD2 images should be created in <em>uncompressed</em> format in order to minimize CPU load when the statusmap CGI is generating the network map image.</p>\r\n<p>The image will look best if it is 40x40 pixels in size. You can leave these option blank if you are not using the statusmap CGI. Images for hosts are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> statusmap_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (60, 'host', 'action_url', '3', 'default', '<p><strong>Host - action url<br> </strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more actions to be performed on the host. If you specify an URL, you will see a red "splat" icon in the CGIs (when you are viewing host information) that links to the URL you specify here. Any valid URL can be used.</p>\r\n<p>If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>).</p>\r\n<p><em>Parameter name:</em> action_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (61, 'host', 'icon_image', '3', 'default', '<p><strong>Host - icon image<br> </strong></p>\r\n<p>This variable is used to define the name of a GIF, PNG, or JPG image that should be associated with this host. This image will be displayed in the various places in the CGIs. The image will look best if it is 40x40 pixels in size. Images for hosts are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> icon_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (62, 'host', '2d_coords', '3', 'default', '<p><strong>Host - 2D coords<br> </strong></p>\r\n<p>This variable is used to define coordinates to use when drawing the host in the statusmap CGI. Coordinates should be given in positive integers, as they correspond to physical pixels in the generated image. The origin for drawing (0,0) is in the upper left hand corner of the image and extends in the positive x direction (to the right) along the top of the image and in the positive y direction (down) along the left hand side of the image.</p>\r\n<p>For reference, the size of the icons drawn is usually about 40x40 pixels (text takes a little extra space). The coordinates you specify here are for the upper left hand corner of the host icon that is drawn. Note: Don''t worry about what the maximum x and y coordinates that you can use are. The CGI will automatically calculate the maximum dimensions of the image it creates based on the largest x and y coordinates you specify.</p>\r\n<p><em>Parameter name:</em> 2d_coords<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (63, 'host', 'icon_image_alt_text', '3', 'default', '<p><strong>Host - icon image alt<br> </strong></p>\r\n<p>This variable is used to define an optional string that is used in the ALT tag of the image specified by the <em>icon image</em> <em></em> argument.</p>\r\n<p><em>Parameter name:</em> icon_image_alt<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (64, 'host', '3d_coords', '3', 'default', '<p><strong>Host - 3D coords<br> </strong></p>\r\n<p>This variable is used to define coordinates to use when drawing the host in the statuswrl CGI. Coordinates can be positive or negative real numbers. The origin for drawing is (0.0,0.0,0.0). For reference, the size of the host cubes drawn is 0.5 units on each side (text takes a little more space). The coordinates you specify here are used as the center of the host cube.</p>\r\n<p><em>Parameter name:</em> 3d_coords<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (65, 'common', 'free_variables_name', 'all', 'default', '<p><strong>Free variables (custom object variables)<br></strong></p>\r\n<p>NagiosQL supports custom object variables.</p>\r\n<p>There are a few important things that you should note about custom variables:</p>\r\n<ul>\r\n<li>Custom variable names must begin with an underscore (_) to prevent name collision with standard variables </li>\r\n<li>Custom variable names are case-insensitive </li>\r\n<li>Custom variables are inherited from object templates like normal variables </li>\r\n<li>Scripts can reference custom variable values with macros and environment variables </li>\r\n</ul>\r\n<p><em>Examples</em></p>\r\n<p><span style="font-family: courier new,courier;">define host{<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; host_name	linuxserver<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _mac_address	00:06:5B:A6:AD:AA	; &lt;-- Custom MAC_ADDRESS variable<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _rack_number	R32		; &lt;-- Custom RACK_NUMBER variable<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...<br>}</span></p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (66, 'common', 'free_variables_value', 'all', 'default', '<p><strong>Free variables (custom object variables)<br></strong></p>\r\n<p>NagiosQL supports custom object variables.</p>\r\n<p>There are a few important things that you should note about custom variables:</p>\r\n<ul>\r\n<li>Custom variable names must begin with an underscore (_) to prevent name collision with standard variables </li>\r\n<li>Custom variable names are case-insensitive </li>\r\n<li>Custom variables are inherited from object templates like normal variables </li>\r\n<li>Scripts can reference custom variable values with macros and environment variables </li>\r\n</ul>\r\n<p><em>Examples</em></p>\r\n<p><span style="font-family: courier new,courier;">define host{<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; host_name	linuxserver<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _mac_address	00:06:5B:A6:AD:AA	; &lt;-- Custom MAC_ADDRESS variable<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; _rack_number	R32		; &lt;-- Custom RACK_NUMBER variable<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...<br> }</span></p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (67, 'host', 'genericname', 'all', 'default', '<p><strong>Host - generic name</strong></p>\r\n<p>It is possible to use a host definition as a template for other host configurations. If this definition should be used as template, a generic template name must be defined.</p>\r\n<p>We do not recommend to do this - it is more open to define a separate host template than to use this option.</p>\r\n<p><em>Parameter name:</em> name<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (68, 'service', 'config_name', 'all', 'default', '<p><strong>Service - config name</strong></p>\r\n<p>This directive is used to specify a common config name for a group of service definitions. This is a NagiosQL parameter and it will not be written to the configuration file. Every service definitions with the same configuration name will stored in one file. The configuration name is also the file name of this configuration set.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (69, 'service', 'hosts', 'all', 'default', '<p><strong>Service - host name<br> </strong></p>\r\n<p>This directive is used to specify the <em>short name(s)</em> of the host(s) that the service "runs" on or is associated with.</p>\r\n<p><em>Parameter name:</em> host_name<br> <em>Required:</em> yes (no, if a hostgroup is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (70, 'service', 'hostgroups', 'all', 'default', '<p><strong>Service</strong><strong> - hostgroup name<br> </strong></p>\r\n<p>This directive is used to specify the <em>short name(s)</em> of the hostgroup(s) that the service "runs" on or is associated with. The hostgroup_name may be used instead of, or in addition to, the host_name directive.</p>\r\n<p><em>Parameter name:</em> hostgroup_name<br> <em>Required:</em> no (yes, if no host is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (71, 'service', 'service_description', 'all', 'default', '<p><strong>Service</strong><strong> - service description<br> </strong></p>\r\n<p>This directive is used to define the description of the service, which may contain spaces, dashes, and colons (semicolons, apostrophes, and quotation marks should be avoided). No two services associated with the same host can have the same description. Services are uniquely identified with their <em>host_name</em> and <em>service_description</em> directives.</p>\r\n<p><em>Parameter name:</em> service_description<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (72, 'service', 'service_groups', 'all', 'default', '<p><strong>Service</strong><strong> - servicegroups<br> </strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the servicegroup(s) that the service belongs to. Multiple servicegroups should be separated by commas. This directive may be used as an alternative to using the <em>members</em> directive in servicegroup definitions.</p>\r\n<p><span style="color: #ff0000;"><span style="color: #000000;"><strong>NagiosQL:</strong> If a servicegroup is defined here - this service will <span style="color: #ff0000;">not be selected</span> inside the member field of the same servicegroup definition! </span></span></p>\r\n<p><em>Parameter name:</em> servicegroups<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (73, 'service', 'display_name', 'all', 'default', '<p><strong>Service</strong><strong> - display name<br> </strong></p>\r\n<p>This directive is used to define an alternate name that should be displayed in the web interface for this service. If not specified, this defaults to the value you specify for the <em>service_description</em> directive.  Note:  The current CGIs do not use this option, although future versions of the web interface will.</p>\r\n<p><em>Parameter name:</em> display_name<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (74, 'service', 'check_command', 'all', 'default', '<p><strong>Service</strong><strong> - check command<br> </strong></p>\r\n<p>This directive is used to specify the <em>short name</em> of the command that Nagios will run in order to check the status of the service. The maximum amount of time that the service check command can run is controlled by the service_check_timeout option.</p>\r\n<p><em>Parameter name:</em> check_command<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (75, 'service', 'argument', 'all', 'default', '<p><strong>Service - arguments</strong></p>\r\n<p>The values defined here will replace the according argument variable behind the selected command. Up to 8 argument variables are supported. Be sure, that you defines a valid value for each required argument variable.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (76, 'service', 'templateadd', 'all', 'default', '<p><strong>Service - Templates</strong></p>\r\n<p>You can add one or more service templates to a service configuration. Nagios will add the definitions from each template to a service configuration.</p>\r\n<p>If you add more than one template - the templates from the bottom to the top will be used to overwrite configuration items which are defined inside templates before.</p>\r\n<p>The host configuration itselves will overwrite all values which are defined in templates before and pass all values which are not defined.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (77, 'service', 'initial_state', '3', 'default', '<p><strong>Service - initial state<br> </strong></p>\r\n<p>By default Nagios will assume that all services are in OK states when in starts. You can override the initial state for a service by using this directive. Valid options are: <strong><br>o</strong> = OK,<br> <strong>w</strong> = WARNING, <strong><br>u</strong> = UNKNOWN, and <strong><br>c</strong> = CRITICAL.</p>\r\n<p><em>Parameter name:</em> initial_state<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (78, 'service', 'retry_interval', '3', 'default', '<p><strong>Service - retry interval<br> </strong></p>\r\n<p>This directive is used to define the number of "time units" to wait before scheduling a re-check of the service. Services are rescheduled at the retry interval when they have changed to a non-OK state. Once the service has been retried <strong>max_check_attempts</strong> times without a change in its status, it will revert to being scheduled at its "normal" rate as defined by the <strong>check_interval</strong> value. Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes.  More information on this value can be found in the check scheduling documentation.</p>\r\n<p><em>Parameter name:</em> retry_interval<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (79, 'service', 'max_check_attempts', 'all', 'default', '<p><strong>Service - max check attempts<br> </strong></p>\r\n<p>This directive is used to define the number of times that Nagios will retry the service check command if it returns any state other than an OK state. Setting this value to 1 will cause Nagios to generate an alert without retrying the service check again.</p>\r\n<p><em>Parameter name:</em> max_check_attempts<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (80, 'service', 'check_interval', 'all', 'default', '<p><strong>Service - check interval<br> </strong></p>\r\n<p>This directive is used to define the number of "time units" to wait before scheduling the next "regular" check of the service. "Regular" checks are those that occur when the service is in an OK state or when the service is in a non-OK state, but has already been rechecked <strong>max_check_attempts</strong> number of times.  Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes.  More information on this value can be found in the check scheduling documentation.</p>\r\n<p><em>Parameter name:</em> check_interval<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (81, 'service', 'active_checks_enabled', 'all', 'default', '<p><strong>Service - active checks enabled<br> </strong></p>\r\n<p>This directive is used to determine whether or not active checks of this service are enabled. Values: 0 = disable active service checks, 1 = enable active service checks.</p>\r\n<p><em>Parameter name:</em> active_checks_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (82, 'service', 'passive_checks_enabled', 'all', 'default', '<p><strong>Service - passive checks enabled<br> </strong></p>\r\n<p>This directive is used to determine whether or not passive checks of this service are enabled. Values: 0 = disable passive service checks, 1 = enable passive service checks.</p>\r\n<p><em>Parameter name:</em> passive_checks_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (83, 'service', 'parallelize_checks', '2', 'default', '<p><strong>Service - </strong><strong>parallelize check</strong></p>\r\n<p>This directive is used to determine whether or not the service check can be parallelized. By default, all service checks are parallelized. Disabling parallel checks of services can result in serious performance problems. More information on service check parallelization can be found in the nagios documentation.</p>\r\n<p>Values: 0 = service check cannot be parallelized (use with caution!), 1 = service check can be parallelized.</p>\r\n<p><em>Parameter name:</em> parallelize_check<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (84, 'service', 'check_period', 'all', 'default', '<p><strong>Service - check period<br> </strong></p>\r\n<p>This directive is used to specify the short name of the time period during which active checks of this service can be made.</p>\r\n<p><em>Parameter name:</em> check_period<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (85, 'service', 'freshness_threshold', 'all', 'default', '<p><strong>Service - </strong><strong>freshness threshold</strong></p>\r\n<p>This directive is used to specify the freshness threshold (in seconds) for this service. If you set this directive to a value of 0, Nagios will determine a freshness threshold to use automatically.</p>\r\n<p><em>Parameter name:</em> freshness_threshold<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (86, 'service', 'check_freshness', 'all', 'default', '<p><strong>Service - </strong><strong>check freshness</strong></p>\r\n<p>This directive is used to determine whether or not freshness checks are enabled for this service. Values: 0 = disable freshness checks, 1 = enable freshness checks.</p>\r\n<p><em>Parameter name:</em> check_freshness<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (87, 'service', 'obsess_over_service', 'all', 'default', '<p><strong>Service - </strong><strong>obsess over service</strong></p>\r\n<p>This directive determines whether or not checks for the service will be "obsessed" over using the ocsp_command.</p>\r\n<p><em>Parameter name:</em> obsess_over_service<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (88, 'service', 'event_handler', 'all', 'default', '<p><strong>Service - </strong><strong>event handler</strong></p>\r\n<p>This directive is used to specify the <em>short name</em> of the command that should be run whenever a change in the state of the service is detected (i.e. whenever it goes down or recovers). Read the documentation on event handlers for a more detailed explanation of how to write scripts for handling events. The maximum amount of time that the event handler command can run is controlled by the event_handler_timeout option.</p>\r\n<p><em>Parameter name:</em> event_handler<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (89, 'service', 'event_handler_enabled', 'all', 'default', '<p><strong>Service - </strong><strong>event handler enabled</strong></p>\r\n<p>This directive is used to determine whether or not the event handler for this service is enabled. Values: 0 = disable service event handler, 1 = enable service event handler.</p>\r\n<p><em>Parameter name:</em> event_handler_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (90, 'service', 'low_flap_threshold', 'all', 'default', '<p><strong>Service - </strong><strong>low flap threshold</strong></p>\r\n<p>This directive is used to specify the low state change threshold used in flap detection for this service. More information on flap detection can be found in the nagios documentation.  If you set this directive to a value of 0, the program-wide value specified by the low_service_flap_threshold  directive will be used.</p>\r\n<p><em>Parameter name:</em> low_flap_threshold<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (91, 'service', 'high_flap_threshold', 'all', 'default', '<p><strong>Service - </strong><strong>high flap threshold</strong></p>\r\n<p>This directive is used to specify the high state change threshold used in flap detection for this service. More information on flap detection can be found in the nagios documentation.  If you set this directive to a value of 0, the program-wide value specified by the high_service_flap_threshold directive will be used.</p>\r\n<p><em>Parameter name:</em> high_flap_threshold<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (92, 'service', 'flap_detection_enabled', 'all', 'default', '<p><strong>Service - </strong><strong>flap detection enabled</strong></p>\r\n<p>This directive is used to determine whether or not flap detection is enabled for this service. More information on flap detection can be found in the nagios documentation. Values: 0 = disable service flap detection, 1 = enable service flap detection.</p>\r\n<p><em>Parameter name:</em> flap_detection_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (93, 'service', 'flap_detection_options', '3', 'default', '<p><strong>Service - </strong><strong>flap detection options</strong></p>\r\n<p>This directive is used to determine what service states the flap detection logic will use for this service.  Valid options are a combination of one or more of the following: <strong><br>o</strong> = OK states, <br><strong>w</strong> = WARNING states, <br><strong>c</strong> = CRITICAL states, <br><strong>u</strong> = UNKNOWN states.</p>\r\n<p><em>Parameter name:</em> flap_detection_options<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (94, 'service', 'retain_status_information', 'all', 'default', '<p><strong>Service - </strong><strong>retain status information</strong></p>\r\n<p>This directive is used to determine whether or not status-related information about the service is retained across program restarts. This is only useful if you have enabled state retention using the retain_state_information directive.  Value: 0 = disable status information retention, 1 = enable status information retention.</p>\r\n<p><em>Parameter name:</em> retain_status_information<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (95, 'service', 'retain_nonstatus_information', 'all', 'default', '<p><strong>Service - </strong><strong>retain nonstatus information</strong></p>\r\n<p>This directive is used to determine whether or not non-status information about the service is retained across program restarts. This is only useful if you have enabled state retention using the retain_state_information directive.  Value: 0 = disable non-status information retention, 1 = enable non-status information retention.</p>\r\n<p><em>Parameter name:</em> retain_nonstatus_information<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (96, 'service', 'process_perf_data', 'all', 'default', '<p><strong>Service - </strong><strong>process perf data</strong></p>\r\n<p>This directive is used to determine whether or not the processing of performance data is enabled for this service. Values: 0 = disable performance data processing, 1 = enable performance data processing.</p>\r\n<p><em>Parameter name:</em> process_perf_data<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (97, 'service', 'is_volatile', 'all', 'default', '<p><strong>Service</strong><strong> - is volatile<br> </strong></p>\r\n<p>This directive is used to denote whether the service is "volatile".  Services are normally <em>not</em> volatile.  More information on volatile service and how they differ from normal services can be found in the nagios documentation.  Value: 0 = service is not volatile, 1 = service is volatile.</p>\r\n<p><em>Parameter name:</em> is_volatile<br> <em>Required:</em>no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (98, 'service', 'contacts', '3', 'default', '<p><strong>Service - </strong><strong>contacts</strong></p>\r\n<p>This is a list of the <em>short names</em> of the contacts that should be notified whenever there are problems (or recoveries) with this service. Multiple contacts should be separated by commas. Useful if you want notifications to go to just a few people and don''t want to configure contact groups. You must specify at least one contact or contact group in each service definition.</p>\r\n<p><em>Parameter name:</em> contacts<br> <em>Required:</em> yes (no, if a contact group is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (99, 'service', 'contactgroups', 'all', 'default', '<p><strong>Service - </strong><strong>contact groups</strong></p>\r\n<p>This is a list of the <em>short names</em> of the contact groups that should be notified whenever there are problems (or recoveries) with this service. Multiple contact groups should be separated by commas. You must specify at least one contact or contact group in each service definition.</p>\r\n<p><em>Parameter name:</em> contact_groups<br> <em>Required:</em> yes (no, if a contact is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (100, 'service', 'notification_period', 'all', 'default', '<p><strong>Service - </strong><strong>notification period</strong></p>\r\n<p>This directive is used to specify the short name of the time period during which notifications of events for this service can be sent out to contacts. No service notifications will be sent out during times which is not covered by the time period.</p>\r\n<p><em>Parameter name:</em> notification_period<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (101, 'service', 'notification_options', 'all', 'default', '<p><strong>Service - </strong><strong>notification options</strong></p>\r\n<p>This directive is used to determine when notifications for the service should be sent out. Valid options are a combination of one or more of the following:<br><strong><br>w</strong> = send notifications on a WARNING state, <br><strong>u</strong> = send notifications on an UNKNOWN state, <strong><br>c</strong> = send notifications on a CRITICAL state, <br><strong>r</strong> = send notifications on recoveries (OK state), <strong><br>f</strong> = send notifications when the service starts and stops flapping, and <br><strong>s</strong> = send notifications when scheduled downtime starts and ends.</p>\r\n<p>If you do not specify any notification options, Nagios will assume that you want notifications to be sent out for all possible states.</p>\r\n<p>Example: If you specify <strong>w,r</strong> in this field, notifications will only be sent out when the service goes into a WARNING state and when it recovers from a WARNING state.</p>\r\n<p><em>Parameter name:</em> notification_options<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (102, 'service', 'notification_interval', 'all', 'default', '<p><strong>Service - </strong><strong>notification interval</strong></p>\r\n<p>This directive is used to define the number of "time units" to wait before re-notifying a contact that this service is <em>still</em> in a non-OK state.  Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes.  If you set this value to 0, Nagios will <em>not</em> re-notify contacts about problems for this service - only one problem notification will be sent out.</p>\r\n<p><em>Parameter name:</em> notification_interval<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (103, 'service', 'first_notification_delay', 'all', 'default', '<p><strong>Service - </strong><strong>first notification delay</strong></p>\r\n<p>This directive is used to define the number of "time units" to wait before sending out the first problem notification when this service enters a non-OK state. Unless you''ve changed the interval_length directive from the default value of 60, this number will mean minutes. If you set this value to 0, Nagios will start sending out notifications immediately.</p>\r\n<p><em>Parameter name:</em> first_notification_delay<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (104, 'service', 'notification_enabled', 'all', 'default', '<p><strong>Service - </strong><strong>notifications enabled</strong><strong></strong></p>\r\n<p>This directive is used to determine whether or not notifications for this service are enabled. Values: 0 = disable service notifications, 1 = enable service notifications.</p>\r\n<p><em>Parameter name:</em> notifications_enabled<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (105, 'service', 'stalking_options', 'all', 'default', '<p><strong>Service - </strong><strong>stalking options</strong></p>\r\n<p>This directive determines which service states "stalking" is enabled for. Valid options are a combination of one or more of the following: <strong><br>o</strong> = stalk on OK states, <br><strong>w</strong> = stalk on WARNING states, <strong><br>u</strong> = stalk on UNKNOWN states, and <strong><br>c</strong> = stalk on CRITICAL states.</p>\r\n<p>More information on state stalking can be found in the nagios documentation.</p>\r\n<p><em>Parameter name:</em> stalking_options<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (106, 'service', 'notes', '3', 'default', '<p><strong>Service - </strong><strong>notes</strong></p>\r\n<p>This directive is used to define an optional string of notes pertaining to the service. If you specify a note here, you will see the it in the extended information CGI (when you are viewing information about the specified service).</p>\r\n<p><em>Parameter name:</em> notes<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (107, 'service', 'icon_image', '3', 'default', '<p><strong>Service - </strong><strong>icon image</strong><strong> </strong></p>\r\n<p>This variable is used to define the name of a GIF, PNG, or JPG image that should be associated with this service. This image will be displayed in the status and extended information CGIs.  The image will look best if it is 40x40 pixels in size.  Images for services are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> icon_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (108, 'service', 'notes_url', '3', 'default', '<p><strong>Service - </strong><strong>notes url<br></strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more information about the service. If you specify an URL, you will see a red folder icon in the CGIs (when you are viewing service information) that links to the URL you specify here. Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>). This can be very useful if you want to make detailed information on the service, emergency contact methods, etc. available to other support staff.</p>\r\n<p><em>Parameter name:</em> notes_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (109, 'service', 'icon_image_alt_text', '3', 'default', '<p><strong>Service - </strong><strong>icon image alt</strong><strong> </strong></p>\r\n<p>This variable is used to define an optional string that is used in the ALT tag of the image specified by the <em>&lt;icon_image&gt;</em> argument.  The ALT tag is used in the status, extended information and statusmap CGIs.</p>\r\n<p><em>Parameter name:</em> icon_image_alt<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (110, 'service', 'action_url', '3', 'default', '<p><strong>Service - action</strong><strong> url<br> </strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more actions to be performed on the service. If you specify an URL, you will see a red "splat" icon in the CGIs (when you are viewing service information) that links to the URL you specify here. Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>).</p>\r\n<p><em>Parameter name:</em> action_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (111, 'hostgroup', 'hostgroup_name', 'all', 'default', '<p><strong>Hostgroup - </strong><strong>hostgroup name</strong></p>\r\n<p>This directive is used to define a short name used to identify the host group.</p>\r\n<p><em>Parameter name:</em> hostgroup_name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (112, 'hostgroup', 'members', 'all', 'default', '<p><strong>Hostgroup - </strong><strong>members</strong></p>\r\n<p>This is a list of the <em>short names</em> of hosts that should be included in this group. Multiple host names should be separated by commas. This directive may be used as an alternative to (or in addition to) the <em>hostgroups</em> directive in host definitions.</p>\r\n<p><strong>NagiosQL:</strong> If you select a hostgroup inside a host definition using the <em>hostgroups</em> directive in <em>host definition</em>, this host will <span style="color: #ff0000;">not be selected</span> here because these are two different ways to specify a hostgroup!</p>\r\n<p><em>Parameter name:</em> members<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (113, 'hostgroup', 'description', 'all', 'default', '<p><strong>Hostgroup - </strong><strong>alias</strong></p>\r\n<p>This directive is used to define is a longer name or description used to identify the host group. It is provided in order to allow you to more easily identify a particular host group.</p>\r\n<p><em>Parameter name:</em> alias<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (114, 'hostgroup', 'notes', '3', 'default', '<p><strong>Hostgroup - </strong><strong>notes</strong></p>\r\n<p>This directive is used to define an optional string of notes pertaining to the host. If you specify a note here, you will see the it in the extended information CGI (when you are viewing information about the specified host).</p>\r\n<p><em>Parameter name:</em> notes<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (115, 'hostgroup', 'notes_url', '3', 'default', '<p><strong>Hostgroup - </strong><strong>notes url<br></strong></p>\r\n<p>This variable is used to define an optional URL that can be used to provide more information about the host group. If you specify an URL, you will see a red folder icon in the CGIs (when you are viewing hostgroup information) that links to the URL you specify here. Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>). This can be very useful if you want to make detailed information on the host group, emergency contact methods, etc. available to other support staff.</p>\r\n<p><em>Parameter name:</em> notes_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (116, 'hostgroup', 'action_url', '3', 'default', '<p><strong>Hostgroup - </strong><strong>action url</strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more actions to be performed on the host group. If you specify an URL, you will see a red "splat" icon in the CGIs (when you are viewing hostgroup information) that links to the URL you specify here. Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>).</p>\r\n<p><em>Parameter name:</em> action_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (117, 'hostgroup', 'hostgroup_members', 'all', 'default', '<p><strong>Hostgroup - </strong><strong>hostgroup members</strong></p>\r\n<p>This optional directive can be used to include hosts from other "sub" host groups in this host group. Specify a comma-delimited list of short names of other host groups whose members should be included in this group.</p>\r\n<p><em>Parameter name:</em> hostgroup_members<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (118, 'servicegroup', 'servicegroup_name', 'all', 'default', '<p><strong>Servicegroup - </strong><strong>servicegroup name</strong></p>\r\n<p>This directive is used to define a short name used to identify the service group.</p>\r\n<p><em>Parameter name:</em> servicegroup_name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (119, 'servicegroup', 'members', 'all', 'default', '<p><strong>Servicegroup - </strong><strong>members</strong></p>\r\n<p>This is a list of the <em>descriptions</em> of services (and the names of their corresponding hosts) that should be included in this group. Host and service names should be separated by commas. This directive may be used as an alternative to the <em>servicegroups</em> directive in service definitions.</p>\r\n<p><strong>NagiosQL:</strong> If you select a servicegroup inside a service definition using the <em>servicegroups</em> directive in <em>service definition</em>, this service will <span style="color: #ff0000;">not be selected</span> here because these are two different ways to specify a servicegroup!</p>\r\n<p><em>Parameter name:</em> members<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (120, 'servicegroup', 'description', 'all', 'default', '<p><strong>Servicegroup - </strong><strong>alias</strong><strong></strong></p>\r\n<p>This directive is used to define is a longer name or description used to identify the service group. It is provided in order to allow you to more easily identify a particular service group.</p>\r\n<p><em>Parameter name:</em> alias<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (121, 'servicegroup', 'notes', '3', 'default', '<p><strong>Servicegroup - </strong><strong>notes</strong></p>\r\n<p>This directive is used to define an optional string of notes pertaining to the service group. If you specify a note here, you will see the it in the extended information CGI (when you are viewing information about the specified service group).</p>\r\n<p><em>Parameter name:</em> notes<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (122, 'servicegroup', 'notes_url', '3', 'default', '<p><strong>Servicegroup - </strong><strong>notes url</strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more information about the service group. If you specify an URL, you will see a red folder icon in the CGIs (when you are viewing service group information) that links to the URL you specify here. Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>). This can be very useful if you want to make detailed information on the service group, emergency contact methods, etc. available to other support staff.</p>\r\n<p><em>Parameter name:</em> notes_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (123, 'servicegroup', 'action_url', '3', 'default', '<p><strong>Servicegroup - </strong><strong>action url</strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more actions to be performed on the service group. If you specify an URL, you will see a red "splat" icon in the CGIs (when you are viewing service group information) that links to the URL you specify here. Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>).</p>\r\n<p><em>Parameter name:</em> action_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (124, 'servicegroup', 'servicegroup_members', 'all', 'default', '<p><strong>Servicegroup - </strong><strong>servicegroup members</strong></p>\r\n<p>This optional directive can be used to include services from other "sub" service groups in this service group. Specify a comma-delimited list of short names of other service groups whose members should be included in this group.</p>\r\n<p><em>Parameter name:</em> servicegroup_members<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (125, 'hosttemplate', 'template_name', 'all', 'default', '<p><strong>Hosttemplate - template name</strong></p>\r\n<p>This directive is used to define a short name used to identify the host template.</p>\r\n<p><em>Parameter name:</em> name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (126, 'servicetemplate', 'template_name', 'all', 'default', '<p><strong>Servicetemplate - template name</strong></p>\r\n<p>This directive is used to define a short name used to identify the service template.</p>\r\n<p><em>Parameter name:</em> name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (127, 'contact', 'contact_name', 'all', 'default', '<p><strong>Contact - </strong><strong>contact name</strong></p>\r\n<p>This directive is used to define a short name used to identify the contact.  It is referenced in contact group definitions.  Under the right circumstances, the $CONTACTNAME$ macro will contain this value.</p>\r\n<p><em>Parameter name:</em> contact_name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (128, 'contact', 'contactgroups', 'all', 'default', '<p><strong>Contact - </strong><strong>contactgroups</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the contactgroup(s) that the contact belongs to. Multiple contactgroups should be separated by commas. This directive may be used as an alternative to (or in addition to) using the <em>members</em> directive in contactgroup definitions.</p>\r\n<p><span style="color: #ff0000;"><span style="color: #000000;"><strong>NagiosQL:</strong> If a contactgroup is defined here - this contact will <span style="color: #ff0000;">not be selected</span> inside the member field of the same contactgroup definition! </span></span></p>\r\n<p><em>Parameter name:</em> contactgroups<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (129, 'contact', 'alias', 'all', 'default', '<p><strong>Contact - </strong><strong>alias</strong></p>\r\n<p>This directive is used to define a longer name or description for the contact. Under the rights circumstances, the $CONTACTALIAS$ macro will contain this value.  If not specified, the <em>contact_name</em> will be used as the alias.</p>\r\n<p><em>Parameter name:</em> alias<br> <em>Required:</em> no (yes in Nagios 2.x)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (130, 'contact', 'email', 'all', 'default', '<p><strong>Contact - </strong><strong>email</strong></p>\r\n<p>This directive is used to define an email address for the contact. Depending on how you configure your notification commands, it can be used to send out an alert email to the contact. Under the right circumstances, the $CONTACTEMAIL$ macro will contain this value.</p>\r\n<p>Parameter name: email<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (131, 'contact', 'pager', 'all', 'default', '<p><strong>Contact - </strong><strong>pager</strong></p>\r\n<p>This directive is used to define a pager number for the contact. It can also be an email address to a pager gateway (i.e. pagejoe@pagenet.com). Depending on how you configure your notification commands, it can be used to send out an alert page to the contact. Under the right circumstances, the $CONTACTPAGER$ macro will contain this value.</p>\r\n<p>Parameter name: pager<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (132, 'contact', 'address', 'all', 'default', '<p><strong>Contact - </strong><strong>address<em>x</em></strong></p>\r\n<p>Address directives are used to define additional "addresses" for the contact. These addresses can be anything - cell phone numbers, instant messaging addresses, etc. Depending on how you configure your notification commands, they can be used to send out an alert to the contact. Up to six addresses can be defined using these directives (<em>address1</em> through <em>address6</em>). The $CONTACTADDRESS<em>x</em>$ macro will contain this value.</p>\r\n<p>Parameter name: addressx (x as number from 1 to 6)<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (133, 'contact', 'host_notifications_enabled', '3', 'default', '<p><strong>Contact - </strong><strong>host notifications enabled</strong></p>\r\n<p>This directive is used to determine whether or not the contact will receive notifications about host problems and recoveries. Values: 0 = don''t send notifications, 1 = send notifications.</p>\r\n<p><em>Parameter name:</em> host_notifications_enabled<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (134, 'contact', 'service_notifications_enabled', '3', 'default', '<p><strong>Contact - </strong><strong>service notifications enabled</strong></p>\r\n<p>This directive is used to determine whether or not the contact will receive notifications about service problems and recoveries. Values: 0 = don''t send notifications, 1 = send notifications.</p>\r\n<p><em>Parameter name:</em> service_notifications_enabled<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (135, 'contact', 'host_notification_period', 'all', 'default', '<p><strong>Contact - </strong><strong>host notification period</strong></p>\r\n<p>This directive is used to specify the short name of the time period during which the contact can be notified about host problems or recoveries. You can think of this as an "on call" time for host notifications for the contact. Read the documentation on time periods for more information on how this works and potential problems that may result from improper use.</p>\r\n<p><em>Parameter name:</em> host_notification_period<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (136, 'contact', 'service_notification_period', 'all', 'default', '<p><strong>Contact - </strong><strong>service notification period</strong><strong></strong></p>\r\n<p>This directive is used to specify the short name of the time period during which the contact can be notified about service problems or recoveries. You can think of this as an "on call" time for service notifications for the contact. Read the documentation on time periods for more information on how this works and potential problems that may result from improper use.</p>\r\n<p><em>Parameter name:</em> service_notification_period<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (137, 'contact', 'host_notification_options', '2', 'default', '<p><strong>Contact - </strong><strong>host notification options</strong></p>\r\n<p>This directive is used to define the host states for which notifications can be sent out to this contact. Valid options are a combination of one or more of the following: <strong><br>d</strong> = notify on DOWN host states, <br><strong>u</strong> = notify on UNREACHABLE host states, <strong><br>r</strong> = notify on host recoveries (UP states), and <strong><br>f</strong> = notify when the host starts and stops flapping.<br>If you specify <strong>n</strong> (none) as an option, the contact will not receive any type of host notifications.</p>\r\n<p><em>Parameter name:</em> host_notification_options<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (138, 'contact', 'host_notification_options', '3', 'default', '<p><strong>Contact - </strong><strong>host notification options</strong></p>\r\n<p>This directive is used to define the host states for which notifications can be sent out to this contact. Valid options are a combination of one or more of the following: <br><strong>d</strong> = notify on DOWN host states, <strong><br>u</strong> = notify on UNREACHABLE host states, <strong><br>r</strong> = notify on host recoveries (UP states), <strong><br>f</strong> = notify when the host starts and stops flapping, and <br><strong>s</strong> = send notifications when host or service scheduled downtime starts and ends.<br>If you specify <strong>n</strong> (none) as an option, the contact will not receive any type of host notifications.</p>\r\n<p><em>Parameter name:</em> host_notification_options<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (139, 'contact', 'service_notification_options', '2', 'default', '<p><strong>Contact - </strong><strong>service notification options</strong></p>\r\n<p>This directive is used to define the service states for which notifications can be sent out to this contact. Valid options are a combination of one or more of the following: <strong><br>w</strong> = notify on WARNING service states, <strong><br>u</strong> = notify on UNKNOWN service states, <strong><br>c</strong> = notify on CRITICAL service states, <br><strong>r</strong> = notify on service recoveries (OK states), and <br><strong>f</strong> = notify when the servuce starts and stops flapping.<br>If you specify <strong>n</strong> (none) as an option, the contact will not receive any type of host notifications.</p>\r\n<p><em>Parameter name:</em> service_notification_options<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (140, 'contact', 'service_notification_options', '3', 'default', '<p><strong>Contact - </strong><strong>service notification options</strong></p>\r\n<p>This directive is used to define the service states for which notifications can be sent out to this contact. Valid options are a combination of one or more of the following: <strong><br>w</strong> = notify on WARNING service states, <br><strong>u</strong> = notify on UNKNOWN service states, <br><strong>c</strong> = notify on CRITICAL service states, <strong><br>r</strong> = notify on service recoveries (OK states), and <strong><br></strong><strong>f</strong> = notify when the host starts and stops flapping, and <strong><br>s</strong> = send notifications when host or service scheduled downtime starts and ends.  <br>If you specify <strong>n</strong> (none) as an option, the contact will not receive any type of host notifications.</p>\r\n<p><em>Parameter name:</em> service_notification_options<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (141, 'contact', 'host_notification_commands', 'all', 'default', '<p><strong>Contact - </strong><strong>host notification commands</strong></p>\r\n<p>This directive is used to define a list of the <em>short names</em> of the commands used to notify the contact of a <em>host</em> problem or recovery. Multiple notification commands should be separated by commas. All notification commands are executed when the contact needs to be notified. The maximum amount of time that a notification command can run is controlled by the notification_timeout option.</p>\r\n<p><em>Parameter name:</em> host_notification_commands<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (142, 'contact', 'service_notification_commands', 'all', 'default', '<p><strong>Contact - </strong><strong>service notification commands</strong></p>\r\n<p>This directive is used to define a list of the <em>short names</em> of the commands used to notify the contact of a <em>service</em> problem or recovery. Multiple notification commands should be separated by commas. All notification commands are executed when the contact needs to be notified. The maximum amount of time that a notification command can run is controlled by the notification_timeout option.</p>\r\n<p><em>Parameter name:</em> service_notification_commands<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (143, 'contact', 'retain_status_information', '3', 'default', '<p><strong>Contact - </strong><strong>retain status information</strong></p>\r\n<p>This directive is used to determine whether or not status-related information about the contact is retained across program restarts. This is only useful if you have enabled state retention using the retain_state_information directive.  Value: 0 = disable status information retention, 1 = enable status information retention.</p>\r\n<p>Parameter name: retain_status_information<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (144, 'contact', 'can_submit_commands', '3', 'default', '<p><strong>Contact - </strong><strong>can submit commands</strong></p>\r\n<p>This directive is used to determine whether or not the contact can submit external commands to Nagios from the CGIs. Values: 0 = don''t allow contact to submit commands, 1 = allow contact to submit commands.</p>\r\n<p>Parameter name: can_submit_commands<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (145, 'contact', 'retain_nostatus_information', '3', 'default', '<p><strong>Contact - </strong><strong>retain nonstatus information</strong></p>\r\n<p>This directive is used to determine whether or not non-status information about the contact is retained across program restarts. This is only useful if you have enabled state retention using the retain_state_information directive.  Value: 0 = disable non-status information retention, 1 = enable non-status information retention.</p>\r\n<p>Parameter name: retain_nonstatus_information<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (146, 'contact', 'templateadd', 'all', 'default', '<p><strong>Contact - Templates</strong></p>\r\n<p>You can add one or more contact templates to a contact configuration. Nagios will add the definitions from each template to a contact configuration.</p>\r\n<p>If you add more than one template - the templates from the bottom to the top will be used to overwrite configuration items which are defined inside templates before.</p>\r\n<p>The host configuration itselves will overwrite all values which are defined in templates before and pass all values which are not defined.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (147, 'contact', 'genericname', 'all', 'default', '<p><strong>Contact - generic name</strong></p>\r\n<p>It is possible to use a contact definition as a template for other contact configurations. If this definition should be used as template, a generic template name must be defined.</p>\r\n<p>We do not recommend to do this - it is more open to define a separate contact template than use this option.</p>\r\n<p><em>Parameter name:</em> name<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (148, 'contactgroup', 'contactgroup_name', 'all', 'default', '<p><strong>Contactgroup - contactgroup name</strong></p>\r\n<p>This directive is a short name used to identify the contact group.</p>\r\n<p><em>Parameter name:</em> contactgroup_name<em><br>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (149, 'contactgroup', 'members', 'all', 'default', '<p><strong>Contactgroup - </strong><strong>members</strong></p>\r\n<p>This directive is used to define a list of the <em>short names</em> of contacts that should be included in this group. Multiple contact names should be separated by commas. This directive may be used as an alternative to (or in addition to) using the <em>contactgroups</em> directive in contact definitions.</p>\r\n<p><strong>NagiosQL:</strong> If you select a contactgroup inside a contact definition using the&nbsp;<em>contactgroups</em> directive in&nbsp;<em>contact definition</em>, this contact will <span style="color: #ff0000;">not be selected</span> here because these are two different ways to specify a contactgroup!</p>\r\n<p><em>Parameter name:</em> members<em><br>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (150, 'contactgroup', 'alias', 'all', 'default', '<p><strong>Contactgroup - </strong><strong>alias</strong></p>\r\n<p>This directive is used to define a longer name or description used to identify the contact group.</p>\r\n<p><em>Parameter name:</em> alias<em><br>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (151, 'contactgroup', 'contactgroup_members', 'all', 'default', '<p><strong>Contactgroup - </strong><strong>contactgroup members</strong></p>\r\n<p>This optional directive can be used to include contacts from other "sub" contact groups in this contact group. Specify a comma-delimited list of short names of other contact groups whose members should be included in this group.</p>\r\n<p><em>Parameter name:</em> contactgroup_members<em><br>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (152, 'timeperiod', 'timeperiod_name', 'all', 'default', '<p><strong>Timeperiod - </strong><strong>timeperiod name</strong></p>\r\n<p>This directives is the short name used to identify the time period.</p>\r\n<p>Parameter name: timeperiod_name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (153, 'timeperiod', 'exclude', '3', 'default', '<p><strong>Timeperiod - </strong><strong>exclude</strong></p>\r\n<p>This directive is used to specify the short names of other timeperiod definitions whose time ranges should be excluded from this timeperiod. Multiple timeperiod names should be separated with a comma.</p>\r\n<p>Parameter name: exclude<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (154, 'timeperiod', 'alias', 'all', 'default', '<p><strong>Timeperiod - </strong><strong>alias</strong></p>\r\n<p>This directive is a longer name or description used to identify the time period.</p>\r\n<p>Parameter name: alias<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (155, 'timeperiod', 'templatename', '3', 'default', '<p><strong>Timeperiod - </strong><strong>template name</strong></p>\r\n<p>Not yet implemented.</p>\r\n<p>Parameter name: name<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (156, 'timeperiod', 'weekday', '2', 'default', '<p><strong>Timeperiod - </strong><strong>time definition<br></strong></p>\r\n<p>The <em>sunday</em> through <em>saturday</em> directives are comma-delimited lists of time ranges that are "valid" times for a particular day of the week. Notice that there are seven different days for which you can define time ranges (Sunday through Saturday).</p>\r\n<p>Parameter name: [weekday] [exception]<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (157, 'timeperiod', 'timerange', '2', 'default', '<p><strong>Timeperiod - </strong><strong>time range<br></strong></p>\r\n<p>Each time range is in the form of <strong>HH:MM-HH:MM</strong>, where hours are specified on a 24 hour clock.  For example, <strong>00:15-24:00</strong> means 12:15am in the morning for this day until 12:20am midnight (a 23 hour, 45 minute total time range). If you wish to exclude an entire day from the timeperiod, simply do not include it in the timeperiod definition.</p>\r\n<p>Parameter name: [weekday] [exception]<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (158, 'timeperiod', 'weekday', '3', 'default', '<p><strong>Timeperiod - </strong><strong>time definition<br></strong></p>\r\n<p>The weekday directives ("<em>sunday</em>" through "<em>saturday</em>")are comma-delimited lists of time ranges that are "valid" times for a particular day of the week. Notice that there are seven different days for which you can define time ranges (Sunday through Saturday).&nbsp;</p>\r\n<p>You can also specify several different types of exceptions to the standard rotating weekday schedule. Exceptions can take a number of different forms including single days of a specific or generic month, single weekdays in a month, or single calendar dates. You can also specify a range of days/dates and even specify skip intervals to obtain functionality described by "every 3 days between these dates". Rather than list all the possible formats for exception strings, Weekdays and different types of exceptions all have different levels of precedence, so its important to understand how they can affect each other. More information on this can be found in the documentation on timeperiods.</p>\r\n<p>Parameter name: [weekday] [exception]<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (159, 'timeperiod', 'timerange', '3', 'default', '<p><strong>Timeperiod - </strong><strong>time range<br></strong></p>\r\n<p>Each time range is in the form of <strong>HH:MM-HH:MM</strong>, where hours are specified on a 24 hour clock.  For example, <strong>00:15-24:00</strong> means 12:15am in the morning for this day until 12:00am midnight (a 23 hour, 45 minute total time range). If you wish to exclude an entire day from the timeperiod, simply do not include it in the timeperiod definition.</p>\r\n<p>Parameter name: [weekday] [exception]<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (160, 'contacttemplate', 'template_name', 'all', 'default', '<p><strong>Contacttemplate - template name</strong></p>\r\n<p>This directive is used to define a short name used to identify the contact template.</p>\r\n<p><em>Parameter name:</em> name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (161, 'command', 'command_name', 'all', 'default', '<p><strong>Command - </strong><strong>command name</strong></p>\r\n<p>This directive is the short name used to identify the command.  It is referenced in contact, host, and service definitions (in notification, check, and event handler directives), among other places.</p>\r\n<p><em>Parameter name:</em> command_name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (162, 'command', 'command_line', 'all', 'default', '<p><strong>Command - </strong><strong>command line</strong></p>\r\n<p>This directive is used to define what is actually executed by Nagios when the command is used for service or host checks, notifications, or event handlers. Before the command line is executed, all valid macros are replaced with their respective values. See the documentation on macros for determining when you can use different macros. Note that the command line is <em>not</em> surrounded in quotes. Also, if you want to pass a dollar sign ($) on the command line, you have to escape it with another dollar sign.</p>\r\n<p><strong>NOTE</strong>: You may not include a <strong>semicolon</strong> (;) in the <em>command_line</em> directive, because everything after it will be ignored as a config file comment. You can work around this limitation by setting one of the <strong>$USER$</strong> macros in your resource file to a semicolon and then referencing the appropriate $USER$ macro in the <em>command_line</em> directive in place of the semicolon.</p>\r\n<p>If you want to pass arguments to commands during runtime, you can use <strong>$ARGn$</strong> macros in the <em>command_line</em> directive of the command definition and then separate individual arguments from the command name (and from each other) using bang (!) characters in the object definition directive (host check command, service event handler command, etc) that references the command. More information on how arguments in command definitions are processed during runtime can be found in the documentation on macros.</p>\r\n<p><em>Parameter name:</em> command_line<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (163, 'command', 'command_type', 'all', 'default', '<p><strong>Command - </strong><strong>command type</strong></p>\r\n<p>This directive is used to differ checks and misc commands. Its a NagiosQL definition only.</p>\r\n<p>Commands tagged as "check command" will be displayed in services and hosts as check command.</p>\r\n<p>Commands tagged as "misc command" will be displayed in contacts, services and hosts as event command.</p>\r\n<p>Not classified commands will be displayed everywhere.</p>\r\n<p>This definition is only used to reduce the amount of commands shown in the selection fields and to have a more clear view.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (164, 'hostdependency', 'dependent_host', 'all', 'default', '<p><strong>Hostdependency - </strong><strong>dependent host name</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the <em>dependent</em> host(s).  Multiple hosts should be separated by commas</p>\r\n<p><em>Parameter name:</em> dependent_host_name<br> <em>Required:</em> yes (no, if a dependent hostgroup is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (165, 'hostdependency', 'dependent_hostgroups', 'all', 'default', '<p><strong>Hostdependency - </strong><strong>dependent hostgroup name</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the <em>dependent</em>hostgroup(s). Multiple hostgroups should be separated by commas. The dependent_hostgroup_name may be used instead of, or in addition to, the dependent_host_name directive.</p>\r\n<p><em>Parameter name:</em> dependent_hostgroup_name<br> <em>Required:</em> no (yes, if no dependent host is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (166, 'hostdependency', 'host', 'all', 'default', '<p><strong>Hostdependency - </strong><strong>host name</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the host(s) <em>that is being depended upon</em> (also referred to as the master host).  Multiple hosts should be separated by commas.</p>\r\n<p><em>Parameter name:</em> host_name<br> <em>Required:</em> yes (no, if&nbsp; a hostgroup is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (167, 'hostdependency', 'hostgroup', 'all', 'default', '<p><strong>Hostdependency - </strong><strong>hostgroup name</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the host(s) <em>that is being depended upon</em> (also referred to as the master host).  Multiple hosts should be separated by commas.</p>\r\n<p><em>Parameter name:</em> hostgroup_name<br> <em>Required:</em> no (yes, if a no host is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (168, 'hostdependency', 'config_name', 'all', 'default', '<p><strong>Hostdependency - config name</strong></p>\r\n<p>This directive is used to specify a common config name for a hostdependency configration. This is a NagiosQL parameter and it will not be written to the configuration file.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (169, 'hostdependency', 'inherit_parents', 'all', 'default', '<p><strong>Hostdependency - </strong><strong>inherits parent</strong></p>\r\n<p>This directive indicates whether or not the dependency inherits dependencies of the host <em>that is being depended upon</em> (also referred to as the master host). In other words, if the master host is dependent upon other hosts and any one of those dependencies fail, this dependency will also fail.</p>\r\n<p><em>Parameter name:</em> inherits_parent<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (170, 'hostdependency', 'dependency_period', '3', 'default', '<p><strong>Hostdependency - </strong><strong>dependency_period</strong></p>\r\n<p>This directive is used to specify the short name of the time period during which this dependency is valid. If this directive is not specified, the dependency is considered to be valid during all times.</p>\r\n<p><em>Parameter name:</em> dependency_period<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (171, 'hostdependency', 'execution_failure_criteria', 'all', 'default', '<p><strong>Hostdependency - </strong><strong>execution failure criteria</strong></p>\r\n<p>This directive is used to specify the criteria that determine when the dependent host should <em>not</em> be actively checked.  If the <em>master</em> host is in one of the failure states we specify, the <em>dependent</em> host will not be actively checked. Valid options are a combination of one or more of the following (multiple options are separated with commas): <br><strong>o</strong> = fail on an UP state, <br><strong>d</strong> = fail on a DOWN state, <br><strong>u</strong> = fail on an UNREACHABLE state, and <strong><br>p</strong> = fail on a pending state (e.g. the host has not yet been checked).</p>\r\n<p>If you specify <strong>n</strong> (none) as an option, the execution dependency will never fail and the dependent host will always be actively checked (if other conditions allow for it to be).</p>\r\n<p>Example: If you specify <strong>u,d</strong> in this field, the <em>dependent</em> host will not be actively checked if the <em>master</em> host is in either an UNREACHABLE or DOWN state.</p>\r\n<p><em>Parameter name:</em> execution_failure_criteria<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (172, 'hostdependency', 'notification_failure_criteria', 'all', 'default', '<p><strong>Hostdependency - </strong><strong>notification failure criteria</strong></p>\r\n<p>This directive is used to define the criteria that determine when notifications for the dependent host should <em>not</em> be sent out.  If the <em>master</em> host is in one of the failure states we specify, notifications for the <em>dependent</em> host will not be sent to contacts.  Valid options are a combination of one or more of the following: <br><strong>o</strong> = fail on an UP state, <br><strong>d</strong> = fail on a DOWN state, <br><strong>u</strong> = fail on an UNREACHABLE state, and <br><strong>p</strong> = fail on a pending state (e.g. the host has not yet been checked).</p>\r\n<p>If you specify <strong>n</strong> (none) as an option, the notification dependency will never fail and notifications for the dependent host will always be sent out.</p>\r\n<p>Example: If you specify <strong>d</strong> in this field, the notifications for the <em>dependent</em> host will not be sent out if the <em>master</em> host is in a DOWN state.</p>\r\n<p><em>Parameter name:</em> notification_failure_criteria<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (173, 'hostescalation', 'host', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>host name</strong></p>\r\n<p>This directive is used to identify the <em>short name</em> of the host that the escalation should apply to.</p>\r\n<p><em>Parameter name:</em> host_name<br> <em>Required:</em> yes (no, if a hostgroup name is defined</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (174, 'hostescalation', 'hostgroup', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>hostgroup name</strong><strong></strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the hostgroup(s) that the escalation should apply to. Multiple hostgroups should be separated by commas. If this is used, the escalation will apply to all hosts that are members of the specified hostgroup(s).</p>\r\n<p><em>Parameter name:</em> hostgroup_name<br> <em>Required:</em> no (yes, if no host ist defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (175, 'hostescalation', 'contact', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>contacts</strong><strong></strong></p>\r\n<p>This is a list of the <em>short names</em> of the contacts that should be notified whenever there are problems (or recoveries) with this host. Multiple contacts should be separated by commas. Useful if you want notifications to go to just a few people and don''t want to configure contact groups.  You must specify at least one contact or contact group in each host escalation definition.</p>\r\n<p><em>Parameter name:</em> contacts<br> <em>Required:</em> yes (no, if a contactgroup is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (176, 'hostescalation', 'contactgroup', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>contact groups</strong></p>\r\n<p>This directive is used to identify the <em>short name</em> of the contact group that should be notified when the host notification is escalated. Multiple contact groups should be separated by commas. You must specify at least one contact or contact group in each host escalation definition.</p>\r\n<p><em>Parameter name:</em> contact_groups<br> <em>Required:</em> yes (no, if a contact is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (177, 'hostescalation', 'config_name', 'all', 'default', '<p><strong>Hostescalation - config name</strong></p>\r\n<p>This directive is used to specify a common config name for a hostescalation configration. This is a NagiosQL parameter and it will not be written to the configuration file.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (178, 'hostescalation', 'escalation_period', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>escalation period</strong></p>\r\n<p>This directive is used to specify the short name of the time period during which this escalation is valid. If this directive is not specified, the escalation is considered to be valid during all times.</p>\r\n<p><em>Parameter name:</em> escalation_period<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (179, 'hostescalation', 'escalation_options', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>escalation options</strong><strong></strong></p>\r\n<p>This directive is used to define the criteria that determine when this host escalation is used. The escalation is used only if the host is in one of the states specified in this directive. If this directive is not specified in a host escalation, the escalation is considered to be valid during all host states. Valid options are a combination of one or more of the following: <br><strong>r</strong> = escalate on an UP (recovery) state, <br><strong>d</strong> = escalate on a DOWN state, and <strong><br>u</strong> = escalate on an UNREACHABLE state.</p>\r\n<p>Example: If you specify <strong>d</strong> in this field, the escalation will only be used if the host is in a DOWN state.</p>\r\n<p><em>Parameter name:</em> escalation_options<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (180, 'hostescalation', 'first_notification', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>first notification</strong><strong></strong></p>\r\n<p>This directive is a number that identifies the <em>first</em> notification for which this escalation is effective. For instance, if you set this value to 3, this escalation will only be used if the host is down or unreachable long enough for a third notification to go out.</p>\r\n<p><em>Parameter name:</em> first_notification<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (181, 'hostescalation', 'last_notification', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>last notification</strong></p>\r\n<p>This directive is a number that identifies the <em>last</em> notification for which this escalation is effective. For instance, if you set this value to 5, this escalation will not be used if more than five notifications are sent out for the host. Setting this value to 0 means to keep using this escalation entry forever (no matter how many notifications go out).</p>\r\n<p><em>Parameter name:</em> last_notification<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (182, 'hostescalation', 'notification_interval', 'all', 'default', '<p><strong>Hostescalation - </strong><strong>notification interval</strong></p>\r\n<p>This directive is used to determine the interval at which notifications should be made while this escalation is valid. If you specify a value of 0 for the interval, Nagios will send the first notification when this escalation definition is valid, but will then prevent any more problem notifications from being sent out for the host. Notifications are sent out again until the host recovers.</p>\r\n<p>This is useful if you want to stop having notifications sent out after a certain amount of time. Note: If multiple escalation entries for a host overlap for one or more notification ranges, the smallest notification interval from all escalation entries is used.</p>\r\n<p><em>Parameter name:</em> notification_interval<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (183, 'hostextinfo', 'host_name', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>host name</strong></p>\r\n<p>This variable is used to identify the <em>short name</em> of the host which the data is associated with.</p>\r\n<p><em>Parameter name:</em> host_name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (184, 'hostextinfo', 'icon_image', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>icon image</strong></p>\r\n<p>This variable is used to define the name of a GIF, PNG, or JPG image that should be associated with this host. This image will be displayed in the status and extended information CGIs.  The image will look best if it is 40x40 pixels in size.</p>\r\n<p>Images for hosts are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> icon_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (185, 'hostextinfo', 'notes', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>notes</strong><strong></strong></p>\r\n<p>This directive is used to define an optional string of notes pertaining to the host. If you specify a note here, you will see the it in the extended information CGI (when you are viewing information about the specified host).</p>\r\n<p><em>Parameter name:</em> notes<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (186, 'hostextinfo', 'icon_image_alt_text', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>icon image alt</strong><strong></strong></p>\r\n<p>This variable is used to define an optional string that is used in the ALT tag of the image specified by the <em>&lt;icon_image&gt;</em> argument.  The ALT tag is used in the status, extended information and statusmap CGIs.</p>\r\n<p><em>Parameter name:</em> icon_image_alt<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (187, 'hostextinfo', 'notes_url', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>notes url</strong></p>\r\n<p>This variable is used to define an optional URL that can be used to provide more information about the host. If you specify an URL, you will see a link that says "Extra Host Notes" in the extended information CGI (when you are viewing information about the specified host). Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>). This can be very useful if you want to make detailed information on the host, emergency contact methods, etc. available to other support staff.</p>\r\n<p><em>Parameter name:</em> notes_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (188, 'hostextinfo', 'vrml_image', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>vrml image</strong><strong></strong></p>\r\n<p>This variable is used to define the name of a GIF, PNG, or JPG image that should be associated with this host. This image will be used as the texture map for the specified host in the <a href="http://nagios.sourceforge.net/docs/3_0/cgis.html#statuswrl_cgi">statuswrl</a> CGI.  Unlike the image you use for the <em>icon_image</em> variable, this one should probably <em>not</em> have any transparency.  If it does, the host object will look a bit wierd.</p>\r\n<p>Images for hosts are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> vrml_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (189, 'hostextinfo', 'action_url', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>action url</strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more actions to be performed on the host. If you specify an URL, you will see a link that says "Extra Host Actions" in the extended information CGI (when you are viewing information about the specified host). Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>).</p>\r\n<p><em>Parameter name:</em> action_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (190, 'hostextinfo', 'status_image', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>statusmap image</strong></p>\r\n<p>This variable is used to define the name of an image that should be associated with this host in the statusmap CGI. You can specify a JPEG, PNG, and GIF image if you want, although I would strongly suggest using a GD2 format image, as other image formats will result in a lot of wasted CPU time when the statusmap image is generated.</p>\r\n<p>GD2 images can be created from PNG images by using the <strong>pngtogd2</strong> utility supplied with Thomas Boutell''s gd library.  The GD2 images should be created in <em>uncompressed</em> format in order to minimize CPU load when the statusmap CGI is generating the network map image.</p>\r\n<p>The image will look best if it is 40x40 pixels in size. You can leave these option blank if you are not using the statusmap CGI. Images for hosts are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> statusmap_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (191, 'hostextinfo', '2d_coords', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>2d coords</strong></p>\r\n<p>This variable is used to define coordinates to use when drawing the host in the statusmap CGI. Coordinates should be given in positive integers, as they correspond to physical pixels in the generated image. The origin for drawing (0,0) is in the upper left hand corner of the image and extends in the positive x direction (to the right) along the top of the image and in the positive y direction (down) along the left hand side of the image. For reference, the size of the icons drawn is usually about 40x40 pixels (text takes a little extra space). The coordinates you specify here are for the upper left hand corner of the host icon that is drawn.</p>\r\n<p>Note: Don''t worry about what the maximum x and y coordinates that you can use are. The CGI will automatically calculate the maximum dimensions of the image it creates based on the largest x and y coordinates you specify.</p>\r\n<p><em>Parameter name:</em> 2d_coords<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (192, 'hostextinfo', '3d_coords', 'all', 'default', '<p><strong>Hostextinfo - </strong><strong>3d coords</strong></p>\r\n<p>This variable is used to define coordinates to use when drawing the host in the statuswrl CGI. Coordinates can be positive or negative real numbers. The origin for drawing is (0.0,0.0,0.0). For reference, the size of the host cubes drawn is 0.5 units on each side (text takes a little more space). The coordinates you specify here are used as the center of the host cube.</p>\r\n<p><em>Parameter name:</em> 3d_coords<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (193, 'serviceescalation', 'host', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>host name</strong><strong></strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the host(s) that the service escalation should apply to or is associated with.</p>\r\n<p><em>Parameter name:</em> host_name<br> <em>Required:</em> yes (no, if a hostgroup name is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (194, 'serviceescalation', 'hostgroup', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>hostgroup name</strong></p>\r\n<p>This directive is used to specify the <em>short name(s)</em> of the hostgroup(s) that the service escalation should apply to or is associated with. Multiple hostgroups should be separated by commas. The hostgroup_name may be used instead of, or in addition to, the host_name directive.</p>\r\n<p><em>Parameter name:</em> hostgroup_name<br> <em>Required:</em> yes (no, if a host name is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (195, 'serviceescalation', 'contact', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>contacts</strong></p>\r\n<p>This is a list of the <em>short names</em> of the contacts that should be notified whenever there are problems (or recoveries) with this service. Multiple contacts should be separated by commas. Useful if you want notifications to go to just a few people and don''t want to configure contact groups.  You must specify at least one contact or contact group in each service escalation definition.</p>\r\n<p><em>Parameter name:</em> contacts<br> <em>Required:</em> yes (no, if a contact group is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (196, 'serviceescalation', 'contactgroup', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>contact groups</strong></p>\r\n<p>This directive is used to identify the <em>short name</em> of the contact group that should be notified when the service notification is escalated. Multiple contact groups should be separated by commas. You must specify at least one contact or contact group in each service escalation definition.</p>\r\n<p><em>Parameter name:</em> contact_groups<br> <em>Required:</em> yes (no, if a contact is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (197, 'serviceescalation', 'config_name', 'all', 'default', '<p><strong>Serviceescalation - config name</strong></p>\r\n<p>This directive is used to specify a common config name for a serviceescalation configration. This is a NagiosQL parameter and it will not be written to the configuration file.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (198, 'serviceescalation', 'service', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>service description</strong><strong></strong></p>\r\n<p>This directive is used to identify the <em>description</em> of the service the escalation should apply to.</p>\r\n<p><em>Parameter name:</em> service_description<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (199, 'serviceescalation', 'first_notification', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>first notification</strong></p>\r\n<p>This directive is a number that identifies the <em>first</em> notification for which this escalation is effective. For instance, if you set this value to 3, this escalation will only be used if the service is in a non-OK state long enough for a third notification to go out.</p>\r\n<p><em>Parameter name:</em> first_notification<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (200, 'serviceescalation', 'last_notification', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>last notification</strong></p>\r\n<p>This directive is a number that identifies the <em>last</em> notification for which this escalation is effective. For instance, if you set this value to 5, this escalation will not be used if more than five notifications are sent out for the service. Setting this value to 0 means to keep using this escalation entry forever (no matter how many notifications go out).</p>\r\n<p><em>Parameter name:</em> last_notification<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (201, 'serviceescalation', 'notification_interval', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>notification interval</strong></p>\r\n<p>This directive is used to determine the interval at which notifications should be made while this escalation is valid. If you specify a value of 0 for the interval, Nagios will send the first notification when this escalation definition is valid, but will then prevent any more problem notifications from being sent out for the host. Notifications are sent out again until the host recovers.</p>\r\n<p>This is useful if you want to stop having notifications sent out after a certain amount of time. Note: If multiple escalation entries for a host overlap for one or more notification ranges, the smallest notification interval from all escalation entries is used.</p>\r\n<p><em>Parameter name:</em> notification_interval<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (202, 'serviceescalation', 'escalation_period', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>escalation period</strong></p>\r\n<p>This directive is used to specify the short name of the time period during which this escalation is valid. If this directive is not specified, the escalation is considered to be valid during all times.</p>\r\n<p><em>Parameter name:</em> escalation_period<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (203, 'serviceescalation', 'escalation_options', 'all', 'default', '<p><strong>Serviceescalation - </strong><strong>escalation options</strong></p>\r\n<p>This directive is used to define the criteria that determine when this service escalation is used. The escalation is used only if the service is in one of the states specified in this directive. If this directive is not specified in a service escalation, the escalation is considered to be valid during all service states. Valid options are a combination of one or more of the following: <strong><br>r</strong> = escalate on an OK (recovery) state, <br><strong>w</strong> = escalate on a WARNING state, <strong><br>u</strong> = escalate on an UNKNOWN state, and <br><strong>c</strong> = escalate on a CRITICAL state.</p>\r\n<p>Example: If you specify <strong>w</strong> in this field, the escalation will only be used if the service is in a WARNING state.</p>\r\n<p><em>Parameter name:</em> escalation_options<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (204, 'servicedependency', 'dependent_host', 'all', 'default', '<p><strong>Servicedependency - </strong><strong>dependent host</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the host(s) that the <em>dependent</em> service "runs" on or is associated with. Multiple hosts should be separated by commas. Leaving this directive blank can be used to create "same host" dependencies.</p>\r\n<p><em>Parameter name:</em> dependent_host<br> <em>Required:</em> yes (no, if a dependent hostgroup is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (205, 'servicedependency', 'host', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> </strong><strong>host name</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the host(s) that the service <em>that is being depended upon</em> (also referred to as the master service) "runs" on or is associated with.  Multiple hosts should be separated by commas.</p>\r\n<p><em>Parameter name:</em> host_name<br> <em>Required:</em> yes (no, if a hostgroup is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (206, 'servicedependency', 'dependent_hostgroup', 'all', 'default', '<p><strong>Servicedependency - </strong><strong>dependent hostgroup</strong></p>\r\n<p>This directive is used to specify the <em>short name(s)</em> of the hostgroup(s) that the <em>dependent</em> service "runs" on or is associated with. Multiple hostgroups should be separated by commas. The dependent_hostgroup may be used instead of, or in addition to, the dependent_host directive.</p>\r\n<p><em>Parameter name:</em> dependent_hostgroup<br> <em>Required:</em> yes (no, if a dependent host is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (207, 'servicedependency', 'hostgroup', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> </strong><strong>hostgroup name</strong></p>\r\n<p>This directive is used to identify the <em>short name(s)</em> of the hostgroup(s) that the service <em>that is being depended upon</em> (also referred to as the master service) "runs" on or is associated with. Multiple hostgroups should be separated by commas. The hostgroup_name may be used instead of, or in addition to, the host_name directive.</p>\r\n<p><em>Parameter name:</em> hostgroup_name<br> <em>Required:</em> yes (no, if a host is defined)</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (208, 'servicedependency', 'dependent_services', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> dependent service description</strong><strong></strong></p>\r\n<p>This directive is used to identify the <em>description</em> of the <em>dependent</em> service.</p>\r\n<p><em>Parameter name:</em> dependent_service_description<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (209, 'servicedependency', 'services', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> </strong><strong>service description</strong><strong></strong></p>\r\n<p>This directive is used to identify the <em>description</em> of the service <em>that is being depended upon</em> (also referred to as the master service).</p>\r\n<p><em>Parameter name:</em> service_description<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (210, 'servicedependency', 'config_name', 'all', 'default', '<p><strong>Servicedependency - config name</strong></p>\r\n<p>This directive is used to specify a common config name for a servicedependency configration. This is a NagiosQL parameter and it will not be written to the configuration file.</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (211, 'servicedependency', 'inherit_parents', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> </strong><strong>inherits parent</strong></p>\r\n<p>This directive indicates whether or not the dependency inherits dependencies of the service <em>that is being depended upon</em> (also referred to as the master service). In other words, if the master service is dependent upon other services and any one of those dependencies fail, this dependency will also fail.</p>\r\n<p><em>Parameter name:</em> inherits_parent<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (212, 'servicedependency', 'dependency_period', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> </strong><strong>dependency period</strong><strong></strong></p>\r\n<p>This directive is used to specify the short name of the time period during which this dependency is valid. If this directive is not specified, the dependency is considered to be valid during all times.</p>\r\n<p><em>Parameter name:</em> dependency_period<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (213, 'servicedependency', 'execution_failure_criteria', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> </strong><strong>execution failure criteria</strong><strong></strong></p>\r\n<p>This directive is used to specify the criteria that determine when the dependent service should <em>not</em> be actively checked.  If the <em>master</em> service is in one of the failure states we specify, the <em>dependent</em> service will not be actively checked. Valid options are a combination of one or more of the following (multiple options are separated with commas): <br><strong>o</strong> = fail on an OK state, <br><strong>w</strong> = fail on a WARNING state, <strong><br>u</strong> = fail on an UNKNOWN state, <br><strong>c</strong> = fail on a CRITICAL state, and <br><strong>p</strong> = fail on a pending state (e.g. the service has not yet been checked).  <br>If you specify <strong>n</strong> (none) as an option, the execution dependency will never fail and checks of the dependent service will always be actively checked (if other conditions allow for it to be).</p>\r\n<p>Example: If you specify <strong>o,c,u</strong> in this field, the <em>dependent</em> service will not be actively checked if the <em>master</em> service is in either an OK, a CRITICAL, or an UNKNOWN state.</p>\r\n<p><em>Parameter name:</em> execution_failure_criteria<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (214, 'servicedependency', 'notification_failure_criteria', 'all', 'default', '<p><strong>Servicedependency -</strong><strong> </strong><strong>notification failure criteria</strong><strong></strong></p>\r\n<p>This directive is used to define the criteria that determine when notifications for the dependent service should <em>not</em> be sent out.  If the <em>master</em> service is in one of the failure states we specify, notifications for the <em>dependent</em> service will not be sent to contacts.  Valid options are a combination of one or more of the following: <strong><br>o</strong> = fail on an OK state, <br><strong>w</strong> = fail on a WARNING state, <strong><br>u</strong> = fail on an UNKNOWN state, <br><strong>c</strong> = fail on a CRITICAL state, and <br><strong>p</strong> = fail on a pending state (e.g. the service has not yet been checked).  <br>If you specify <strong>n</strong> (none) as an option, the notification dependency will never fail and notifications for the dependent service will always be sent out.</p>\r\n<p>Example: If you specify <strong>w</strong> in this field, the notifications for the <em>dependent</em> service will not be sent out if the <em>master</em> service is in a WARNING state.</p>\r\n<p><em>Parameter name:</em> notification_failure_criteria<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (216, 'serviceextinfo', 'host_name', 'all', 'default', '<p><strong>Serviceextinfo -</strong><strong> </strong><strong>host name</strong></p>\r\n<p>This directive is used to identify the <em>short name</em> of the host that the service is associated with.</p>\r\n<p><em>Parameter name:</em> host_name<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (217, 'serviceextinfo', 'icon_image', 'all', 'default', '<p><strong>Serviceextinfo -</strong><strong> </strong><strong>icon image</strong></p>\r\n<p>This variable is used to define the name of a GIF, PNG, or JPG image that should be associated with this host. This image will be displayed in the status and extended information CGIs.</p>\r\n<p>The image will look best if it is 40x40 pixels in size.  Images for hosts are assumed to be in the <strong>logos/</strong> subdirectory in your HTML images directory (i.e. <em>/usr/local/nagios/share/images/logos</em>).</p>\r\n<p><em>Parameter name:</em> icon_image<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (218, 'serviceextinfo', 'service_description', 'all', 'default', '<p><strong>Serviceextinfo -</strong><strong> </strong><strong>service description</strong></p>\r\n<p>This directive is description of the service which the data is associated with.</p>\r\n<p><em>Parameter name:</em> service_description<br> <em>Required:</em> yes</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (219, 'serviceextinfo', 'notes', 'all', 'default', '<p><strong>Serviceextinfo -</strong><strong> </strong><strong>notes</strong></p>\r\n<p>This directive is used to define an optional string of notes pertaining to the service. If you specify a note here, you will see the it in the extended information CGI (when you are viewing information about the specified service).</p>\r\n<p><em>Parameter name:</em> notes<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (220, 'serviceextinfo', 'action_url', 'all', 'default', '<p><strong>Serviceextinfo -</strong><strong> </strong><strong>action url</strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more actions to be performed on the service. If you specify an URL, you will see a link that says "Extra Service Actions" in the extended information CGI (when you are viewing information about the specified service). Any valid URL can be used. If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>).</p>\r\n<p><em>Parameter name:</em> action_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (221, 'serviceextinfo', 'notes_url', 'all', 'default', '<p><strong>Serviceextinfo -</strong><strong> </strong><strong>notes url</strong></p>\r\n<p>This directive is used to define an optional URL that can be used to provide more information about the service. If you specify an URL, you will see a link that says "Extra Service Notes" in the extended information CGI (when you are viewing information about the specified service). Any valid URL can be used.</p>\r\n<p>If you plan on using relative paths, the base path will the the same as what is used to access the CGIs (i.e. <em>/cgi-bin/nagios/</em>). This can be very useful if you want to make detailed information on the service, emergency contact methods, etc. available to other support staff.</p>\r\n<p><em>Parameter name:</em> notes_url<br> <em>Required:</em> no</p>');
INSERT INTO `tbl_info` (`id`, `key1`, `key2`, `version`, `language`, `infotext`) VALUES (222, 'serviceextinfo', 'icon_image_alt', 'all', 'default', '<p><strong>Serviceextinfo -</strong><strong> </strong><strong>icon image alt</strong><strong></strong></p>\r\n<p>This variable is used to define an optional string that is used in the ALT tag of the image specified by the <em>&lt;icon_image&gt;</em> argument.  The ALT tag is used in the status, extended information and statusmap CGIs.</p>\r\n<p><em>Parameter name:</em> icon_image_alt<br> <em>Required:</em> no</p>');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContactToCommandHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkContactToCommandHost`;
CREATE TABLE `tbl_lnkContactToCommandHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContactToCommandHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContactToCommandService`
-- 

DROP TABLE IF EXISTS `tbl_lnkContactToCommandService`;
CREATE TABLE `tbl_lnkContactToCommandService` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContactToCommandService`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContactToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkContactToContactgroup`;
CREATE TABLE `tbl_lnkContactToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContactToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContactToContacttemplate`
-- 

DROP TABLE IF EXISTS `tbl_lnkContactToContacttemplate`;
CREATE TABLE `tbl_lnkContactToContacttemplate` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  `idSort` int(11) NOT NULL,
  `idTable` tinyint(4) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`,`idTable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContactToContacttemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContactToVariabledefinition`
-- 

DROP TABLE IF EXISTS `tbl_lnkContactToVariabledefinition`;
CREATE TABLE `tbl_lnkContactToVariabledefinition` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContactToVariabledefinition`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContactgroupToContact`
-- 

DROP TABLE IF EXISTS `tbl_lnkContactgroupToContact`;
CREATE TABLE `tbl_lnkContactgroupToContact` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContactgroupToContact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContactgroupToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkContactgroupToContactgroup`;
CREATE TABLE `tbl_lnkContactgroupToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContactgroupToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContacttemplateToCommandHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkContacttemplateToCommandHost`;
CREATE TABLE `tbl_lnkContacttemplateToCommandHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContacttemplateToCommandHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContacttemplateToCommandService`
-- 

DROP TABLE IF EXISTS `tbl_lnkContacttemplateToCommandService`;
CREATE TABLE `tbl_lnkContacttemplateToCommandService` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContacttemplateToCommandService`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContacttemplateToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkContacttemplateToContactgroup`;
CREATE TABLE `tbl_lnkContacttemplateToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContacttemplateToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContacttemplateToContacttemplate`
-- 

DROP TABLE IF EXISTS `tbl_lnkContacttemplateToContacttemplate`;
CREATE TABLE `tbl_lnkContacttemplateToContacttemplate` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  `idSort` int(11) NOT NULL,
  `idTable` tinyint(4) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`,`idTable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContacttemplateToContacttemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkContacttemplateToVariabledefinition`
-- 

DROP TABLE IF EXISTS `tbl_lnkContacttemplateToVariabledefinition`;
CREATE TABLE `tbl_lnkContacttemplateToVariabledefinition` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkContacttemplateToVariabledefinition`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostToContact`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostToContact`;
CREATE TABLE `tbl_lnkHostToContact` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostToContact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostToContactgroup`;
CREATE TABLE `tbl_lnkHostToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostToHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostToHost`;
CREATE TABLE `tbl_lnkHostToHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostToHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostToHostgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostToHostgroup`;
CREATE TABLE `tbl_lnkHostToHostgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostToHostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostToHosttemplate`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostToHosttemplate`;
CREATE TABLE `tbl_lnkHostToHosttemplate` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  `idSort` int(11) NOT NULL,
  `idTable` tinyint(4) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`,`idTable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostToHosttemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostToVariabledefinition`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostToVariabledefinition`;
CREATE TABLE `tbl_lnkHostToVariabledefinition` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostToVariabledefinition`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostdependencyToHost_DH`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostdependencyToHost_DH`;
CREATE TABLE `tbl_lnkHostdependencyToHost_DH` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostdependencyToHost_DH`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostdependencyToHost_H`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostdependencyToHost_H`;
CREATE TABLE `tbl_lnkHostdependencyToHost_H` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostdependencyToHost_H`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostdependencyToHostgroup_DH`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostdependencyToHostgroup_DH`;
CREATE TABLE `tbl_lnkHostdependencyToHostgroup_DH` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostdependencyToHostgroup_DH`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostdependencyToHostgroup_H`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostdependencyToHostgroup_H`;
CREATE TABLE `tbl_lnkHostdependencyToHostgroup_H` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostdependencyToHostgroup_H`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostescalationToContact`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostescalationToContact`;
CREATE TABLE `tbl_lnkHostescalationToContact` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostescalationToContact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostescalationToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostescalationToContactgroup`;
CREATE TABLE `tbl_lnkHostescalationToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostescalationToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostescalationToHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostescalationToHost`;
CREATE TABLE `tbl_lnkHostescalationToHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostescalationToHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostescalationToHostgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostescalationToHostgroup`;
CREATE TABLE `tbl_lnkHostescalationToHostgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostescalationToHostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostgroupToHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostgroupToHost`;
CREATE TABLE `tbl_lnkHostgroupToHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostgroupToHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHostgroupToHostgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkHostgroupToHostgroup`;
CREATE TABLE `tbl_lnkHostgroupToHostgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHostgroupToHostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHosttemplateToContact`
-- 

DROP TABLE IF EXISTS `tbl_lnkHosttemplateToContact`;
CREATE TABLE `tbl_lnkHosttemplateToContact` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHosttemplateToContact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHosttemplateToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkHosttemplateToContactgroup`;
CREATE TABLE `tbl_lnkHosttemplateToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHosttemplateToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHosttemplateToHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkHosttemplateToHost`;
CREATE TABLE `tbl_lnkHosttemplateToHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHosttemplateToHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHosttemplateToHostgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkHosttemplateToHostgroup`;
CREATE TABLE `tbl_lnkHosttemplateToHostgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHosttemplateToHostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHosttemplateToHosttemplate`
-- 

DROP TABLE IF EXISTS `tbl_lnkHosttemplateToHosttemplate`;
CREATE TABLE `tbl_lnkHosttemplateToHosttemplate` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  `idSort` int(11) NOT NULL,
  `idTable` tinyint(4) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`,`idTable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHosttemplateToHosttemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkHosttemplateToVariabledefinition`
-- 

DROP TABLE IF EXISTS `tbl_lnkHosttemplateToVariabledefinition`;
CREATE TABLE `tbl_lnkHosttemplateToVariabledefinition` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkHosttemplateToVariabledefinition`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceToContact`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceToContact`;
CREATE TABLE `tbl_lnkServiceToContact` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceToContact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceToContactgroup`;
CREATE TABLE `tbl_lnkServiceToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceToHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceToHost`;
CREATE TABLE `tbl_lnkServiceToHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceToHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceToHostgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceToHostgroup`;
CREATE TABLE `tbl_lnkServiceToHostgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceToHostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceToServicegroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceToServicegroup`;
CREATE TABLE `tbl_lnkServiceToServicegroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceToServicegroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceToServicetemplate`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceToServicetemplate`;
CREATE TABLE `tbl_lnkServiceToServicetemplate` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  `idSort` int(11) NOT NULL,
  `idTable` tinyint(4) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`,`idTable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceToServicetemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceToVariabledefinition`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceToVariabledefinition`;
CREATE TABLE `tbl_lnkServiceToVariabledefinition` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceToVariabledefinition`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicedependencyToHost_DH`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicedependencyToHost_DH`;
CREATE TABLE `tbl_lnkServicedependencyToHost_DH` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicedependencyToHost_DH`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicedependencyToHost_H`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicedependencyToHost_H`;
CREATE TABLE `tbl_lnkServicedependencyToHost_H` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicedependencyToHost_H`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicedependencyToHostgroup_DH`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicedependencyToHostgroup_DH`;
CREATE TABLE `tbl_lnkServicedependencyToHostgroup_DH` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicedependencyToHostgroup_DH`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicedependencyToHostgroup_H`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicedependencyToHostgroup_H`;
CREATE TABLE `tbl_lnkServicedependencyToHostgroup_H` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicedependencyToHostgroup_H`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicedependencyToService_DS`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicedependencyToService_DS`;
CREATE TABLE `tbl_lnkServicedependencyToService_DS` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicedependencyToService_DS`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicedependencyToService_S`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicedependencyToService_S`;
CREATE TABLE `tbl_lnkServicedependencyToService_S` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicedependencyToService_S`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceescalationToContact`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceescalationToContact`;
CREATE TABLE `tbl_lnkServiceescalationToContact` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceescalationToContact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceescalationToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceescalationToContactgroup`;
CREATE TABLE `tbl_lnkServiceescalationToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceescalationToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceescalationToHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceescalationToHost`;
CREATE TABLE `tbl_lnkServiceescalationToHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceescalationToHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceescalationToHostgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceescalationToHostgroup`;
CREATE TABLE `tbl_lnkServiceescalationToHostgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceescalationToHostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServiceescalationToService`
-- 

DROP TABLE IF EXISTS `tbl_lnkServiceescalationToService`;
CREATE TABLE `tbl_lnkServiceescalationToService` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServiceescalationToService`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicegroupToService`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicegroupToService`;
CREATE TABLE `tbl_lnkServicegroupToService` (
  `idMaster` int(11) NOT NULL,
  `idSlaveH` int(11) NOT NULL,
  `idSlaveHG` int(11) NOT NULL,
  `idSlaveS` int(11) NOT NULL,
  PRIMARY KEY ( `idMaster` ,`idSlaveH`,`idSlaveHG`,`idSlaveS`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicegroupToService`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicegroupToServicegroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicegroupToServicegroup`;
CREATE TABLE `tbl_lnkServicegroupToServicegroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicegroupToServicegroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicetemplateToContact`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicetemplateToContact`;
CREATE TABLE `tbl_lnkServicetemplateToContact` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicetemplateToContact`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicetemplateToContactgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicetemplateToContactgroup`;
CREATE TABLE `tbl_lnkServicetemplateToContactgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicetemplateToContactgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicetemplateToHost`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicetemplateToHost`;
CREATE TABLE `tbl_lnkServicetemplateToHost` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicetemplateToHost`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicetemplateToHostgroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicetemplateToHostgroup`;
CREATE TABLE `tbl_lnkServicetemplateToHostgroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicetemplateToHostgroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicetemplateToServicegroup`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicetemplateToServicegroup`;
CREATE TABLE `tbl_lnkServicetemplateToServicegroup` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicetemplateToServicegroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicetemplateToServicetemplate`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicetemplateToServicetemplate`;
CREATE TABLE `tbl_lnkServicetemplateToServicetemplate` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  `idSort` int(11) NOT NULL,
  `idTable` tinyint(4) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`,`idTable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicetemplateToServicetemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkServicetemplateToVariabledefinition`
-- 

DROP TABLE IF EXISTS `tbl_lnkServicetemplateToVariabledefinition`;
CREATE TABLE `tbl_lnkServicetemplateToVariabledefinition` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkServicetemplateToVariabledefinition`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_lnkTimeperiodToTimeperiod`
-- 

DROP TABLE IF EXISTS `tbl_lnkTimeperiodToTimeperiod`;
CREATE TABLE `tbl_lnkTimeperiodToTimeperiod` (
  `idMaster` int(11) NOT NULL,
  `idSlave` int(11) NOT NULL,
  PRIMARY KEY  (`idMaster`,`idSlave`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten f�r Tabelle `tbl_lnkTimeperiodToTimeperiod`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_logbook`
-- 

DROP TABLE IF EXISTS `tbl_logbook`;
CREATE TABLE `tbl_logbook` (
  `id` bigint(20) NOT NULL auto_increment,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user` varchar(255) NOT NULL,
  `ipadress` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `entry` tinytext character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_logbook`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_mainmenu`
-- 

DROP TABLE IF EXISTS `tbl_mainmenu`;
CREATE TABLE `tbl_mainmenu` (
  `id` tinyint(4) NOT NULL auto_increment,
  `order_id` tinyint(4) NOT NULL default '0',
  `menu_id` tinyint(4) NOT NULL default '0',
  `item` varchar(20) NOT NULL default '',
  `link` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Daten f�r Tabelle `tbl_mainmenu`
-- 

INSERT INTO `tbl_mainmenu` (`id`, `order_id`, `menu_id`, `item`, `link`) VALUES (1, 1, 2, 'Main page', 'admin.php');
INSERT INTO `tbl_mainmenu` (`id`, `order_id`, `menu_id`, `item`, `link`) VALUES (2, 2, 2, 'Supervision', 'admin/monitoring.php');
INSERT INTO `tbl_mainmenu` (`id`, `order_id`, `menu_id`, `item`, `link`) VALUES (3, 3, 2, 'Alarming', 'admin/alarming.php');
INSERT INTO `tbl_mainmenu` (`id`, `order_id`, `menu_id`, `item`, `link`) VALUES (4, 4, 2, 'Commands', 'admin/commands.php');
INSERT INTO `tbl_mainmenu` (`id`, `order_id`, `menu_id`, `item`, `link`) VALUES (5, 5, 2, 'Specialties', 'admin/specials.php');
INSERT INTO `tbl_mainmenu` (`id`, `order_id`, `menu_id`, `item`, `link`) VALUES (6, 6, 2, 'Tools', 'admin/tools.php');
INSERT INTO `tbl_mainmenu` (`id`, `order_id`, `menu_id`, `item`, `link`) VALUES (7, 7, 2, 'Administration', 'admin/administration.php');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_service`
-- 

DROP TABLE IF EXISTS `tbl_service`;
CREATE TABLE `tbl_service` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_name` varchar(255) NOT NULL,
  `host_name` tinyint(3) unsigned NOT NULL default '0',
  `host_name_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `hostgroup_name_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `service_description` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `servicegroups` tinyint(3) unsigned NOT NULL default '0',
  `servicegroups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `use_template` tinyint(3) unsigned NOT NULL default '0',
  `use_template_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `check_command` text NOT NULL,
  `is_volatile` tinyint(3) unsigned NOT NULL default '2',
  `initial_state` varchar(20) NOT NULL,
  `max_check_attempts` int(11) default NULL,
  `check_interval` int(11) default NULL,
  `retry_interval` int(11) default NULL,
  `active_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `passive_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `check_period` int(11) NOT NULL default '0',
  `parallelize_check` tinyint(3) unsigned NOT NULL default '2',
  `obsess_over_service` tinyint(3) unsigned NOT NULL default '2',
  `check_freshness` tinyint(3) unsigned NOT NULL default '2',
  `freshness_threshold` int(11) default NULL,
  `event_handler` int(11) NOT NULL default '0',
  `event_handler_enabled` tinyint(3) unsigned NOT NULL default '2',
  `low_flap_threshold` int(11) default NULL,
  `high_flap_threshold` int(11) default NULL,
  `flap_detection_enabled` tinyint(3) unsigned NOT NULL default '2',
  `flap_detection_options` varchar(20) NOT NULL,
  `process_perf_data` tinyint(3) unsigned NOT NULL default '2',
  `retain_status_information` tinyint(3) unsigned NOT NULL default '2',
  `retain_nonstatus_information` tinyint(3) unsigned NOT NULL default '2',
  `notification_interval` int(11) default NULL,
  `first_notification_delay` int(11) default NULL,
  `notification_period` int(11) NOT NULL default '0',
  `notification_options` varchar(20) NOT NULL,
  `notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `contacts` tinyint(3) unsigned NOT NULL default '0',
  `contacts_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `contact_groups` tinyint(3) unsigned NOT NULL default '0',
  `contact_groups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `stalking_options` varchar(20) NOT NULL default '',
  `notes` varchar(255) NOT NULL,
  `notes_url` varchar(255) NOT NULL,
  `action_url` varchar(255) NOT NULL,
  `icon_image` varchar(255) NOT NULL,
  `icon_image_alt` varchar(255) NOT NULL,
  `use_variables` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_service`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_servicedependency`
-- 

DROP TABLE IF EXISTS `tbl_servicedependency`;
CREATE TABLE `tbl_servicedependency` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_name` varchar(255) NOT NULL,
  `dependent_host_name` tinyint(3) unsigned NOT NULL default '0',
  `dependent_hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `dependent_service_description` tinyint(3) unsigned NOT NULL default '0',
  `host_name` tinyint(3) unsigned NOT NULL default '0',
  `hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `service_description` tinyint(3) unsigned NOT NULL default '0',
  `inherits_parent` tinyint(3) unsigned NOT NULL default '0',
  `execution_failure_criteria` varchar(20) default '',
  `notification_failure_criteria` varchar(20) default '',
  `dependency_period` int(11) NOT NULL default '0',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`config_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_servicedependency`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_serviceescalation`
-- 

DROP TABLE IF EXISTS `tbl_serviceescalation`;
CREATE TABLE `tbl_serviceescalation` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_name` varchar(255) NOT NULL,
  `host_name` tinyint(3) unsigned NOT NULL default '0',
  `hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `service_description` tinyint(3) unsigned NOT NULL default '0',
  `contacts` tinyint(3) unsigned NOT NULL default '0',
  `contact_groups` tinyint(3) unsigned NOT NULL default '0',
  `first_notification` int(11) default NULL,
  `last_notification` int(11) default NULL,
  `notification_interval` int(11) default NULL,
  `escalation_period` int(11) NOT NULL default '0',
  `escalation_options` varchar(20) default '',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `config_name` (`config_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_serviceescalation`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_serviceextinfo`
-- 

DROP TABLE IF EXISTS `tbl_serviceextinfo`;
CREATE TABLE `tbl_serviceextinfo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `host_name` int(11) DEFAULT NULL,
  `service_description` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `notes_url` varchar(255) NOT NULL,
  `action_url` varchar(255) NOT NULL,
  `statistic_url` varchar(255) NOT NULL,
  `icon_image` varchar(255) NOT NULL,
  `icon_image_alt` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`host_name`,`service_description`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_serviceextinfo`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_servicegroup`
-- 

DROP TABLE IF EXISTS `tbl_servicegroup`;
CREATE TABLE `tbl_servicegroup` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `servicegroup_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `members` tinyint(3) unsigned NOT NULL default '0',
  `servicegroup_members` tinyint(3) unsigned NOT NULL default '0',
  `notes` varchar(255) default NULL,
  `notes_url` varchar(255) default NULL,
  `action_url` varchar(255) default NULL,
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`servicegroup_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_servicegroup`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_servicetemplate`
-- 

DROP TABLE IF EXISTS `tbl_servicetemplate`;
CREATE TABLE `tbl_servicetemplate` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `template_name` varchar(255) NOT NULL,
  `host_name` tinyint(3) unsigned NOT NULL default '0',
  `host_name_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `hostgroup_name` tinyint(3) unsigned NOT NULL default '0',
  `hostgroup_name_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `service_description` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `servicegroups` tinyint(3) unsigned NOT NULL default '0',
  `servicegroups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `use_template` tinyint(3) unsigned NOT NULL default '0',
  `use_template_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `check_command` text NOT NULL,
  `is_volatile` tinyint(3) unsigned NOT NULL default '2',
  `initial_state` varchar(20) NOT NULL,
  `max_check_attempts` int(11) default NULL,
  `check_interval` int(11) default NULL,
  `retry_interval` int(11) default NULL,
  `active_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `passive_checks_enabled` tinyint(3) unsigned NOT NULL default '2',
  `check_period` int(11) NOT NULL default '0',
  `parallelize_check` tinyint(3) unsigned NOT NULL default '2',
  `obsess_over_service` tinyint(3) unsigned NOT NULL default '2',
  `check_freshness` tinyint(3) unsigned NOT NULL default '2',
  `freshness_threshold` int(11) default NULL,
  `event_handler` int(11) NOT NULL default '0',
  `event_handler_enabled` tinyint(3) unsigned NOT NULL default '2',
  `low_flap_threshold` int(11) default NULL,
  `high_flap_threshold` int(11) default NULL,
  `flap_detection_enabled` tinyint(3) unsigned NOT NULL default '2',
  `flap_detection_options` varchar(20) NOT NULL,
  `process_perf_data` tinyint(3) unsigned NOT NULL default '2',
  `retain_status_information` tinyint(3) unsigned NOT NULL default '2',
  `retain_nonstatus_information` tinyint(3) unsigned NOT NULL default '2',
  `notification_interval` int(11) default NULL,
  `first_notification_delay` int(11) default NULL,
  `notification_period` int(11) NOT NULL default '0',
  `notification_options` varchar(20) NOT NULL,
  `notifications_enabled` tinyint(3) unsigned NOT NULL default '2',
  `contacts` tinyint(3) unsigned NOT NULL default '0',
  `contacts_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `contact_groups` tinyint(3) unsigned NOT NULL default '0',
  `contact_groups_tploptions` tinyint(3) unsigned NOT NULL default '2',
  `stalking_options` varchar(20) NOT NULL default '',
  `notes` varchar(255) NOT NULL,
  `notes_url` varchar(255) NOT NULL,
  `action_url` varchar(255) NOT NULL,
  `icon_image` varchar(255) NOT NULL,
  `icon_image_alt` varchar(255) NOT NULL,
  `use_variables` tinyint(3) unsigned NOT NULL default '0',
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `config_name` (`template_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_servicetemplate`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_submenu`
-- 

DROP TABLE IF EXISTS `tbl_submenu`;
CREATE TABLE `tbl_submenu` (
  `id` tinyint(4) NOT NULL auto_increment,
  `id_main` tinyint(4) NOT NULL default '0',
  `order_id` tinyint(4) NOT NULL default '0',
  `item` varchar(20) NOT NULL default '',
  `link` varchar(50) NOT NULL default '',
  `access_rights` varchar(8) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Daten f�r Tabelle `tbl_submenu`
-- 

INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (1, 2, 1, 'Hosts', 'admin/hosts.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (2, 3, 3, 'Time periods', 'admin/timeperiods.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (26, 2, 5, 'Host templates', 'admin/hosttemplates.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (4, 4, 1, 'Definitions', 'admin/checkcommands.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (5, 3, 1, 'Contact data', 'admin/contacts.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (6, 3, 2, 'Contact groups', 'admin/contactgroups.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (7, 2, 2, 'Services', 'admin/services.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (8, 2, 3, 'Host groups', 'admin/hostgroups.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (9, 2, 4, 'Service groups', 'admin/servicegroups.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (10, 5, 4, 'Serv. dependency', 'admin/servicedependencies.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (11, 5, 5, 'Serv. escalation', 'admin/serviceescalations.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (12, 5, 1, 'Host dependency', 'admin/hostdependencies.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (13, 5, 2, 'Host escalation', 'admin/hostescalations.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (14, 5, 3, 'Host ext. info', 'admin/hostextinfo.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (15, 5, 6, 'Serv. ext. info', 'admin/serviceextinfo.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (16, 6, 1, 'Data import', 'admin/import.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (17, 6, 2, 'Delete files', 'admin/delbackup.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (18, 7, 2, 'User admin', 'admin/user.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (19, 6, 5, 'Nagios control', 'admin/verify.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (20, 7, 1, 'New password', 'admin/password.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (21, 7, 5, 'Logbook', 'admin/logbook.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (22, 6, 3, 'Nagios config', 'admin/nagioscfg.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (23, 6, 4, 'CGI config', 'admin/cgicfg.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (24, 7, 3, 'Menu access', 'admin/menuaccess.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (25, 7, 4, 'Domains', 'admin/domain.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (27, 2, 6, 'Service templates', 'admin/servicetemplates.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (28, 3, 4, 'Contact templates', 'admin/contacttemplates.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (29, 7, 6, 'Settings', 'admin/settings.php', '00000000');
INSERT INTO `tbl_submenu` (`id`, `id_main`, `order_id`, `item`, `link`, `access_rights`) VALUES (30, 7, 7, 'Help editor', 'admin/helpedit.php', '00000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_timedefinition`
-- 

DROP TABLE IF EXISTS `tbl_timedefinition`;
CREATE TABLE `tbl_timedefinition` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tipId` int(10) unsigned NOT NULL,
  `definition` varchar(255) NOT NULL,
  `range` TEXT NOT NULL,
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_timedefinition`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_timeperiod`
-- 

DROP TABLE IF EXISTS `tbl_timeperiod`;
CREATE TABLE `tbl_timeperiod` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `timeperiod_name` varchar(255) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `exclude` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL default '1',
  `last_modified` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `access_rights` varchar(8) default NULL,
  `config_id` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `timeperiod_name` (`timeperiod_name`,`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_timeperiod`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_user`
-- 

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_rights` varchar(8) default NULL,
  `wsauth` enum('0','1') NOT NULL default '0',
  `active` enum('0','1') NOT NULL default '0',
  `nodelete` enum('0','1') NOT NULL default '0',
  `last_login` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `last_modified` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `tbl_variabledefinition`
-- 

DROP TABLE IF EXISTS `tbl_variabledefinition`;
CREATE TABLE `tbl_variabledefinition` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `last_modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Daten f�r Tabelle `tbl_variabledefinition`
-- 

--
-- Tabellenstruktur f�r Tabelle `tbl_settings`
--

DROP TABLE IF EXISTS `tbl_settings`;
CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `category` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten f�r Tabelle `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `category`, `name`, `value`) VALUES ('', 'db', 'version', '3.0.3');