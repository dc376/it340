<?php

    function humanize_time($secs, $precision=6)
    {
        $secs = (int) $secs;
        $bit = array(
        ' year'        => $secs / 31556926 % 12,
        ' week'        => $secs / 604800 % 52,
        ' day'        => $secs / 86400 % 7,
        ' hour'        => $secs / 3600 % 24,
        ' minute'    => $secs / 60 % 60,
        ' second'    => $secs % 60
        );

        $i=0;
        $ret = array();
        foreach($bit as $k => $v) {
            if(++$i > $precision) { continue; }
            if($v > 1)$ret[] = $v . $k . 's';
            if($v == 1)$ret[] = $v . $k;
        }
        if(count($ret)) {
            return join(' ', $ret);
        }
        return 'n/a';
    }

    function humanize_date($date)
    {
        $ts = strtotime($date);
        if(date("Y-m-d") == date("Y-m-d", $ts)) {
            return date("\T\o\d\a\y h:ia", $ts);
        } else {
            return date('F jS, Y', $ts);
        }
    }

    function humanize_filesize($bytes)
    {
        $bytes = (int) $bytes;
        if ($bytes >= 1073741824)
        {
            $str = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $str = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $str = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $str = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $str = $bytes . ' byte';
        }
        else
        {
            $str = '0 bytes';
        }

        return $str;
    }

    function pluralize($items, $suffix='s')
    {
        if(is_array($items)) {
            $num = count($items);
        } else {
            $num = $items;
        }
        if($num != 1) {
            return $suffix;
        } 
    }
    
    /**
        return an array with ip and port broken out of address such as
        inet[/192.168.2.34:9300]
    */
    function split_inet_string($inet_string) {
        preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $inet_string, $ip);
        preg_match('/(\d{4,5})/', $inet_string, $port);
        return array('ip' => $ip[0], 'port' => $port[0]);
    }
    
    function is_are($items)
    {
        if(is_array($items)) {
            $num = count($items);
        } else {
            $num = $items;
        }
        if($num == 1) {
            return 'is';
        } else {
            return 'are';
        }
    }
