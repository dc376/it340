<?php
//
// Copyright (c) 2008-2015 Nagios Enterprises, LLC.  All rights reserved.
//
// $Id$

// CONSTANTS


// EVENT LOG TYPES
define("NAGIOSCORE_LOGENTRY_RUNTIME_ERROR", 1);
define("NAGIOSCORE_LOGENTRY_RUNTIME_WARNING", 2);
define("NAGIOSCORE_LOGENTRY_VERIFICATION_ERROR", 4);
define("NAGIOSCORE_LOGENTRY_VERIFICATION_WARNING", 8);
define("NAGIOSCORE_LOGENTRY_CONFIG_ERROR", 16);
define("NAGIOSCORE_LOGENTRY_CONFIG_WARNING", 32);
define("NAGIOSCORE_LOGENTRY_PROCESS_INFO", 64);
define("NAGIOSCORE_LOGENTRY_EVENT_HANDLER", 128);
define("NAGIOSCORE_LOGENTRY_NOTIFICATION", 256); /* NOT USED ANYMORE - CAN BE REUSED */
define("NAGIOSCORE_LOGENTRY_EXTERNAL_COMMAND", 512);
define("NAGIOSCORE_LOGENTRY_HOST_UP", 1024);
define("NAGIOSCORE_LOGENTRY_HOST_DOWN", 2048);
define("NAGIOSCORE_LOGENTRY_HOST_UNREACHABLE", 4096);
define("NAGIOSCORE_LOGENTRY_SERVICE_OK", 8192);
define("NAGIOSCORE_LOGENTRY_SERVICE_UNKNOWN", 16384);
define("NAGIOSCORE_LOGENTRY_SERVICE_WARNING", 32768);
define("NAGIOSCORE_LOGENTRY_SERVICE_CRITICAL", 65536);
define("NAGIOSCORE_LOGENTRY_PASSIVE_CHECK", 131072);
define("NAGIOSCORE_LOGENTRY_INFO_MESSAGE", 262144);
define("NAGIOSCORE_LOGENTRY_HOST_NOTIFICATION", 524288);
define("NAGIOSCORE_LOGENTRY_SERVICE_NOTIFICATION", 1048576);

