<?php

/* DO NOT REMOVE THIS LINE! sourceguardian-check */

/**
*  functions that can be called from cmdsubsys
**/

/************************************************
	CMDSUBS FUNCTIONS 
*************************************************/ 

/**
 * Run an update check in the background
 */
function update_check($args=array())
{
    // Run an update check with no caching (send a real request and place it in the config options)
    do_update_check(false);
}

/**
 * Start logstash or elasticsearch
 **/
function start_service($args=array())
{
    $ci =& get_instance();
    $ci->load->model('Systemstat');
    $subsystem = $args[0];
    
    $log = array('type' => 'JOBS',
                 'message' => $subsystem . _(' is being started'),
                 'node' => NODE
                );
    $logged = $ci->logger->log($log);
    
    return json_encode($ci->Systemstat->start($subsystem));
}

/**
 * Stop logstash or elasticsearch
 **/
function stop_service($args=array())
{
    $ci =& get_instance();
    $ci->load->model('Systemstat');
    $subsystem = $args[0];
    
    $log = array('type' => 'JOBS',
                 'message' => $subsystem . _(' is being stopped'),
                 'node' => NODE
                );
    $logged = $ci->logger->log($log);
    
    return json_encode($ci->Systemstat->stop($subsystem));
}

/**
 * Retart logstash or elasticsearch
 **/
function restart_service($args=array())
{
    $ci =& get_instance();
    $ci->load->model('Systemstat');
    $subsystem = $args[0];
    
    $log = array('type' => 'JOBS',
                 'message' => $subsystem . _(' is being restarted'),
                 'node' => NODE
                );
    $logged = $ci->logger->log($log);
    
    return json_encode($ci->Systemstat->restart($subsystem));
}

/************************************************
    CLEANUP FUNCTIONS
*************************************************/ 

/**
 * Clean up the cmdsubsys commands
 */
function cleanup()
{
    $ci =& get_instance();
    $time = time() - 24*60*60; // Keep the 
    $result = $ci->elasticsearch->query('commands', "status:completed AND run_time:<$time");
    if ($result['hits']['total'] > 0) {
        $commands = $result['hits']['hits'];
        foreach ($commands as $cmd) {
            $ci->elasticsearch->delete('commands', $cmd['_id']);
        }
        
        $log = array('type' => 'JOBS',
                    'message' => count($commands) . " " . _('jobs removed that were completed jobs more than 24 hours old')
        );
        $logged = $ci->logger->log($log);
    }
}

/************************************************
	BACKUP / MAINTENANCE FUNCTIONS 
*************************************************/ 

/**
 * Run maintance jobs
 **/
function do_maintenance($args=array())
{
    $ci =& get_instance();
    
    $maintenance_settings = unserialize(get_option('maintenance_settings', array()));
    if(empty($maintenance_settings)){
        set_option('maintenance_settings', serialize(array('active', 1,
                                                           'optimize_time' => 2, 
                                                           'bloom_time' => 1, 
                                                           'close_time' => 15,
                                                           'delete_time' => 30
                                                           )));
        $maintenance_settings = get_option('maintenance_settings');
    }
    
    if(!$maintenance_settings['active'])
        return _('Maintenance and Backup jobs are disabled');
    
    // Depricated in ES > 1.4.0
    //if($maintenance_settings['bloom_time'])
    //    do_maintenance_bloom($maintenance_settings['bloom_time']);

    if($maintenance_settings['optimize_time'])
        do_maintenance_optimize($maintenance_settings['optimize_time']);
    if (!empty($maintenance_settings['repository']))
        do_maintenance_create_snapshot($maintenance_settings['repository']);
    if ($maintenance_settings['delete_snapshot_time'] && !empty($maintenance_settings['repository'])) {
        do_maintenance_delete_snapshot($maintenance_settings['delete_snapshot_time'], $maintenance_settings['repository']);
    }  
    if($maintenance_settings['close_time'])
        do_maintenance_close($maintenance_settings['close_time']);
    if($maintenance_settings['delete_time'])
        do_maintenance_delete($maintenance_settings['delete_time']);
    
    return _('Maintenance and Backup jobs are being executed');
}

/**
 * Disables Bloom Filter Cache on indexes older than $bloom_time
 **/
