
ALTER TABLE xi_users ADD COLUMN api_key character varying(128);
ALTER TABLE xi_users ADD COLUMN api_enabled smallint DEFAULT 0::smallint NOT NULL;

UPDATE xi_users SET api_enabled = 1, api_key = backend_ticket;

-- Account security features
ALTER TABLE xi_users ADD COLUMN login_attempts smallint DEFAULT 0::smallint NOT NULL;
ALTER TABLE xi_users ADD COLUMN last_attempt integer DEFAULT 0::integer NOT NUll;
ALTER TABLE xi_users ADD COLUMN last_password_change integer DEFAULT 0::integer NOT NULL;

-- Security information
ALTER TABLE xi_users ADD COLUMN last_login integer DEFAULT 0::integer NOT NUll;
ALTER TABLE xi_users ADD COLUMN last_edited integer DEFAULT 0::integer NOT NUll;
ALTER TABLE xi_users ADD COLUMN last_edited_by integer DEFAULT 0::integer NOT NUll;
ALTER TABLE xi_users ADD COLUMN created_by integer DEFAULT 0::integer NOT NUll;
ALTER TABLE xi_users ADD COLUMN created_time integer DEFAULT 0::integer NOT NUll;

-- Event queue sequence
CREATE SEQUENCE xi_eventqueue_eventqueue_id_seq
	INCREMENT BY 1
	NO MAXVALUE
	NO MINVALUE
	CACHE 1;

-- Event queue table
CREATE TABLE xi_eventqueue (
    eventqueue_id integer DEFAULT nextval('xi_eventqueue_eventqueue_id_seq'::regclass) NOT NULL,
    event_time integer,
    event_source smallint,
    event_type smallint DEFAULT 0 NOT NULL,
    event_meta text
);