// NAGIOS CORE EXTERNAL COMMAND IDs
define("NAGIOSCORE_CMD_NONE", 0);
define("NAGIOSCORE_CMD_ADD_HOST_COMMENT", 1);
define("NAGIOSCORE_CMD_DEL_HOST_COMMENT", 2);
define("NAGIOSCORE_CMD_ADD_SVC_COMMENT", 3);
define("NAGIOSCORE_CMD_DEL_SVC_COMMENT", 4);
define("NAGIOSCORE_CMD_ENABLE_SVC_CHECK", 5);
define("NAGIOSCORE_CMD_DISABLE_SVC_CHECK", 6);
define("NAGIOSCORE_CMD_SCHEDULE_SVC_CHECK", 7);
define("NAGIOSCORE_CMD_DELAY_SVC_NOTIFICATION", 9);
define("NAGIOSCORE_CMD_DELAY_HOST_NOTIFICATION", 10);
define("NAGIOSCORE_CMD_DISABLE_NOTIFICATIONS", 11);
define("NAGIOSCORE_CMD_ENABLE_NOTIFICATIONS", 12);
define("NAGIOSCORE_CMD_RESTART_PROCESS", 13);
define("NAGIOSCORE_CMD_SHUTDOWN_PROCESS", 14);
define("NAGIOSCORE_CMD_ENABLE_HOST_SVC_CHECKS", 15);
define("NAGIOSCORE_CMD_DISABLE_HOST_SVC_CHECKS", 16);
define("NAGIOSCORE_CMD_SCHEDULE_HOST_SVC_CHECKS", 17);
define("NAGIOSCORE_CMD_DELAY_HOST_SVC_NOTIFICATIONS", 19);
define("NAGIOSCORE_CMD_DEL_ALL_HOST_COMMENTS", 20);
define("NAGIOSCORE_CMD_DEL_ALL_SVC_COMMENTS", 21);
define("NAGIOSCORE_CMD_ENABLE_SVC_NOTIFICATIONS", 22);
define("NAGIOSCORE_CMD_DISABLE_SVC_NOTIFICATIONS", 23);
define("NAGIOSCORE_CMD_ENABLE_HOST_NOTIFICATIONS", 24);
define("NAGIOSCORE_CMD_DISABLE_HOST_NOTIFICATIONS", 25);
define("NAGIOSCORE_CMD_ENABLE_ALL_NOTIFICATIONS_BEYOND_HOST", 26);
define("NAGIOSCORE_CMD_DISABLE_ALL_NOTIFICATIONS_BEYOND_HOST", 27);
define("NAGIOSCORE_CMD_ENABLE_HOST_SVC_NOTIFICATIONS", 28);
define("NAGIOSCORE_CMD_DISABLE_HOST_SVC_NOTIFICATIONS", 29);
define("NAGIOSCORE_CMD_PROCESS_SERVICE_CHECK_RESULT", 30);
define("NAGIOSCORE_CMD_SAVE_STATE_INFORMATION", 31);
define("NAGIOSCORE_CMD_READ_STATE_INFORMATION", 32);
define("NAGIOSCORE_CMD_ACKNOWLEDGE_HOST_PROBLEM", 33);
define("NAGIOSCORE_CMD_ACKNOWLEDGE_SVC_PROBLEM", 34);
define("NAGIOSCORE_CMD_START_EXECUTING_SVC_CHECKS", 35);
define("NAGIOSCORE_CMD_STOP_EXECUTING_SVC_CHECKS", 36);
define("NAGIOSCORE_CMD_START_ACCEPTING_PASSIVE_SVC_CHECKS", 37);
define("NAGIOSCORE_CMD_STOP_ACCEPTING_PASSIVE_SVC_CHECKS", 38);
define("NAGIOSCORE_CMD_ENABLE_PASSIVE_SVC_CHECKS", 39);
define("NAGIOSCORE_CMD_DISABLE_PASSIVE_SVC_CHECKS", 40);
define("NAGIOSCORE_CMD_ENABLE_EVENT_HANDLERS", 41);
define("NAGIOSCORE_CMD_DISABLE_EVENT_HANDLERS", 42);
define("NAGIOSCORE_CMD_ENABLE_HOST_EVENT_HANDLER", 43);
define("NAGIOSCORE_CMD_DISABLE_HOST_EVENT_HANDLER", 44);
define("NAGIOSCORE_CMD_ENABLE_SVC_EVENT_HANDLER", 45);
define("NAGIOSCORE_CMD_DISABLE_SVC_EVENT_HANDLER", 46);
define("NAGIOSCORE_CMD_ENABLE_HOST_CHECK", 47);
define("NAGIOSCORE_CMD_DISABLE_HOST_CHECK", 48);
define("NAGIOSCORE_CMD_START_OBSESSING_OVER_SVC_CHECKS", 49);
define("NAGIOSCORE_CMD_STOP_OBSESSING_OVER_SVC_CHECKS", 50);
define("NAGIOSCORE_CMD_REMOVE_HOST_ACKNOWLEDGEMENT", 51);
define("NAGIOSCORE_CMD_REMOVE_SVC_ACKNOWLEDGEMENT", 52);
define("NAGIOSCORE_CMD_SCHEDULE_FORCED_HOST_SVC_CHECKS", 53);
define("NAGIOSCORE_CMD_SCHEDULE_FORCED_SVC_CHECK", 54);
define("NAGIOSCORE_CMD_SCHEDULE_HOST_DOWNTIME", 55);
define("NAGIOSCORE_CMD_SCHEDULE_SVC_DOWNTIME", 56);
define("NAGIOSCORE_CMD_ENABLE_HOST_FLAP_DETECTION", 57);
define("NAGIOSCORE_CMD_DISABLE_HOST_FLAP_DETECTION", 58);
define("NAGIOSCORE_CMD_ENABLE_SVC_FLAP_DETECTION", 59);
define("NAGIOSCORE_CMD_DISABLE_SVC_FLAP_DETECTION", 60);
define("NAGIOSCORE_CMD_ENABLE_FLAP_DETECTION", 61);
define("NAGIOSCORE_CMD_DISABLE_FLAP_DETECTION", 62);
define("NAGIOSCORE_CMD_ENABLE_HOSTGROUP_SVC_NOTIFICATIONS", 63);
define("NAGIOSCORE_CMD_DISABLE_HOSTGROUP_SVC_NOTIFICATIONS", 64);
define("NAGIOSCORE_CMD_ENABLE_HOSTGROUP_HOST_NOTIFICATIONS", 65);
define("NAGIOSCORE_CMD_DISABLE_HOSTGROUP_HOST_NOTIFICATIONS", 66);
define("NAGIOSCORE_CMD_ENABLE_HOSTGROUP_SVC_CHECKS", 67);
define("NAGIOSCORE_CMD_DISABLE_HOSTGROUP_SVC_CHECKS", 68);
define("NAGIOSCORE_CMD_CANCEL_HOST_DOWNTIME", 69);
define("NAGIOSCORE_CMD_CANCEL_SVC_DOWNTIME", 70);
define("NAGIOSCORE_CMD_CANCEL_ACTIVE_HOST_DOWNTIME", 71);
define("NAGIOSCORE_CMD_CANCEL_PENDING_HOST_DOWNTIME", 72);
define("NAGIOSCORE_CMD_CANCEL_ACTIVE_SVC_DOWNTIME", 73);
define("NAGIOSCORE_CMD_CANCEL_PENDING_SVC_DOWNTIME", 74);
define("NAGIOSCORE_CMD_CANCEL_ACTIVE_HOST_SVC_DOWNTIME", 75);
define("NAGIOSCORE_CMD_CANCEL_PENDING_HOST_SVC_DOWNTIME", 76);
define("NAGIOSCORE_CMD_FLUSH_PENDING_COMMANDS", 77);
define("NAGIOSCORE_CMD_DEL_HOST_DOWNTIME", 78);
define("NAGIOSCORE_CMD_DEL_SVC_DOWNTIME", 79);
define("NAGIOSCORE_CMD_ENABLE_FAILURE_PREDICTION", 80);
define("NAGIOSCORE_CMD_DISABLE_FAILURE_PREDICTION", 81);
define("NAGIOSCORE_CMD_ENABLE_PERFORMANCE_DATA", 82);
define("NAGIOSCORE_CMD_DISABLE_PERFORMANCE_DATA", 83);
define("NAGIOSCORE_CMD_SCHEDULE_HOSTGROUP_HOST_DOWNTIME", 84);
define("NAGIOSCORE_CMD_SCHEDULE_HOSTGROUP_SVC_DOWNTIME", 85);
define("NAGIOSCORE_CMD_SCHEDULE_HOST_SVC_DOWNTIME", 86);
define("NAGIOSCORE_CMD_PROCESS_HOST_CHECK_RESULT", 87);
define("NAGIOSCORE_CMD_START_EXECUTING_HOST_CHECKS", 88);
define("NAGIOSCORE_CMD_STOP_EXECUTING_HOST_CHECKS", 89);
define("NAGIOSCORE_CMD_START_ACCEPTING_PASSIVE_HOST_CHECKS", 90);
define("NAGIOSCORE_CMD_STOP_ACCEPTING_PASSIVE_HOST_CHECKS", 91);
define("NAGIOSCORE_CMD_ENABLE_PASSIVE_HOST_CHECKS", 92);
define("NAGIOSCORE_CMD_DISABLE_PASSIVE_HOST_CHECKS", 93);
define("NAGIOSCORE_CMD_START_OBSESSING_OVER_HOST_CHECKS", 94);
define("NAGIOSCORE_CMD_STOP_OBSESSING_OVER_HOST_CHECKS", 95);
define("NAGIOSCORE_CMD_SCHEDULE_HOST_CHECK", 96);
// gap here :-)
define("NAGIOSCORE_CMD_SCHEDULE_FORCED_HOST_CHECK", 98);
define("NAGIOSCORE_CMD_START_OBSESSING_OVER_SVC", 99);
define("NAGIOSCORE_CMD_STOP_OBSESSING_OVER_SVC", 100);
define("NAGIOSCORE_CMD_START_OBSESSING_OVER_HOST", 101);
define("NAGIOSCORE_CMD_STOP_OBSESSING_OVER_HOST", 102);
define("NAGIOSCORE_CMD_ENABLE_HOSTGROUP_HOST_CHECKS", 103);
define("NAGIOSCORE_CMD_DISABLE_HOSTGROUP_HOST_CHECKS", 104);
define("NAGIOSCORE_CMD_ENABLE_HOSTGROUP_PASSIVE_SVC_CHECKS", 105);
define("NAGIOSCORE_CMD_DISABLE_HOSTGROUP_PASSIVE_SVC_CHECKS", 106);
define("NAGIOSCORE_CMD_ENABLE_HOSTGROUP_PASSIVE_HOST_CHECKS", 107);
define("NAGIOSCORE_CMD_DISABLE_HOSTGROUP_PASSIVE_HOST_CHECKS", 108);
define("NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_SVC_NOTIFICATIONS", 109);
define("NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_SVC_NOTIFICATIONS", 110);
define("NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_HOST_NOTIFICATIONS", 111);
define("NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_HOST_NOTIFICATIONS", 112);
define("NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_SVC_CHECKS", 113);
define("NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_SVC_CHECKS", 114);
define("NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_HOST_CHECKS", 115);
define("NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_HOST_CHECKS", 116);
define("NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_PASSIVE_SVC_CHECKS", 117);
define("NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_PASSIVE_SVC_CHECKS", 118);
define("NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_PASSIVE_HOST_CHECKS", 119);
define("NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_PASSIVE_HOST_CHECKS", 120);
define("NAGIOSCORE_CMD_SCHEDULE_SERVICEGROUP_HOST_DOWNTIME", 121);
define("NAGIOSCORE_CMD_SCHEDULE_SERVICEGROUP_SVC_DOWNTIME", 122);
define("NAGIOSCORE_CMD_CHANGE_GLOBAL_HOST_EVENT_HANDLER", 123);
define("NAGIOSCORE_CMD_CHANGE_GLOBAL_SVC_EVENT_HANDLER", 124);
define("NAGIOSCORE_CMD_CHANGE_HOST_EVENT_HANDLER", 125);
define("NAGIOSCORE_CMD_CHANGE_SVC_EVENT_HANDLER", 126);
define("NAGIOSCORE_CMD_CHANGE_HOST_CHECK_COMMAND", 127);
define("NAGIOSCORE_CMD_CHANGE_SVC_CHECK_COMMAND", 128);
define("NAGIOSCORE_CMD_CHANGE_NORMAL_HOST_CHECK_INTERVAL", 129);
define("NAGIOSCORE_CMD_CHANGE_NORMAL_SVC_CHECK_INTERVAL", 130);
define("NAGIOSCORE_CMD_CHANGE_RETRY_SVC_CHECK_INTERVAL", 131);
define("NAGIOSCORE_CMD_CHANGE_MAX_HOST_CHECK_ATTEMPTS", 132);
define("NAGIOSCORE_CMD_CHANGE_MAX_SVC_CHECK_ATTEMPTS", 133);
define("NAGIOSCORE_CMD_SCHEDULE_AND_PROPAGATE_TRIGGERED_HOST_DOWNTIME", 134);
define("NAGIOSCORE_CMD_ENABLE_HOST_AND_CHILD_NOTIFICATIONS", 135);
define("NAGIOSCORE_CMD_DISABLE_HOST_AND_CHILD_NOTIFICATIONS", 136);
define("NAGIOSCORE_CMD_SCHEDULE_AND_PROPAGATE_HOST_DOWNTIME", 137);
define("NAGIOSCORE_CMD_ENABLE_SERVICE_FRESHNESS_CHECKS", 138);
define("NAGIOSCORE_CMD_DISABLE_SERVICE_FRESHNESS_CHECKS", 139);
define("NAGIOSCORE_CMD_ENABLE_HOST_FRESHNESS_CHECKS", 140);
define("NAGIOSCORE_CMD_DISABLE_HOST_FRESHNESS_CHECKS", 141);
define("NAGIOSCORE_CMD_SET_HOST_NOTIFICATION_NUMBER", 142);
define("NAGIOSCORE_CMD_SET_SVC_NOTIFICATION_NUMBER", 143);
define("NAGIOSCORE_CMD_CHANGE_HOST_CHECK_TIMEPERIOD", 144);
define("NAGIOSCORE_CMD_CHANGE_SVC_CHECK_TIMEPERIOD", 145);
define("NAGIOSCORE_CMD_PROCESS_FILE", 146);
define("NAGIOSCORE_CMD_CHANGE_CUSTOM_HOST_VAR", 147);
define("NAGIOSCORE_CMD_CHANGE_CUSTOM_SVC_VAR", 148);
define("NAGIOSCORE_CMD_CHANGE_CUSTOM_CONTACT_VAR", 149);
define("NAGIOSCORE_CMD_ENABLE_CONTACT_HOST_NOTIFICATIONS", 150);
define("NAGIOSCORE_CMD_DISABLE_CONTACT_HOST_NOTIFICATIONS", 151);
define("NAGIOSCORE_CMD_ENABLE_CONTACT_SVC_NOTIFICATIONS", 152);
define("NAGIOSCORE_CMD_DISABLE_CONTACT_SVC_NOTIFICATIONS", 153);
define("NAGIOSCORE_CMD_ENABLE_CONTACTGROUP_HOST_NOTIFICATIONS", 154);
define("NAGIOSCORE_CMD_DISABLE_CONTACTGROUP_HOST_NOTIFICATIONS", 155);
define("NAGIOSCORE_CMD_ENABLE_CONTACTGROUP_SVC_NOTIFICATIONS", 156);
define("NAGIOSCORE_CMD_DISABLE_CONTACTGROUP_SVC_NOTIFICATIONS", 157);
define("NAGIOSCORE_CMD_CHANGE_RETRY_HOST_CHECK_INTERVAL", 158);
define("NAGIOSCORE_CMD_SEND_CUSTOM_HOST_NOTIFICATION", 159);
define("NAGIOSCORE_CMD_SEND_CUSTOM_SVC_NOTIFICATION", 160);
define("NAGIOSCORE_CMD_CHANGE_HOST_NOTIFICATION_TIMEPERIOD", 161);
define("NAGIOSCORE_CMD_CHANGE_SVC_NOTIFICATION_TIMEPERIOD", 162);
define("NAGIOSCORE_CMD_CHANGE_CONTACT_HOST_NOTIFICATION_TIMEPERIOD", 163);
define("NAGIOSCORE_CMD_CHANGE_CONTACT_SVC_NOTIFICATION_TIMEPERIOD", 164);
define("NAGIOSCORE_CMD_CHANGE_HOST_MODATTR", 165);
define("NAGIOSCORE_CMD_CHANGE_SVC_MODATTR", 166);
define("NAGIOSCORE_CMD_CHANGE_CONTACT_MODATTR", 167);
define("NAGIOSCORE_CMD_CHANGE_CONTACT_MODHATTR", 168);
define("NAGIOSCORE_CMD_CHANGE_CONTACT_MODSATTR", 169);

