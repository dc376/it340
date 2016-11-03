<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends LS_Controller
{
    function __construct()
    {
        parent::__construct();

        // Make sure that user is authenticated no matter what page they are on
        require_install();
        if (!$this->users->logged_in()) { $this->users->redirect_to_login(); }
    }

    // Basic dashboard
    public function index()
    {
        redirect('reports/backup');
    }
    
    // Backup Report
    public function backup()
    {
        redirect('reports/report/backup#/dashboard/file/reports.json?type=BACKUP');
    }
    
    // Maintenance Report
    public function maintenance()
    {
        redirect('reports/report/maintenance#/dashboard/file/reports.json?type=MAINTENANCE');
    }
    
    // Security Report
    public function security()
    {
        redirect('reports/report/security#/dashboard/file/reports.json?type=SECURITY');
    }
    
    // Jobs Report
    public function jobs()
    {
        redirect('reports/report/jobs#/dashboard/file/reports.json?type=JOBS');
    }
    
    // Poller Report
    public function poller()
    {
        redirect('reports/report/poller#/dashboard/file/reports.json?type=POLLER');
    }
    
    // Info Report
    public function info()
    {
        redirect('reports/report/info#/dashboard/file/reports.json?type=INFO');
    }
    
    // Report loader
    public function report($tab="")
    {
        
        $this->init_page(_("Reports"), 'reports');
        
        $this->data['user'] = $this->users->get_user();
        $this->data['leftbar'] = $this->load->view('reports/leftbar', array("tab" => $tab), true);

        $this->load->view('reports/home', $this->data);
    }


}
