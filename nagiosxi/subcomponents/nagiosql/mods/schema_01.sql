
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

CREATE TABLE IF NOT EXISTS `tbl_session` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `session_id` varchar(120) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `type` varchar(255) NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  `started` varchar(20) NOT NULL,
  `last_updated` varchar(20) NOT NULL,
  `active` boolean NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tbl_session_locks`
--

CREATE TABLE IF NOT EXISTS `tbl_session_locks` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sid` int(10) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `obj_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table changes to add exclusion
--

ALTER TABLE tbl_lnkServiceToHost ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkServiceToHostgroup ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkServicetemplateToHost ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkServicetemplateToHostgroup ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkServiceescalationToHost ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkServiceescalationToHostgroup ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkHostescalationToHost ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkHostescalationToHostgroup ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkHostgroupToHost ADD COLUMN exclude boolean NOT NULL;
ALTER TABLE tbl_lnkHostgroupToHostgroup ADD COLUMN exclude boolean NOT NULL;