define("NAGIOSCORE_CMD_CUSTOM_COMMAND", 999);


$nagioscore_cmd_strings = array(
    NAGIOSCORE_CMD_ADD_HOST_COMMENT => "ADD_HOST_COMMENT",
    NAGIOSCORE_CMD_DEL_HOST_COMMENT => "DEL_HOST_COMMENT",
    NAGIOSCORE_CMD_ADD_SVC_COMMENT => "ADD_SVC_COMMENT",
    NAGIOSCORE_CMD_DEL_SVC_COMMENT => "DEL_SVC_COMMENT",
    NAGIOSCORE_CMD_ENABLE_SVC_CHECK => "ENABLE_SVC_CHECK",
    NAGIOSCORE_CMD_DISABLE_SVC_CHECK => "DISABLE_SVC_CHECK",
    NAGIOSCORE_CMD_SCHEDULE_SVC_CHECK => "SCHEDULE_SVC_CHECK",
    NAGIOSCORE_CMD_DELAY_SVC_NOTIFICATION => "DELAY_SVC_NOTIFICATION",
    NAGIOSCORE_CMD_DELAY_HOST_NOTIFICATION => "DELAY_HOST_NOTIFICATION",
    NAGIOSCORE_CMD_DISABLE_NOTIFICATIONS => "DISABLE_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_NOTIFICATIONS => "ENABLE_NOTIFICATIONS",
    NAGIOSCORE_CMD_RESTART_PROCESS => "RESTART_PROCESS",
    NAGIOSCORE_CMD_SHUTDOWN_PROCESS => "SHUTDOWN_PROCESS",
    NAGIOSCORE_CMD_ENABLE_HOST_SVC_CHECKS => "ENABLE_HOST_SVC_CHECKS",
    NAGIOSCORE_CMD_DISABLE_HOST_SVC_CHECKS => "DISABLE_HOST_SVC_CHECKS",
    NAGIOSCORE_CMD_SCHEDULE_HOST_SVC_CHECKS => "SCHEDULE_HOST_SVC_CHECKS",
    NAGIOSCORE_CMD_DELAY_HOST_SVC_NOTIFICATIONS => "DELAY_HOST_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_DEL_ALL_HOST_COMMENTS => "DEL_ALL_HOST_COMMENTS",
    NAGIOSCORE_CMD_DEL_ALL_SVC_COMMENTS => "DEL_ALL_SVC_COMMENTS",
    NAGIOSCORE_CMD_ENABLE_SVC_NOTIFICATIONS => "ENABLE_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_SVC_NOTIFICATIONS => "DISABLE_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_HOST_NOTIFICATIONS => "ENABLE_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_HOST_NOTIFICATIONS => "DISABLE_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_ALL_NOTIFICATIONS_BEYOND_HOST => "ENABLE_ALL_NOTIFICATIONS_BEYOND_HOST",
    NAGIOSCORE_CMD_DISABLE_ALL_NOTIFICATIONS_BEYOND_HOST => "DISABLE_ALL_NOTIFICATIONS_BEYOND_HOST",
    NAGIOSCORE_CMD_ENABLE_HOST_SVC_NOTIFICATIONS => "ENABLE_HOST_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_HOST_SVC_NOTIFICATIONS => "DISABLE_HOST_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_PROCESS_SERVICE_CHECK_RESULT => "PROCESS_SERVICE_CHECK_RESULT",
    NAGIOSCORE_CMD_SAVE_STATE_INFORMATION => "SAVE_STATE_INFORMATION",
    NAGIOSCORE_CMD_READ_STATE_INFORMATION => "READ_STATE_INFORMATION",
    NAGIOSCORE_CMD_ACKNOWLEDGE_HOST_PROBLEM => "ACKNOWLEDGE_HOST_PROBLEM",
    NAGIOSCORE_CMD_ACKNOWLEDGE_SVC_PROBLEM => "ACKNOWLEDGE_SVC_PROBLEM",
    NAGIOSCORE_CMD_START_EXECUTING_SVC_CHECKS => "START_EXECUTING_SVC_CHECKS",
    NAGIOSCORE_CMD_STOP_EXECUTING_SVC_CHECKS => "STOP_EXECUTING_SVC_CHECKS",
    NAGIOSCORE_CMD_START_ACCEPTING_PASSIVE_SVC_CHECKS => "START_ACCEPTING_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_STOP_ACCEPTING_PASSIVE_SVC_CHECKS => "STOP_ACCEPTING_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_ENABLE_PASSIVE_SVC_CHECKS => "ENABLE_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_DISABLE_PASSIVE_SVC_CHECKS => "DISABLE_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_ENABLE_EVENT_HANDLERS => "ENABLE_EVENT_HANDLERS",
    NAGIOSCORE_CMD_DISABLE_EVENT_HANDLERS => "DISABLE_EVENT_HANDLERS",
    NAGIOSCORE_CMD_ENABLE_HOST_EVENT_HANDLER => "ENABLE_HOST_EVENT_HANDLER",
    NAGIOSCORE_CMD_ENABLE_HOST_EVENT_HANDLER => "ENABLE_HOST_EVENT_HANDLER",
    NAGIOSCORE_CMD_DISABLE_HOST_EVENT_HANDLER => "DISABLE_HOST_EVENT_HANDLER",
    NAGIOSCORE_CMD_ENABLE_SVC_EVENT_HANDLER => "ENABLE_SVC_EVENT_HANDLER",
    NAGIOSCORE_CMD_DISABLE_SVC_EVENT_HANDLER => "DISABLE_SVC_EVENT_HANDLER",
    NAGIOSCORE_CMD_ENABLE_HOST_CHECK => "ENABLE_HOST_CHECK",
    NAGIOSCORE_CMD_DISABLE_HOST_CHECK => "DISABLE_HOST_CHECK",
    NAGIOSCORE_CMD_START_OBSESSING_OVER_SVC_CHECKS => "START_OBSESSING_OVER_SVC_CHECKS",
    NAGIOSCORE_CMD_STOP_OBSESSING_OVER_SVC_CHECKS => "STOP_OBSESSING_OVER_SVC_CHECKS",
    NAGIOSCORE_CMD_REMOVE_HOST_ACKNOWLEDGEMENT => "REMOVE_HOST_ACKNOWLEDGEMENT",
    NAGIOSCORE_CMD_REMOVE_SVC_ACKNOWLEDGEMENT => "REMOVE_SVC_ACKNOWLEDGEMENT",
    NAGIOSCORE_CMD_SCHEDULE_FORCED_HOST_SVC_CHECKS => "SCHEDULE_FORCED_HOST_SVC_CHECKS",
    NAGIOSCORE_CMD_SCHEDULE_FORCED_SVC_CHECK => "SCHEDULE_FORCED_SVC_CHECK",
    NAGIOSCORE_CMD_SCHEDULE_HOST_DOWNTIME => "SCHEDULE_HOST_DOWNTIME",
    NAGIOSCORE_CMD_SCHEDULE_SVC_DOWNTIME => "SCHEDULE_SVC_DOWNTIME",
    NAGIOSCORE_CMD_ENABLE_HOST_FLAP_DETECTION => "ENABLE_HOST_FLAP_DETECTION",
    NAGIOSCORE_CMD_DISABLE_HOST_FLAP_DETECTION => "DISABLE_HOST_FLAP_DETECTION",
    NAGIOSCORE_CMD_ENABLE_SVC_FLAP_DETECTION => "ENABLE_SVC_FLAP_DETECTION",
    NAGIOSCORE_CMD_DISABLE_SVC_FLAP_DETECTION => "DISABLE_SVC_FLAP_DETECTION",
    NAGIOSCORE_CMD_ENABLE_FLAP_DETECTION => "ENABLE_FLAP_DETECTION",
    NAGIOSCORE_CMD_DISABLE_FLAP_DETECTION => "DISABLE_FLAP_DETECTION",
    NAGIOSCORE_CMD_ENABLE_HOSTGROUP_SVC_NOTIFICATIONS => "ENABLE_HOSTGROUP_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_HOSTGROUP_SVC_NOTIFICATIONS => "DISABLE_HOSTGROUP_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_HOSTGROUP_HOST_NOTIFICATIONS => "ENABLE_HOSTGROUP_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_HOSTGROUP_HOST_NOTIFICATIONS => "DISABLE_HOSTGROUP_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_HOSTGROUP_SVC_CHECKS => "ENABLE_HOSTGROUP_SVC_CHECKS",
    NAGIOSCORE_CMD_DISABLE_HOSTGROUP_SVC_CHECKS => "DISABLE_HOSTGROUP_SVC_CHECKS",
    NAGIOSCORE_CMD_CANCEL_HOST_DOWNTIME => "CANCEL_HOST_DOWNTIME",
    NAGIOSCORE_CMD_CANCEL_SVC_DOWNTIME => "CANCEL_SVC_DOWNTIME",
    NAGIOSCORE_CMD_CANCEL_ACTIVE_HOST_DOWNTIME => "CANCEL_ACTIVE_HOST_DOWNTIME",
    NAGIOSCORE_CMD_CANCEL_PENDING_HOST_DOWNTIME => "CANCEL_PENDING_HOST_DOWNTIME",
    NAGIOSCORE_CMD_CANCEL_ACTIVE_SVC_DOWNTIME => "CANCEL_ACTIVE_SVC_DOWNTIME",
    NAGIOSCORE_CMD_CANCEL_PENDING_SVC_DOWNTIME => "CANCEL_PENDING_SVC_DOWNTIME",
    NAGIOSCORE_CMD_CANCEL_ACTIVE_HOST_SVC_DOWNTIME => "CANCEL_ACTIVE_HOST_SVC_DOWNTIME",
    NAGIOSCORE_CMD_CANCEL_PENDING_HOST_SVC_DOWNTIME => "CANCEL_PENDING_HOST_SVC_DOWNTIME",
    NAGIOSCORE_CMD_FLUSH_PENDING_COMMANDS => "FLUSH_PENDING_COMMANDS",
    NAGIOSCORE_CMD_DEL_HOST_DOWNTIME => "DEL_HOST_DOWNTIME",
    NAGIOSCORE_CMD_DEL_SVC_DOWNTIME => "DEL_SVC_DOWNTIME",
    NAGIOSCORE_CMD_ENABLE_FAILURE_PREDICTION => "ENABLE_FAILURE_PREDICTION",
    NAGIOSCORE_CMD_DISABLE_FAILURE_PREDICTION => "DISABLE_FAILURE_PREDICTION",
    NAGIOSCORE_CMD_ENABLE_PERFORMANCE_DATA => "ENABLE_PERFORMANCE_DATA",
    NAGIOSCORE_CMD_DISABLE_PERFORMANCE_DATA => "DISABLE_PERFORMANCE_DATA",
    NAGIOSCORE_CMD_SCHEDULE_HOSTGROUP_HOST_DOWNTIME => "SCHEDULE_HOSTGROUP_HOST_DOWNTIME",
    NAGIOSCORE_CMD_SCHEDULE_HOSTGROUP_SVC_DOWNTIME => "SCHEDULE_HOSTGROUP_SVC_DOWNTIME",
    NAGIOSCORE_CMD_SCHEDULE_HOST_SVC_DOWNTIME => "SCHEDULE_HOST_SVC_DOWNTIME",
    NAGIOSCORE_CMD_PROCESS_HOST_CHECK_RESULT => "PROCESS_HOST_CHECK_RESULT",
    NAGIOSCORE_CMD_START_EXECUTING_HOST_CHECKS => "START_EXECUTING_HOST_CHECKS",
    NAGIOSCORE_CMD_STOP_EXECUTING_HOST_CHECKS => "STOP_EXECUTING_HOST_CHECKS",
    NAGIOSCORE_CMD_START_ACCEPTING_PASSIVE_HOST_CHECKS => "START_ACCEPTING_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_STOP_ACCEPTING_PASSIVE_HOST_CHECKS => "STOP_ACCEPTING_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_ENABLE_PASSIVE_HOST_CHECKS => "ENABLE_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_DISABLE_PASSIVE_HOST_CHECKS => "DISABLE_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_START_OBSESSING_OVER_HOST_CHECKS => "START_OBSESSING_OVER_HOST_CHECKS",
    NAGIOSCORE_CMD_STOP_OBSESSING_OVER_HOST_CHECKS => "STOP_OBSESSING_OVER_HOST_CHECKS",
    NAGIOSCORE_CMD_SCHEDULE_HOST_CHECK => "SCHEDULE_HOST_CHECK",
    NAGIOSCORE_CMD_SCHEDULE_FORCED_HOST_CHECK => "SCHEDULE_FORCED_HOST_CHECK",
    NAGIOSCORE_CMD_START_OBSESSING_OVER_SVC => "START_OBSESSING_OVER_SVC",
    NAGIOSCORE_CMD_STOP_OBSESSING_OVER_SVC => "STOP_OBSESSING_OVER_SVC",
    NAGIOSCORE_CMD_START_OBSESSING_OVER_HOST => "START_OBSESSING_OVER_HOST",
    NAGIOSCORE_CMD_STOP_OBSESSING_OVER_HOST => "STOP_OBSESSING_OVER_HOST",
    NAGIOSCORE_CMD_ENABLE_HOSTGROUP_HOST_CHECKS => "ENABLE_HOSTGROUP_HOST_CHECKS",
    NAGIOSCORE_CMD_DISABLE_HOSTGROUP_HOST_CHECKS => "DISABLE_HOSTGROUP_HOST_CHECKS",
    NAGIOSCORE_CMD_ENABLE_HOSTGROUP_PASSIVE_SVC_CHECKS => "ENABLE_HOSTGROUP_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_DISABLE_HOSTGROUP_PASSIVE_SVC_CHECKS => "DISABLE_HOSTGROUP_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_ENABLE_HOSTGROUP_PASSIVE_HOST_CHECKS => "ENABLE_HOSTGROUP_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_DISABLE_HOSTGROUP_PASSIVE_HOST_CHECKS => "DISABLE_HOSTGROUP_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_SVC_NOTIFICATIONS => "ENABLE_SERVICEGROUP_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_SVC_NOTIFICATIONS => "DISABLE_SERVICEGROUP_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_HOST_NOTIFICATIONS => "ENABLE_SERVICEGROUP_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_HOST_NOTIFICATIONS => "DISABLE_SERVICEGROUP_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_SVC_CHECKS => "ENABLE_SERVICEGROUP_SVC_CHECKS",
    NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_SVC_CHECKS => "DISABLE_SERVICEGROUP_SVC_CHECKS",
    NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_HOST_CHECKS => "ENABLE_SERVICEGROUP_HOST_CHECKS",
    NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_HOST_CHECKS => "DISABLE_SERVICEGROUP_HOST_CHECKS",
    NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_PASSIVE_SVC_CHECKS => "ENABLE_SERVICEGROUP_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_PASSIVE_SVC_CHECKS => "DISABLE_SERVICEGROUP_PASSIVE_SVC_CHECKS",
    NAGIOSCORE_CMD_ENABLE_SERVICEGROUP_PASSIVE_HOST_CHECKS => "ENABLE_SERVICEGROUP_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_DISABLE_SERVICEGROUP_PASSIVE_HOST_CHECKS => "DISABLE_SERVICEGROUP_PASSIVE_HOST_CHECKS",
    NAGIOSCORE_CMD_SCHEDULE_SERVICEGROUP_HOST_DOWNTIME => "SCHEDULE_SERVICEGROUP_HOST_DOWNTIME",
    NAGIOSCORE_CMD_SCHEDULE_SERVICEGROUP_SVC_DOWNTIME => "SCHEDULE_SERVICEGROUP_SVC_DOWNTIME",
    NAGIOSCORE_CMD_CHANGE_GLOBAL_HOST_EVENT_HANDLER => "CHANGE_GLOBAL_HOST_EVENT_HANDLER",
    NAGIOSCORE_CMD_CHANGE_GLOBAL_SVC_EVENT_HANDLER => "CHANGE_GLOBAL_SVC_EVENT_HANDLER",
    NAGIOSCORE_CMD_CHANGE_HOST_EVENT_HANDLER => "CHANGE_HOST_EVENT_HANDLER",
    NAGIOSCORE_CMD_CHANGE_SVC_EVENT_HANDLER => "CHANGE_SVC_EVENT_HANDLER",
    NAGIOSCORE_CMD_CHANGE_HOST_CHECK_COMMAND => "CHANGE_HOST_CHECK_COMMAND",
    NAGIOSCORE_CMD_CHANGE_SVC_CHECK_COMMAND => "CHANGE_SVC_CHECK_COMMAND",
    NAGIOSCORE_CMD_CHANGE_NORMAL_HOST_CHECK_INTERVAL => "CHANGE_NORMAL_HOST_CHECK_INTERVAL",
    NAGIOSCORE_CMD_CHANGE_NORMAL_SVC_CHECK_INTERVAL => "CHANGE_NORMAL_SVC_CHECK_INTERVAL",
    NAGIOSCORE_CMD_CHANGE_RETRY_SVC_CHECK_INTERVAL => "CHANGE_RETRY_SVC_CHECK_INTERVAL",
    NAGIOSCORE_CMD_CHANGE_MAX_HOST_CHECK_ATTEMPTS => "CHANGE_MAX_HOST_CHECK_ATTEMPTS",
    NAGIOSCORE_CMD_CHANGE_MAX_SVC_CHECK_ATTEMPTS => "CHANGE_MAX_SVC_CHECK_ATTEMPTS",
    NAGIOSCORE_CMD_SCHEDULE_AND_PROPAGATE_TRIGGERED_HOST_DOWNTIME => "SCHEDULE_AND_PROPAGATE_TRIGGERED_HOST_DOWNTIME",
    NAGIOSCORE_CMD_ENABLE_HOST_AND_CHILD_NOTIFICATIONS => "ENABLE_HOST_AND_CHILD_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_HOST_AND_CHILD_NOTIFICATIONS => "DISABLE_HOST_AND_CHILD_NOTIFICATIONS",
    NAGIOSCORE_CMD_SCHEDULE_AND_PROPAGATE_HOST_DOWNTIME => "SCHEDULE_AND_PROPAGATE_HOST_DOWNTIME",
    NAGIOSCORE_CMD_ENABLE_SERVICE_FRESHNESS_CHECKS => "ENABLE_SERVICE_FRESHNESS_CHECKS",
    NAGIOSCORE_CMD_DISABLE_SERVICE_FRESHNESS_CHECKS => "DISABLE_SERVICE_FRESHNESS_CHECKS",
    NAGIOSCORE_CMD_ENABLE_HOST_FRESHNESS_CHECKS => "ENABLE_HOST_FRESHNESS_CHECKS",
    NAGIOSCORE_CMD_DISABLE_HOST_FRESHNESS_CHECKS => "DISABLE_HOST_FRESHNESS_CHECKS",
    NAGIOSCORE_CMD_SET_HOST_NOTIFICATION_NUMBER => "SET_HOST_NOTIFICATION_NUMBER",
    NAGIOSCORE_CMD_SET_SVC_NOTIFICATION_NUMBER => "SET_SVC_NOTIFICATION_NUMBER",
    NAGIOSCORE_CMD_CHANGE_HOST_CHECK_TIMEPERIOD => "CHANGE_HOST_CHECK_TIMEPERIOD",
    NAGIOSCORE_CMD_CHANGE_SVC_CHECK_TIMEPERIOD => "CHANGE_SVC_CHECK_TIMEPERIOD",
    NAGIOSCORE_CMD_PROCESS_FILE => "PROCESS_FILE",
    NAGIOSCORE_CMD_CHANGE_CUSTOM_HOST_VAR => "CHANGE_CUSTOM_HOST_VAR",
    NAGIOSCORE_CMD_CHANGE_CUSTOM_SVC_VAR => "CHANGE_CUSTOM_SVC_VAR",
    NAGIOSCORE_CMD_CHANGE_CUSTOM_CONTACT_VAR => "CHANGE_CUSTOM_CONTACT_VAR",
    NAGIOSCORE_CMD_ENABLE_CONTACT_HOST_NOTIFICATIONS => "ENABLE_CONTACT_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_CONTACT_HOST_NOTIFICATIONS => "DISABLE_CONTACT_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_CONTACT_SVC_NOTIFICATIONS => "ENABLE_CONTACT_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_CONTACT_SVC_NOTIFICATIONS => "DISABLE_CONTACT_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_CONTACTGROUP_HOST_NOTIFICATIONS => "ENABLE_CONTACTGROUP_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_CONTACTGROUP_HOST_NOTIFICATIONS => "DISABLE_CONTACTGROUP_HOST_NOTIFICATIONS",
    NAGIOSCORE_CMD_ENABLE_CONTACTGROUP_SVC_NOTIFICATIONS => "ENABLE_CONTACTGROUP_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_DISABLE_CONTACTGROUP_SVC_NOTIFICATIONS => "DISABLE_CONTACTGROUP_SVC_NOTIFICATIONS",
    NAGIOSCORE_CMD_CHANGE_RETRY_HOST_CHECK_INTERVAL => "CHANGE_RETRY_HOST_CHECK_INTERVAL",
    NAGIOSCORE_CMD_SEND_CUSTOM_HOST_NOTIFICATION => "SEND_CUSTOM_HOST_NOTIFICATION",
    NAGIOSCORE_CMD_SEND_CUSTOM_SVC_NOTIFICATION => "SEND_CUSTOM_SVC_NOTIFICATION",
    NAGIOSCORE_CMD_CHANGE_HOST_NOTIFICATION_TIMEPERIOD => "CHANGE_HOST_NOTIFICATION_TIMEPERIOD",
    NAGIOSCORE_CMD_CHANGE_SVC_NOTIFICATION_TIMEPERIOD => "CHANGE_SVC_NOTIFICATION_TIMEPERIOD",
    NAGIOSCORE_CMD_CHANGE_CONTACT_HOST_NOTIFICATION_TIMEPERIOD => "CHANGE_CONTACT_HOST_NOTIFICATION_TIMEPERIOD",
    NAGIOSCORE_CMD_CHANGE_CONTACT_SVC_NOTIFICATION_TIMEPERIOD => "CHANGE_CONTACT_SVC_NOTIFICATION_TIMEPERIOD",
    NAGIOSCORE_CMD_CHANGE_HOST_MODATTR => "CHANGE_HOST_MODATTR",
    NAGIOSCORE_CMD_CHANGE_SVC_MODATTR => "CHANGE_SVC_MODATTR",
    NAGIOSCORE_CMD_CHANGE_CONTACT_MODATTR => "CHANGE_CONTACT_MODATTR",
    NAGIOSCORE_CMD_CHANGE_CONTACT_MODHATTR => "CHANGE_CONTACT_MODHATTR",
    NAGIOSCORE_CMD_CHANGE_CONTACT_MODSATTR => "CHANGE_CONTACT_MODSATTR",
);
