<?php @"SourceGuardian"; //v10.1.6 ?><?php // Copyright (c) 2008-2016 Nagios Enterprises, LLC.  All rights reserved. ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');