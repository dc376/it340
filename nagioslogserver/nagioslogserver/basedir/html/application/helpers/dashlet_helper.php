<?php

////////////////////////////////////////////////////////////////////////
// DASHLET FUNCTIONS
////////////////////////////////////////////////////////////////////////


    /**
     * @Brief Places at dashlet at a given location     
     * 
     * Param array of setting, most important key is dashlet_path 
     * which is the dashlet path to load other params are passed 
     * as query string to the dashlet
     */
    function get_dashlet($args=array())
    {
        $ci =& get_instance();
        
        $ci->data['dashlet_path'] = grab_array_var($args, 'dashlet_path', '/dashboard/file/dashlet.json');
        $ci->data['dashlet_height'] = grab_array_var($args, 'height', '100%');
        unset($args['dashlet_path']);
        $ci->data['dashlet_qs'] = http_build_query($args);
        

        return $ci->load->view('dashlet/dashlet_iframe', $ci->data);
    }

    