<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LS_Config extends CI_Config
{
    function __construct() {
        parent::__construct();
        // Local settings should override default settings.
        if (is_readable(FCPATH . '/../application/config/config.local.php')) {
            $this->load('config.local', false, false);
        }
    }
}
