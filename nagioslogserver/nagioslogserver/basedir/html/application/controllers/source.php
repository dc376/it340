<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Source extends LS_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->page = 'sources';

        // Make sure that user is authenticated no matter what page they are on
        require_install();
        if (!$this->users->logged_in()) { $this->users->redirect_to_login(); }
    }

    public function index()
    {
        $this->init_page(_("Source Setup"), $this->page);

        $this->load->view('help/source_setup', $this->data);
    }

    public function assets($asset, $return=false)
    {
        $asset = $this->load->view('help/assets/'.$asset, array(), true);
        $hostname = get_option('cluster_hostname', $_SERVER['HTTP_HOST']);
        $scheme = (isset($_SERVER["HTTPS"]) && $_SERVER['HTTPS'] == "on") ? "https" : "http";
        $untranslated_hostname = '%hostname%';
        $eventlog_port = "3515";
        $macros = array('scheme' => $scheme,
                        'hostname' => $hostname,
                        'untranslated_hostname' => $untranslated_hostname,
                        'syslog_port' => "5544",
                        'eventlog_port' => "3515");
                      
        $asset = macro_replace($macros, $asset);
        if ($return) {
            return $asset;
        } else {
            header('Content-type: text/plain; charset=utf-8');
            print $asset;
        }
    }

    public function linux()
    {
        $this->init_page(_("Linux Setup"), $this->page);
        
        $step1_asset = $this->assets('linux_setup.txt', true);
        $this->data['step1'] = htmlentities($step1_asset, ENT_COMPAT, 'UTF-8');

        $step2_asset = $this->assets('linux_manual.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('linux_base.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');
        
        $step4_asset = $this->assets('syslog-ng.txt', true);
        $this->data['step4'] = htmlentities($step4_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/linux_setup', $this->data);
    }

    public function import()
    {
        $this->init_page(_("Import From File"), $this->page);

        $step1_asset = $this->assets('import_files1.txt', true);
        $this->data['step1'] = htmlentities($step1_asset, ENT_COMPAT, 'UTF-8');

        $step2_asset = $this->assets('import_files2.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('import_files3.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $step3_nc_yum_asset = $this->assets('import_files3_nc_yum.txt', true);
        $this->data['step3_nc_yum'] = htmlentities($step3_nc_yum_asset, ENT_COMPAT, 'UTF-8');

        $step3_nc_apt_asset = $this->assets('import_files3_nc_apt.txt', true);
        $this->data['step3_nc_apt'] = htmlentities($step3_nc_apt_asset, ENT_COMPAT, 'UTF-8');

        $step4_asset = $this->assets('import_files4.txt', true);
        $this->data['step4'] = htmlentities($step4_asset, ENT_COMPAT, 'UTF-8');

        $step5_asset = $this->assets('import_files5.txt', true);
        $this->data['step5'] = htmlentities($step5_asset, ENT_COMPAT, 'UTF-8');

        $step6_asset = $this->assets('import_files6.txt', true);
        $this->data['step6'] = htmlentities($step6_asset, ENT_COMPAT, 'UTF-8');

        $step7_asset = $this->assets('import_files7.txt', true);
        $this->data['step7'] = htmlentities($step7_asset, ENT_COMPAT, 'UTF-8');

        // Verify if the import inputs are set up
        $this->data['import_input_available'] = false;
        $r = $this->elasticsearch->get('node', 'global');
        foreach ($r['_source']['config_inputs'] as $input) {
            if ((strpos($input['raw'], "import_json") !== FALSE || strpos($input['raw'], "import_raw") !== FALSE) &&
                (strpos($input['raw'], "2056") !== FALSE || strpos($input['raw'], "2057") !== FALSE)) {
                if ($input['active']) {
                    $this->data['import_input_available'] = true;
                    break;
                }
            }
        }

        $this->load->view('help/import', $this->data);
    }

    public function windows()
    {
        $this->init_page(_("Windows Setup"), $this->page);
       
        $step2_asset = $this->assets('nxlog.conf', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/windows_setup', $this->data);
    }

    public function network()
    {
        $this->init_page(_("Network Device Setup"), $this->page);

        $step1_asset = $this->assets('network_IP.txt', true);
        $this->data['step1'] = htmlentities($step1_asset, ENT_COMPAT, 'UTF-8');

        $step2_asset = $this->assets('network_Port.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('network_netcat.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/network_setup', $this->data);
    }

    public function linux_files()
    {
        $this->init_page(_("Linux Files Setup"), $this->page);

        $step2_asset = $this->assets('linux_files.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('linux_manual.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $step4_asset = $this->assets('linux_config.txt', true);
        $this->data['step4'] = htmlentities($step4_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/linux_files', $this->data);
    }

    public function windows_files()
    {
        $this->init_page(_("Windows Files Setup"), $this->page);

        $step2_asset = $this->assets('windows_files.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('windows_files2.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/windows_files', $this->data);
    }

    public function apache()
    {
        $this->init_page(_("Apache Setup"), $this->page);

        $step1_asset = $this->assets('apache_filter.txt', true);
        $this->data['step1'] = htmlentities($step1_asset, ENT_COMPAT, 'UTF-8');

        $step2_asset = $this->assets('apache_logs.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('linux_manual.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $step4_asset = $this->assets('apache_config.txt', true);
        $this->data['step4'] = htmlentities($step4_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/apache_setup', $this->data);
    }

    public function PHP()
    {
        $this->init_page(_("PHP Setup"), $this->page);

        $step1_asset = $this->assets('PHP_logs.txt', true);
        $this->data['step1'] = htmlentities($step1_asset, ENT_COMPAT, 'UTF-8');

        $step2_asset = $this->assets('linux_manual.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('PHP_config.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/PHP_setup', $this->data);
    }

    public function mysql()
    {
        $this->init_page(_("MySQL Setup"), $this->page);

        $step1_asset = $this->assets('mysql_filter.txt', true);
        $this->data['step1'] = htmlentities($step1_asset, ENT_COMPAT, 'UTF-8');

        $step2_asset = $this->assets('mysql_logs.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('linux_manual.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $step4_asset = $this->assets('mysql_config.txt', true);
        $this->data['step4'] = htmlentities($step4_asset, ENT_COMPAT, 'UTF-8');

        $step5_asset = $this->assets('mysqld_conf.txt', true);
        $this->data['step5'] = htmlentities($step5_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/mysql_setup', $this->data);
    }

    public function mssql()
    {
        $this->init_page(_("MS SQL Setup"), $this->page);

        $this->load->view('help/mssql_setup', $this->data);
    }

    public function IIS()
    {
        $this->init_page(_("IIS Source Setup"), $this->page);

        $step2_asset = $this->assets('IIS_files.txt', true);
        $this->data['step2'] = htmlentities($step2_asset, ENT_COMPAT, 'UTF-8');

        $step3_asset = $this->assets('IIS_files2.txt', true);
        $this->data['step3'] = htmlentities($step3_asset, ENT_COMPAT, 'UTF-8');

        $this->load->view('help/IIS_setup', $this->data);
    }
}