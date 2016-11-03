<?php
session_start();

$dir = '/var/www/html/nagioslogserver/application';
if (!file_exists($dir)) {
	$dir = dirname(__FILE__).'/../../application';
}

// Function to remove html entities
function escape_html($str) {
	return htmlspecialchars($str, ENT_QUOTES);
}

include_once($dir.'/helpers/lang_helper.php');
set_language($_SESSION['language']);