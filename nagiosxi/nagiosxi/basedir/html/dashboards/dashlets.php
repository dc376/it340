<?php @"SourceGuardian"; //v10.1.6 ?><?php // Copyright (c) 2008-2016 Nagios Enterprises, LLC.  All rights reserved. ?><?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
