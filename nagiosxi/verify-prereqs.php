<?php @"SourceGuardian"; //v10.1.6 ?><?php // Copyright (c) 2008-2016 Nagios Enterprises, LLC.  All rights reserved. ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');