<?php @"SourceGuardian"; //v10.1.6 ?><?php // Copyright (c) 2008-2016 Nagios Enterprises, LLC.  All rights reserved. ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');