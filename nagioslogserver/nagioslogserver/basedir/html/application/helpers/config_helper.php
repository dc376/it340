<?php @"SourceGuardian"; //v10.1.6 ?><?php // Copyright (c) 2008-2016 Nagios Enterprises, LLC.  All rights reserved. ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