function do_maintenance_bloom($bloom_time)
{
    $ci =& get_instance();
    
    $cmd = $ci->config->item('scripts_dir') . "/curator.sh bloom indices --older-than ".$bloom_time." --time-unit days --timestring %Y.%m.%d";
    exec($cmd . "");
    
    $msg = _('Disabling Bloom Filter Cache on indexes ') . $bloom_time . _(' day(s) old.');
    
    $log = array('type' => 'MAINTENANCE',
                 'message' => $msg
    );
    $logged = $ci->logger->log($log);
    
    return $msg;
}

/**
 * Optimizing indexes older than $optimize_time
 **/
function do_maintenance_optimize($optimize_time)
{
    $ci =& get_instance();
    $backend_dir = $ci->config->item('backend_dir');

    $cmd = $ci->config->item('scripts_dir') . "/curator.sh optimize indices --older-than ".$optimize_time." --time-unit days --timestring %Y.%m.%d";
    exec($cmd , $output, $return_var);
    file_put_contents($backend_dir."/var/jobs.log", $output, FILE_APPEND);
    $msg = _('Optimizing indexes ') . $optimize_time . _(' day(s) old.');
    
    $log = array('type' => 'MAINTENANCE',
                 'message' => $msg
    );
    $logged = $ci->logger->log($log);
    
    return $msg;
}
/**
 * Closing indexes older than $close_time
 **/
function do_maintenance_close($close_time)
{
    $ci =& get_instance();
    $backend_dir = $ci->config->item('backend_dir');

    $cmd = $ci->config->item('scripts_dir') . "/curator.sh close indices --older-than ".$close_time." --time-unit days --timestring %Y.%m.%d";
    exec($cmd , $output, $return_var);
    file_put_contents($backend_dir."/var/jobs.log", $output, FILE_APPEND);
    
    $msg = _('Closing indexes ') . $close_time . _(' day(s) old.');
    
    $log = array('type' => 'MAINTENANCE',
                 'message' => $msg
    );
    $logged = $ci->logger->log($log);
    
    return $msg;
    
}
/**
 * Delete indexes older than $delete_time
 **/
function do_maintenance_delete($delete_time)
{
    $ci =& get_instance();
    $backend_dir = $ci->config->item('backend_dir');

    $cmd = $ci->config->item('scripts_dir') . "/curator.sh delete indices --older-than ".$delete_time." --time-unit days --timestring %Y.%m.%d";
    exec($cmd , $output, $return_var);
    file_put_contents($backend_dir."/var/jobs.log", $output, FILE_APPEND);
    
    $msg = _('Deleting indexes more than ') . $delete_time . _(' day(s) old.');
    $log = array('type' => 'MAINTENANCE',
                 'message' => $msg
    );
    $logged = $ci->logger->log($log);
    
    return $msg;
    
}
/**
 * Delete snapshots more than than $delete_snapshot_time
 **/
function do_maintenance_delete_snapshot($delete_snapshot_time, $repository)
{
    $ci =& get_instance();
    $backend_dir = $ci->config->item('backend_dir');

    $cmd = $ci->config->item('scripts_dir') . "/curator.sh delete snapshots --older-than " . $delete_snapshot_time . ' --time-unit days --timestring %Y%m%d --repository "' . $repository . '"';
    exec($cmd , $output, $return_var);
    file_put_contents($backend_dir."/var/jobs.log", $output, FILE_APPEND);
    
    $msg = _('Deleting snapshots more than ') . $delete_snapshot_time . _(' day(s) old from ' . $repository);
    $log = array('type' => 'MAINTENANCE',
                 'message' => $msg
    );
    $logged = $ci->logger->log($log);
    
    return $msg;
}

/**
 * Create snapshots in $repository
 **/
function do_maintenance_create_snapshot($repository)
{
    $ci =& get_instance();
    $backend_dir = $ci->config->item('backend_dir');
    
    $cmd = $ci->config->item('scripts_dir') . '/curator.sh snapshot --repository "' . $repository . '" indices --older-than 1 --time-unit days --timestring %Y.%m.%d';
    exec($cmd , $output, $return_var);
    file_put_contents($backend_dir."/var/jobs.log", $output, FILE_APPEND);
    
    $msg = _('Creating snapshots for indexes more than 1 day old in the repository ' . $repository);
    
    $log = array('type' => 'BACKUP',
                 'message' => $msg
    );
    $logged = $ci->logger->log($log);
    
    return $msg;
}


/************************************************
    CONFIGURATION FUNCTIONS
*************************************************/

