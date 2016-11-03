#!/usr/bin/php -q
<?php
// NAGIOS CORE GLOBAL EVENT HANDLER
//
// Copyright (c) 16 Nagios Enterprises, LLC.  All rights reserved.
//  

require_once(dirname(__FILE__) . '/handle_nagioscore.inc.php');

handle_event(EVENTSOURCE_NAGIOSCORE, EVENTTYPE_STATECHANGE);

?>