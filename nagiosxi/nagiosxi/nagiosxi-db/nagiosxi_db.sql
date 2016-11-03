
# Create "nagiosxi" default database schema

CREATE DATABASE `nagiosxi`;
CREATE USER 'nagiosxi'@'localhost' IDENTIFIED BY 'n@gweb';
GRANT ALL ON nagiosxi.* TO 'nagiosxi'@'localhost';
USE `nagiosxi`;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_auditlog` (
    `auditlog_id` int auto_increment,
    `log_time` timestamp,
    `source` text,
    `user` varchar(200),
    `type` int,
    `message` text,
    `ip_address` varchar(45),
    `details` text,
    primary key (`auditlog_id`),
    index using btree (`log_time`),
    index using btree (`user`),
    index using btree (`type`),
    index using btree (`ip_address`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_commands` (
    `command_id` int auto_increment,
    `group_id` int default 0,
    `submitter_id` int default 0,
    `beneficiary_id` int default 0,
    `command` int NOT NULL,
    `submission_time` timestamp not null,
    `event_time` timestamp not null,
    `frequency_type` int default 0,
    `frequency_units` int default 0,
    `frequency_interval` int default 0,
    `processing_time` timestamp,
    `status_code` int default 0,
    `result_code` int default 0,
    `command_data` text,
    `result` text,
    primary key (`command_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_events` (
    `event_id` int auto_increment,
    `event_time` timestamp,
    `event_source` smallint,
    `event_type` smallint default 0 not null,
    `status_code` smallint default 0 not null,
    `processing_time` timestamp,
    primary key (`event_id`),
    index using btree (`event_source`),
    index using btree (`event_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_meta` (
    `meta_id` int auto_increment,
    `metatype_id` int default 0,
    `metaobj_id` int default 0,
    `keyname` varchar(128) not null,
    `keyvalue` text,
    primary key (`meta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_options` (
    `option_id` int auto_increment,
    `name` varchar(128) not null,
    `value` text,
    primary key (`option_id`),
    index using btree (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_sysstat` (
    `sysstat_id` int auto_increment,
    `metric` varchar(128) not null,
    `value` text,
    `update_time` timestamp not null,
    primary key (`sysstat_id`),
    index using btree (`metric`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_usermeta` (
    `usermeta_id` int auto_increment,
    `user_id` int not null,
    `keyname` varchar(255) not null,
    `keyvalue` longtext,
    `autoload` smallint default 0,
    primary key (`usermeta_id`),
    index using btree (`autoload`),
    constraint `user_unique_key` unique (`user_id`, `keyname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_users` (
    `user_id` int auto_increment,
    `username` varchar(64) not null,
    `password` varchar(128) not null,
    `name` varchar(100),
    `email` varchar(128) not null,
    `backend_ticket` varchar(128),
    `enabled` smallint default 1,
    primary key (`user_id`),
    unique(`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_eventqueue` (
    `eventqueue_id` int auto_increment,
    `event_time` timestamp,
    `event_source` smallint,
    `event_type` smallint default 0 not null,
    `event_meta` text,
    primary key (`eventqueue_id`),
    unique(`eventqueue_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;