/**
* Apply the configuration to the node...
**/
function apply_config($args=array())
{
    $ci =& get_instance();
    $ci->load->model('ls_configure');

    // Create a new snapshot before we apply
    if (!empty($args)) {
        $ci->ls_configure->create_snapshot($args['sh_id'], $args['sh_created'], "applyconfig.snapshot");
    }

    // Apply the configuration
    $result = $ci->ls_configure->apply(NODE);
    
    if ($result){
        $return = "success";
        $message = _("New configuration was applied.");
    } else {
        $return = "failed";
        $message = _("New configuration failed to apply.");
    }
    
    $log = array('type' => 'CONFIG',
                 'message' => $message,
                 'node' => NODE
    );
    $logged = $ci->logger->log($log);
    
    return $return;
}

/**
 * Create a snapshot on the node
 **/
function create_snapshot($args=array())
{
    $ci =& get_instance();
    $ci->load->model('ls_configure');
    $ci->ls_configure->create_snapshot($args['id'], $args['created']);
    
    $log = array('type' => 'CONFIG',
                 'message' => _("New configuration snapshot was created."),
                 'node' => NODE
    );
    $logged = $ci->logger->log($log);
    
}

/**
 * Deletes a snapshot
 */
function delete_snapshot($args=array())
{
    $ci =& get_instance();
    $ci->load->model('ls_configure');
    $ci->ls_configure->delete_snapshot($args['path']);
    
    $log = array('type' => 'CONFIG',
                 'message' => _("Configuration snapshot was deleted from ". $args['path']),
                 'node' => NODE
    );
    $logged = $ci->logger->log($log);
}

/**
 * Restores a snapshot on the node
 **/
function restore_snapshot($args=array())
{
    $ci =& get_instance();
    $ci->load->model('ls_configure');
    $ci->ls_configure->restore_snapshot($args['id']);
    
    $log = array('type' => 'CONFIG',
                 'message' => _("Configuration snapshot was restored from "). $args['id'],
                 'node' => NODE
    );
    $logged = $ci->logger->log($log);
}

/************************************************
    SYSTEM BACKUPS
*************************************************/

function do_backups($args=array())
{
    $ci =& get_instance();
    $ci->load->model('cmdsubsys');
    $backup_rotation = get_option('backup_rotation');

    if ($backup_rotation > 0) {
        $result = $ci->elasticsearch->query('node', array("size" => 2000));
        foreach ($result['hits']['hits'] as $node) {
            if ($node['_id'] == "global") { continue; }
            $data = array("command" => 'create_backup', "node" => $node['_id'], "args" => '');
            $job = $ci->cmdsubsys->create($data);
        }
    }
}

// Ran per-node to create a new backup on the specified node
function create_backup($args=array())
{
    $ci =& get_instance();
    $scripts_dir = $ci->config->item('scripts_dir');

    // Run the create backup script...
    exec($scripts_dir.'/create_backup.sh > /tmp/backups.log');

    // Remove any backups that need to be trimmed
    $backup_rotation = get_option('backup_rotation');
    $backup_dir = '/store/backups/nagioslogserver';
    $count = file_count($backup_dir);
    if ($count > $backup_rotation) {
        while ($count > $backup_rotation) {
            remove_oldest_file($backup_dir);
            $count--;
        }
    }
return "";
}

// Removes the oldest file in the currently specified directory
function remove_oldest_file($dir)
{
    $oldest_file = '';
    $oldest = time();
    foreach(glob($dir . "/*.tar.gz") as $entry) {
        if (filemtime($entry) < $oldest) {
            $oldest_file = $entry;
            $oldest = filemtime($entry);
        }
        }
    unlink($oldest_file);

    return true;
}

function file_count($dir)
{
    $arr = glob($dir . "/*.tar.gz");
    $count = count($arr);
    return $count;
}


/************************************************
    ALERTING FUNCTIONS
*************************************************/

/**
 * Runs all the alerts that need to be ran
 **/
function run_alerts($args=array())
{
    $ci =& get_instance();
    $ci->load->helper('alert');
    $ci->load->model('alert');
    $alerts = $ci->alert->get_all();

    // Loop through the alerts and actually run them if necessary
    foreach ($alerts as $alert) {
        if (verify_alert_run($alert['id'])) {
            $ci->alert->run($alert['id']);
        }
    }
}

/************************************************
    SYSTEM FUNCTIONS
*************************************************/

/**
 * Runs the change_timezone.sh script
 **/
function change_timezone($args=array())
{
    $ci =& get_instance();
    $scripts_dir = $ci->config->item('scripts_dir');

    $cmd = "sudo $scripts_dir/change_timezone.sh -z '".$args['timezone']."'";
    exec($cmd, $o, $r);

    return true;
}