<?php
//
// Copyright (c) 2008-2014 Nagios Enterprises, LLC.  All rights reserved.
//  

$backenddir = "/usr/local/nagioslogserver";
$node_file="$backenddir/var/node_uuid";
$cluster_file="$backenddir/var/cluster_uuid";

// get the cluster UUID or create a new one
if (!file_exists($cluster_file)) {
	$cmd = "$backenddir/scripts/generate_uuid.sh -f $cluster_file";
	exec($cmd, $output, $ret);
	$cluster_name = str_replace(' ','',trim(file_get_contents("$cluster_file")));
}

// get the node UUID or create a new one
if (!file_exists($node_file)) {
	$cmd = "$backenddir/scripts/generate_uuid.sh -f $node_file";
	exec($cmd, $output, $ret);
	$node_uuid = str_replace(' ','',trim(file_get_contents("$node_file")));
}

exit(0);
