USE `nagiosxi`;

ALTER TABLE xi_usermeta MODIFY keyvalue LONGTEXT;

ALTER TABLE xi_users ADD COLUMN api_key varchar(128) NULL;
ALTER TABLE xi_users ADD COLUMN api_enabled smallint DEFAULT 0 NOT NULL;

UPDATE xi_users SET api_enabled = 1, api_key = backend_ticket;

# Account security features
ALTER TABLE xi_users ADD COLUMN login_attempts smallint(6) DEFAULT 0 NOT NULL;
ALTER TABLE xi_users ADD COLUMN last_attempt int(10) DEFAULT 0 NOT NULL;
ALTER TABLE xi_users ADD COLUMN last_password_change int(10) DEFAULT 0 NOT NULL;

# Security information
ALTER TABLE xi_users ADD COLUMN last_login int(11) DEFAULT 0 NOT NULL;
ALTER TABLE xi_users ADD COLUMN last_edited int(11) DEFAULT 0 NOT NULL;
ALTER TABLE xi_users ADD COLUMN last_edited_by int(10) DEFAULT 0 NOT NULL;
ALTER TABLE xi_users ADD COLUMN created_by int(10) DEFAULT 0 NOT NULL;
ALTER TABLE xi_users ADD COLUMN created_time int(11) DEFAULT 0 NOT NULL;

# Event Queue table for more efficient Global Event Handlers
CREATE TABLE IF NOT EXISTS `nagiosxi`.`xi_eventqueue` (
    `eventqueue_id` int auto_increment,
    `event_time` int,
    `event_source` smallint,
    `event_type` smallint default 0 not null,
    `event_meta` text,
    primary key (`eventqueue_id`),
    unique(`eventqueue_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;