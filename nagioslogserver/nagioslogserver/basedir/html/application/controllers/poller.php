<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Poller extends LS_Controller {
    
    function __construct()
    {
        parent::__construct();
        if(!$this->input->is_cli_request()) {
            show_404();
        }
        $this->load->helper('poller');
    }

    /***************************************
     * CLUSTER MANAGEMENT
     ***************************************/

    /*
      Place jobs you want to run every $sleep_time in process_jobs
      in exec_job you pass the CI controller, method and an 
      optional string of additional args that are passed to the method
      
      If you have multiple string args they should be passed as an array 
    */
    function process_jobs()
    {
        if ($this->logging) { echo "Updating Cluster Hosts File\n"; }
        update_cluster_hosts();

        if ($this->logging) { echo "Updating Elasticsearch with instance...\n"; }
        update_elasticsearch_nodes();
    }
    
    function index()
    {
        if(install_needed())
            die();
        $max_time = 50;
        $sleep_time = 15; // in seconds
        $this->logging = 1;
        $start_time = time(); 
        $node=NODE;

        while(1) {

            // bail if if we're been here too long
            $now = time();
            if (($now-$start_time) > $max_time)
                break;
                
            $this->process_jobs();

            usleep($sleep_time*1000000);
        }

        if ($this->logging) {
            echo "Finished Polling.\n";
        }
    }
}