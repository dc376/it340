<?php 
// Local Configuration Options
// - These options are not overwritten during upgrades

$config['charset'] = 'UTF-8';
$config['dns_server'] = '';

// Make sure this is unique and difficult to guess
$config['encryption_key'] = sha1($_SERVER['HTTP_HOST']);

// Base url of site& media files directory
$config['site_url'] = '//'.$_SERVER['HTTP_HOST'].'/nagioslogserver';
$config['media_url'] = $config['site_url'] .'/media';

// Backend locations
$config['backend_dir'] = '/usr/local/nagioslogserver';
$config['scripts_dir'] = $config['backend_dir'].'/scripts';
$config['node_uuid_file'] = $config['backend_dir'].'/var/node_uuid';
$config['cluster_uuid_file'] = $config['backend_dir'].'/var/cluster_uuid';
$config['hosts_file'] = $config['backend_dir'].'/var/cluster_hosts';

// Backend constants
$node_id = trim(file_get_contents($config['node_uuid_file']));
$cluster_id = trim(file_get_contents($config['cluster_uuid_file']));
define("NODE", $node_id);
define("CLUSTER", $cluster_id);

// User area settings
$config['min_password_length'] = 8;
$config['forgot_password_expiration'] = 0;