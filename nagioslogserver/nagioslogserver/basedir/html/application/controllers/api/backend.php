<?php @"SourceGuardian"; //v10.1.6 ?><?php // Copyright (c) 2008-2016 Nagios Enterprises, LLC.  All rights reserved. ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');