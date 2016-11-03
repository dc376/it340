<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Alerts extends LS_Controller
{
    function __construct()
    {
        parent::__construct();

        // Make sure that user is authenticated no matter what page they are on
        if (!$this->users->logged_in()){
            $this->users->redirect_to_login(); // make them log in
        }

        $this->page = "alerts";
        $this->load->model('alert');
    }

    public function index()
    {
        $this->init_page(_("Alerting"), $this->page);

        $query = '';
        if ($this->input->post('search')) {
            $search = $this->input->post('search');
            $query = 'name:'.$search.'*~';
            $this->data['search'] = $search;
        }

        if (!is_admin()) {
            if (!empty($query)) { $query .= " AND "; }
            $username = $this->session->userdata('username');
            $query .= 'created_by:'.$username;
        }

        $this->data['alerts'] = $this->alert->get_all($query);

        $this->data['leftbar'] = $this->load->view('alerts/leftbar', array("tab" => "alerts"), true);
        $this->load->view('alerts/home', $this->data);
    }

    public function run($id='')
    {
        if (empty($id)) { redirect('alerts'); }

        // Run the alert and then redirect
        $this->load->model('alert');
        $this->alert->run($id);

        redirect('alerts');
    }
        
    /**
     * Show alert in dashboard
     */
    public function show($id='')
    {
        if (empty($id)) { redirect('alerts'); }
        
        $s_to = grab_request_var('s_to', "");
        $s_from = grab_request_var('s_from', "");
        
        // Get the data from ES index based on $id
        $result = $this->elasticsearch->get('alert', $id);
        $dash_query = $result['_source']['dash_query'];
        $lookback_period = $result['_source']['lookback_period'];
        
        $url = 'dashboard#/dashboard/script/logserver.js?from='.urlencode($lookback_period).'&services='.rawurlencode($dash_query);
        
        if ($s_to != "")
            $url .= "&s_to=" . $s_to;
        if ($s_from != "")
            $url .= "&s_from=" . $s_from;
        
        redirect($url);

    }

    public function show_query($id='')
    {
        if (empty($id)) { redirect('alerts'); }

        // Get the data from the ES index
        $result = $this->elasticsearch->get('query', $id);
        $dash_query = $result['_source']['services'];
        redirect('dashboard#/dashboard/script/logserver.js?services='.rawurlencode($dash_query));
    }

    public function deactivate($id='')
    {
        if (empty($id)) { redirect('alerts'); } 

        // Deactivate the alert
        $data = array("active" => 0);
        $this->elasticsearch->update('alert', $data, $id);
        $this->elasticsearch->refresh();

        redirect('alerts');
    }

    public function activate($id='')
    {
        if (empty($id)) { redirect('alerts'); }

        // Deactivate the alert
        $data = array("active" => 1);
        $this->elasticsearch->update('alert', $data, $id);
        $this->elasticsearch->refresh();

        redirect('alerts');
    }

    // Displays the NRDP Servers page, allowing users to manage their NRDP servers
    // which includes Nagios XI and Nagios Core
    public function nrdp()
    {
        $this->init_page(_("Nagios Servers (NRDP)"), $this->page);

        // Get a list of all alerts that have host/service associations
        $saved = array();
        $alerts = $this->alert->get_all();
        foreach ($alerts as $alert) {
            if ($alert['method']['type'] == "nrdp") {
                $server = $this->elasticsearch->get('nrdp_server', $alert['method']['server_id']);
                $alert['method']['server_name'] = $server['_source']['name'];
                $saved[] = $alert;
            }
        }
        $this->data['alerts'] = $saved;

        $this->data['leftbar'] = $this->load->view('alerts/leftbar', array("tab" => "nrdp"), true);
        $this->load->view('alerts/nrdp', $this->data);
    }

    // Displays SNMP trap receivers management page
    public function snmp()
    {
        $this->init_page(_("SNMP Trap Receivers"), $this->page);

        $this->data['leftbar'] = $this->load->view('alerts/leftbar', array("tab" => "snmp"), true);
        $this->load->view('alerts/snmp', $this->data);
    }

    // Display the linking of Nagios Reactor servers
    public function reactor()
    {
        $this->init_page(_("Nagios Reactor Servers"), $this->page);

        $this->data['leftbar'] = $this->load->view('alerts/leftbar', array("tab" => "reactor"), true);
        $this->load->view('alerts/reactor', $this->data);
    }

    public function delete($id='')
    {
        if (empty($id)) { redirect('alerts'); }

        // Delete the check from the database
        $result = $this->elasticsearch->delete('alert', $id);
        $this->elasticsearch->refresh();

        redirect('alerts');
    }

    //
    // Alert Email Templates
    //

    public function templates()
    {
        $this->init_page(_('Email Templates'), $this->page);

        // Grab the current default email template
        $dtpl = get_default_email_tpl();
        $this->data['default_template'] = $dtpl['name'];
        $this->data['default_template_subject'] = $dtpl['subject'];
        $this->data['default_template_body'] = $dtpl['body'];

        $this->data['success'] = $this->session->flashdata('msg');
        $this->data['leftbar'] = $this->load->view('alerts/leftbar', array("tab" => "templates"), true);
        $this->load->view('alerts/templates', $this->data);
    }

}