<?php @"SourceGuardian"; //v10.1.6 ?><?php // Copyright (c) 2008-2016 Nagios Enterprises, LLC.  All rights reserved. ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');