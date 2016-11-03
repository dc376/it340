<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends LS_Controller
{
    function __construct()
    {
        parent::__construct();

        // Make sure that user is authenticated no matter what page they are on
        require_install();
        if (!$this->users->logged_in()) { $this->users->redirect_to_login(); }
    }

    // Logs out user
    function logout()
    {
        // Log the user out
        $logout = $this->users->logout();

        // Redirect them to the login page
        $this->session->set_flashdata('message', $this->users->message);
        redirect('login');
    }

    // Basic dashboard
    public function index()
    {
        $this->init_page(_("Home"), 'home');
        
        $index = get_logstash_indices_in_range(time()-86400, time());
        $data = '{
                  "aggs": {
                    "hosts": {
                      "cardinality": {
                        "field": "host.raw"
                      }
                    }
                  }
                }';
        
        $es = new ElasticSearch(array('index' => $index));
        $counts = $es->backend_call('_search?search_type=count', 'POST', $data);
        $this->data['unique_hosts'] = $counts['aggregations']['hosts']['value'];
        $this->load->view('home', $this->data);
    }

    public function show_dash()
    {
        
        $this->init_page(_("Dashboard"), 'dashboard');
        
        $this->data['user'] = $this->users->get_user();

        $this->load->view('dashboard', $this->data);
    }
    
    public function dashlet()
    {
        $this->load->view('dashlet/dashlet', $this->data);
    }
    
    public function do_update_check()
    {
        // Do an update check
        if (is_admin()) {
            $update_check_html = do_update_check();
        }
        print $update_check_html;
    }

    // ajax rss boxes on dashboard
    public function fetch_rss($feed)
    {
        $feeds = array('dontmiss', 'news', 'marketing');
        if(in_array($feed, $feeds)) {
            # FIXME : move to CI library/helper functions
            define('MAGPIE_DIR', APPPATH.'third_party/magpie/');
            define('MAGPIE_CACHE_ON', 1);
            define('MAGPIE_CACHE_AGE', 60*60*24*7);
            define('MAGPIE_CACHE_DIR', APPPATH.'cache/magpie_cache');
            require_once(MAGPIE_DIR.'rss_fetch.inc');
            $url = $this->config->item($feed.'_feed_url');
            $rss = fetch_rss($url);
            $context = array(
                'rss_result' => $rss
            );
            $view = 'admin/rss/dashboard_feed.php';
            if ($feed == 'marketing') { $view = 'admin/rss/dashboard_marketing_feed.php'; }
            $this->load->view($view, $context);
        }
    }

    // Basic user profile (can't do much here - requires auth to change certain things)
    // - for api key mostly
    public function profile()
    {
        $this->init_page(_("My Profile"), 'profile');

        $this->data['user'] = $this->users->get_user();
        $this->data['languages'] = get_languages();

        $this->load->view('profile', $this->data);
    }

    public function newkey()
    {
        // Generate a new API key
        $newkey = sha1(uniqid() . 'nagioslogserver');

        // Update new key in database
        $user_id = $this->session->userdata('user_id');
        $verify_user_id = $this->input->post('user_id_verify', TRUE);

        if ($user_id == $verify_user_id) {
            // Update the new api key
			$data = array("apikey" => $newkey);
			$this->users->update_user($user_id, $data);
        }

        // Set session data
        $this->session->set_userdata('apikey', $newkey);

        redirect('profile');
    }

    public function setlanguage()
    {
        $user_id = $this->session->userdata('user_id');
        $language = $this->input->post('language');

        // Update db
        $data = array("language" => $language);
		$this->users->update_user($user_id, $data);

        // Update session
        $this->session->set_userdata('language', $language);
    }
}
