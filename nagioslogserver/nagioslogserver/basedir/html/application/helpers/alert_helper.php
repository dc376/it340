<?php

/**
 * @brief Validates the given NRDP server and token combination
 * 
 * @param $server The URL of the NRDP server
 * @param $token The token to access the NRDP server
 * 
 * Tests whether or not the given NRDP server/token combo is legitimate.
 * Attempts to connect to the NRDP server, and on failure throws
 * and acceptable reason for failure.
 */
function validate_nrdp_server_with_token($server, $token)
{
    $url = "{$server}?token={$token}&cmd=submitcmd";
    $xml = @file_get_contents($url);
    $parsed = @simplexml_load_string($xml);

    if ($parsed === FALSE) {
        return false;
    }
    
    if (trim($parsed->message) !== 'NO COMMAND') {
        return 'NRDP server said '.trim($parsed->message);
    }
}

function get_alert_seconds($period)
{
    $suffix = substr($period, -1);
    $num = substr($period, 0, strlen($period)-1);

    $base = 60;
    switch ($suffix)
    {
        case 'M':
        case 'm':
            $base = 60; 
            break;

        case 'H':
        case 'h':
            $base = 60*60;
            break;

        case 's':
        case 'S':
            $base = 1;
            break;

        case 'd':
        case 'D':
            $base = 24*60*60;
            break;

        case 'w':
        case 'W':
            $base = 7*24*60*60;
            break;

        case 'm':
        case 'M':
            $base = 30*24*60*60;
            break;
    }

    // Do calculation
    $seconds = $base * $num;
    return $seconds;
}

function get_alert_status($code)
{
    switch ($code)
    {
        case 0:
            $status = "ok";
            break;

        case 1:
            $status = "warning";
            break;

        case 2:
            $status = "critical";
            break;

        default:
            $status = "unknown";
            break;
    }

    return $status;
}

function reschedule_alert($last_run, $check_interval)
{
    $seconds = get_alert_seconds($check_interval);
    $next_run = $last_run + $seconds;
    return $next_run;
}

function set_start_end_times($json, $start, $end)
{
    $obj = json_decode($json);

    // Create replace string and turn into micro time
    $replace = new StdClass;
    $replace->from = $start * 1000;
    $replace->to = $end * 1000;

    // Do some processing of the object to remove the current timestamps from/to and 
    // replace them with the new $start and $end variables
    recursive_query_search("@timestamp", $obj, $replace);

    return json_encode($obj);
}

function recursive_query_search($needle, &$haystack, $replace) {
    foreach ($haystack as $k => &$value) {
        if ($k === $needle) {
            $value = $replace;
            return;
        }
        if (is_array($value) || is_object($value)) {
            recursive_query_search($needle, $value, $replace);
        }
    }
    return;
}

/**
 * Verify that the alert needs to be ran... this happens because it's possible
 * the alert was ran by a different node before this one started it.
 **/
function verify_alert_run($alert_id)
{
    $ci =& get_instance();
    $alert = $ci->elasticsearch->get('alert', $alert_id);
    if ($alert['_source']['next_run'] <= time() && $alert['_source']['active'] == 1) {
        return true;
    }
    return false;
}

// Get the default email message for alerts
function get_default_email_tpl($force=false)
{
    $ci =& get_instance();
    $tpl = array();
    $cf_default = get_option('default_email_tpl', 'system');

    // Grab the config option, if it exists and fill out the template info
    if ($cf_default == 'system' || $force) {
        $tpl['name'] = _('System Default');
        $tpl['subject'] = _('Check returned') . ' %state% ';
        $tpl['body'] = '<p>%alertname% '._('came back with a').' <b>%state%</b> '._('state at').' <b>%time%</b></p>

<p>'._('The alert was processed with the following thresholds').':<br>
<ul>
    <li>'._('Lookback period').': %lookback%</li>
    <li>'._('Warning').': %warning%</li>
    <li>'._('Critical').': %critical%</li>
</ul>
</p>

<p>
'._('Here is the full alert output').':
<div style="padding: 10px; background-color: #F9F9F9;">%output%</div>
</p>

<p>'._('See the last').' %lookback% '._('in the').' <a href="%url%">'._('Nagios Log Server dashboard').'</a>.</p>

<p>'._('Nagios Log Server').'</p>';
    } else {
        // Look up email template info
        $template = $ci->elasticsearch->get('email_template', $cf_default);
        if (!empty($template['found'])) {
            $tpl['name'] = $template['_source']['name'];
            $tpl['subject'] = $template['_source']['subject'];
            $tpl['body'] = $template['_source']['body'];
        }
    }

    return $tpl;
}