<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends LS_Controller {
    
	function __construct()
	{
		parent::__construct();
        if(!$this->input->is_cli_request()) {
            show_404();
        }
        $this->load->model('Cmdsubsys');
	}

    /***************************************
     * CLUSTER CMDSUBSYS CRON
    ***************************************/

    function index()
    {
        if(install_needed())
            die();
        $max_time = 50;
        $sleep_time = 5; // in seconds
        $logging = true;
        $start_time = time(); 
        $n_total = 0;
        $g_total = 0;
        $jobs = new Cmdsubsys();
        $jobs->logging = 1; // logging verbosity
        
        while (1) {
            $n = 0;
            $g = 0;

            // bail if if we're been here too long
            $now = time();
            if (($now-$start_time) > $max_time) {
                break;
            }
                
            $n = $jobs->process_jobs(NODE);
            $g = $jobs->process_jobs('global');
            
            if ($n > 0 || $g > 0) {
                $n_total += $n;
                $g_total += $g;
                continue;
            }
            usleep($sleep_time*1000000);
        }
            
        echo "Processed ".$n_total." node jobs.\n";
        echo "Processed ".$g_total." global jobs.\n";
	}

}