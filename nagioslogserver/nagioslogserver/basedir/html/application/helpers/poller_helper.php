<?php

/* DO NOT REMOVE THIS LINE! sourceguardian-check */

/**
 *  functions that can be called from cmdsubsys
 **/
 
/************************************************
	POLLER FUNCTIONS 
*************************************************/ 
/**
 * updates the cluster_host file
 **/
function update_cluster_hosts()
{
    $ci =& get_instance();
    
    $hosts_file = $ci->config->item('hosts_file');
    if (!is_writable($hosts_file)) {
        echo "$hosts_file is not writeable, check file permissions";
        exit(1);
    }
    $es = new ElasticSearch(array('index' => '/'));
    $cluster = $es->backend_call('_cluster/state/version,master_node,nodes');

    // Check if we have valid return
    if(is_array($cluster['nodes'])) {
    
        $ips = file($hosts_file);
        
        foreach($cluster['nodes'] as $key => $value) {
            if ($value['attributes']['client'])
                continue;
            // Convert to readable IP/Port
            $ip_port = split_inet_string($value['transport_address']);
            $ips[] = $ip_port['ip'];
        }

        $ips = array_map('trim',$ips);
        
        $new_ip_list = array_unique($ips);
        $new_ip_list = implode("\n", $new_ip_list);

        file_put_contents($hosts_file, $new_ip_list);
    } else {
        echo _('ERROR: Connection to elasticsearch cannot be made')."\n";
        return false;
    }
}

/**
 * Updates this node in the elasticsearch db
 **/
function update_elasticsearch_nodes()
{
    $es_type = 'node';
    $ci =& get_instance();
    $ci->load->model('systemstat');
    $ci->load->helper('licensing_helper');
    $es = new ElasticSearch();
    $es_root = new ElasticSearch(array("index" => "/"));
    
    $node_data = array("last_updated" => time(),
                       "ls_version" => get_product_version(),
                       "ls_release" => get_product_release(),
                       "elasticsearch" => $ci->systemstat->status('elasticsearch'),
                       "logstash" => $ci->systemstat->status('logstash'));

    // Get the proper ip address of the node... and then get hostname if exists
    $stats = $es_root->backend_call('_nodes/'.NODE.'/stats/?human');
    
    if(!is_array($stats['nodes'])){
        echo _('ERROR: Connection to elasticsearch cannot be made')."\n";
        return false;
    }
    
    $node_stats = reset($stats['nodes']);
    $p = split_inet_string($node_stats['transport_address']);
    $hostname = gethostbyaddr($p['ip']);
    $node_data['address'] = $p['ip'];

    if (!empty($hostname)) {
        $node_data['hostname'] = $hostname;
    }

    // Check if node already exists in the database
    $result = $es->get($es_type, NODE);
    if (empty($result['found'])) {
        // Doesn't exist.. so let's add it...
        $es->add($es_type, $node_data, NODE);
        
        $log = array('type' => 'POLLER',
                     'message' => _('New instance added to Nagios Log Server'),
                     'node' => NODE
                    );
        $logged = $ci->logger->log($log);
        
    } else {
        // Does exist... let's update it
        $es->update($es_type, $node_data, NODE);
    }
}
