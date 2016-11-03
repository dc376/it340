<?php

if (!function_exists('grab_request_var')) {
    /**
     * Grabs from the request variables.
     * 
     * @param $key The key to grab from an array.
     * @param $default The default to return if it does not exist.
     * @param $xssfilter Boolean flag to enable or disable the xssfilter.
     * 
     * @returns Mixed value that was requested.
     */
    function grab_request_var($key, $default=NULL, $xssfilter=TRUE)
    {
        $ci =& get_instance();
        $post = $ci->input->post($key, $xssfilter);
        if($post !== FALSE) {
            if(is_string($post)) {
                return urldecode($post);
            }
            else {
                return $post;
            }
        }
        $get = $ci->input->get($key, $xssfilter);
        if($get !== FALSE) {
            if(is_string($get)) {
                return urldecode($get);
            }
            else {
                return $get;
            }
        }
        return $default;
    }
}

if (!function_exists('grab_array_var')) {
    /**
     * Grabs from the array variables.
     * 
     * @param $key The key to grab from an array.
     * @param $default The default to return if it does not exist.
     * 
     * @returns Mixed value that was requested.
     */
    function grab_array_var($array, $key, $default=NULL)
    {
        if(array_key_exists($key, $array)) {
            return $array[$key];
        }
        else {
            return $default;
        }
    }
}

if (!function_exists('urldecode_array_walk')) {
    /**
     * Function meant to give to array_walk
     * 
     * @param $key The key will not be urldecoded.
     * @param $item The item that will actually be urldecoded.
     * 
     * @returns Mixed value that was requested.
     */
    function urldecode_array_walk(&$item, $key)
    {
        $item = urldecode($item);
    }
}

/**
 * @param $var
 *
 * @return bool
 */
function have_value($var)
{
    if ($var == null)
        return false;
    if (!isset($var))
        return false;
    if (empty($var))
        return false;
    if (is_array($var))
        return true;
    if (!strcmp($var, ""))
        return false;
    return true;
}

/**
 * @ Brief - Scans @message for %key% and replaces with value 
 * @param 
 *
 * @return string
 */
function macro_replace($args, $message)
{
    foreach ($args as $var => $val) {
                $tvar = "%" . $var . "%";
                $message = str_replace($tvar, $val, $message);
            }
    return $message;
}