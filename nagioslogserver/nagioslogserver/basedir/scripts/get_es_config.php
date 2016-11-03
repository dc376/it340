<?php
//
// Copyright (c) 2008-2014 Nagios Enterprises, LLC.  All rights reserved.
//  

$backenddir = "/usr/local/nagioslogserver";
$node_file="$backenddir/var/node_uuid";
$cluster_file="$backenddir/var/cluster_uuid";
$cluster_hosts_file="$backenddir/var/cluster_hosts";

$output = "";

// get the cluster UUID or create a new one
if (file_exists($cluster_file))
	$cluster_name = str_replace(' ','',trim(file_get_contents("$cluster_file")));
else {
	$cmd = "$backenddir/scripts/generate_uuid.sh -f $cluster_file";
	exec($cmd, $output, $ret);
	$cluster_name = str_replace(' ','',trim(file_get_contents("$cluster_file")));
}

if (file_exists($cluster_hosts_file)){
    // get the last known cluster hosts, this will be updated via cron, default to localhost
	$arr = array_map('trim', array_filter(file($cluster_hosts_file)));
	$known_cluster_hosts = implode(',',$arr);
	
}
if(empty($known_cluster_hosts))
	$known_cluster_hosts = "localhost";

// get the node UUID or create a new one
if (file_exists($node_file))
	$node_uuid = str_replace(' ','',trim(file_get_contents("$node_file")));
else {
	$cmd = "$backenddir/scripts/generate_uuid.sh -f $node_file";
	exec($cmd, $output, $ret);
	$node_uuid = str_replace(' ','',trim(file_get_contents("$node_file")));
}

if (!empty($cluster_name))
	$output = ' -Des.cluster.name='.$cluster_name;
else {
	echo "Cluster UUID not set, check file permissions of";
	echo "$cluster_file";
	exit(1);
}
	
if (!empty($node_uuid))
	$output .= ' -Des.node.name='.$node_uuid;
else {
	echo "NODE UUID not set, check file permissions of";
	echo "$backenddir/var/node_uuid";
	exit(1);
}

$output .= ' -Des.discovery.zen.ping.unicast.hosts='.$known_cluster_hosts;

// Add all possible paths as repos
$output .= ' -Des.path.repo=/';

echo $output;
