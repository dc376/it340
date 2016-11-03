<?php

if (!function_exists('import_data')) {
    function import_data(&$object, $data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        if (is_array($data)) {
            foreach ($data as $property => $value) {
                if (property_exists($object, $property)) {
                    $object->$property = $value;
                }
            }
        }
        return $object;
    }
}

function decode_config_string($data)
{
    $arr = unserialize(base64_decode($data));
    if (!is_array($arr)) { $arr = array($arr); }
    return $arr;
}

function encode_config_string($arr)
{
    // print_r($arr);

    if (!is_array($arr)) { $arr = array($arr); }
    return base64_encode(serialize($arr));
}


function get_logstash_indices_in_range($start, $end) {
    
    $ci =& get_instance();
    $range = array();

    if (!is_numeric($start)) { $start = strtotime($start); }
    if (!is_numeric($end)) { $end = strtotime($end); }
    
    do {
        $current_ls_index = "logstash-" . gmdate('Y.m.d', $start);
        $es = new ElasticSearch(array('index' => $current_ls_index));
        $valid_query = $es->status();
        // make sure index is valid before putting index in range
        if (!empty($valid_query['status'])) {
            if ($valid_query['status'] != 403 && $valid_query['status'] != 404) {
                $range[] = $current_ls_index;
            }
        } else {
            if (array_key_exists('_shards', $valid_query)) {
                $range[] = $current_ls_index;
            }
        }
        $start = strtotime("+ 1 day", $start);
    } while($start <= $end);

    return implode(',', $range);
}

function snapshot_sort($a, $b)
{
    if (!array_key_exists('created', $a)) { return 0; }
    if (!array_key_exists('created', $b)) { return 0; }
    if ($a['created'] == $b['created']) {
        return 0;
    }
    return ($a['created'] < $b['created']) ? -1 : 1;
}

function ci_nat_sort($a, $b)
{
    return strnatcasecmp($a, $b);
}