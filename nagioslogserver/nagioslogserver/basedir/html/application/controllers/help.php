<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends LS_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->page = 'help';

        // Make sure that user is authenticated no matter what page they are on
        require_install();
        if (!$this->users->logged_in()) { redirect('login'); }
    }

    // Main help section
    public function index()
    {
    	$this->init_page(_("Help"), $this->page);

        $this->data['leftbar'] = $this->load->view('help/leftbar', array("tab" => "system"), true);
    	$this->load->view('help/home', $this->data);
    }

    public function elastic_log()
    {
        $this->init_page(_("Elastic Search and Logstash"), $this->page);

        $this->data['leftbar'] = $this->load->view('help/leftbar', array("tab" => "elastic_log"), true);
        $this->load->view('help/elastic_log', $this->data);
    }

}
