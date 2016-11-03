<?php

    /**
     * Redirect if user isn't logged in.
     **/
    function require_auth()
    {
        $ci =& get_instance();
        if(!($ci->users->logged_in())) {
            redirect('auth/login?next='.$_SERVER['REQUEST_URI']);
        }
    }

    /**
     * check for an admin user
     **/
    function is_admin()
    {
        $ci =& get_instance();
        $user = $ci->users->get_user();
        return ($user['auth_type'] == 'admin');
    }

    /**
     * Check for a logged-in user
     **/
    function logged_in()
    {
        $ci =& get_instance();
        return $ci->users->logged_in();
    }

    /**
     * Check user type assignment
     **/
    function is_user_type($type) 
    {
        $ci =& get_instance();
        $user = $ci->users->get_user();
        return ($user['auth_type'] == 'admin' || $user['auth_type'] == $type);
    }