<?php
///////////////////////////////////////////////////////////////////////////////
//
// NagiosQL
//
///////////////////////////////////////////////////////////////////////////////
//
// (c) 2008, 2009 by Martin Willisegger
//
// Project   : NagiosQL
// Component : Admin alarming overview
// Website   : http://www.nagiosql.org
// Date      : $LastChangedDate: 2009-04-28 15:02:27 +0200 (Di, 28. Apr 2009) $
// Author    : $LastChangedBy: rouven $
// Version   : 3.0.3
// Revision  : $LastChangedRevision: 708 $
// SVN-ID    : $Id$
//
///////////////////////////////////////////////////////////////////////////////
// 
// Menuvariabeln für diese Seite
// =============================
$intMain 		= 3;
$intSub  		= 0;
$intMenu 		= 2;
$preContent 	= "admin/mainpages.tpl.htm";
//
// Vorgabedatei einbinden
// ======================
require("../functions/prepend_adm.php");
//
// Menu aufbauen
// =============
$myVisClass->getMenu($intMain,$intSub,$intMenu);
//
// Content einbinden
// =================
$conttp->setVariable("TITLE",_('Alarming'));
$conttp->parse("header");
$conttp->show("header");
$conttp->setVariable("DESC",_('To define contact data, contact templates and contact groups and time periods.'));
$conttp->setVariable("STATISTICS",_('Statistical datas'));
$conttp->setVariable("TYPE",_('Group'));
$conttp->setVariable("ACTIVE",_('Active'));
$conttp->setVariable("INACTIVE",_('Inactive'));
//
// Statistische Daten zusammenstellen
// ==================================
$conttp->setVariable("NAME",_('Contact data'));
$conttp->setVariable("ACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_contact WHERE active='1' AND config_id=$chkDomainId"));
$conttp->setVariable("INACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_contact WHERE active='0' AND config_id=$chkDomainId"));
$conttp->parse("statisticrow");
$conttp->setVariable("NAME",_('Contact groups'));
$conttp->setVariable("ACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_contactgroup WHERE active='1' AND config_id=$chkDomainId"));
$conttp->setVariable("INACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_contactgroup WHERE active='0' AND config_id=$chkDomainId"));
$conttp->parse("statisticrow");
$conttp->setVariable("NAME",_('Time periods'));
$conttp->setVariable("ACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_timeperiod WHERE active='1' AND config_id=$chkDomainId"));
$conttp->setVariable("INACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_timeperiod WHERE active='0' AND config_id=$chkDomainId"));
$conttp->parse("statisticrow");
$conttp->setVariable("NAME",_('Contact templates'));
$conttp->setVariable("ACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_contacttemplate WHERE active='1' AND config_id=$chkDomainId"));
$conttp->setVariable("INACT_COUNT",$myDBClass->getFieldData("SELECT count(*) FROM tbl_contacttemplate WHERE active='0' AND config_id=$chkDomainId"));
$conttp->parse("statisticrow");

$conttp->parse("statistics");
$conttp->parse("main");
$conttp->show("main");
//
// Footer ausgeben
// ===============
$maintp->setVariable("VERSION_INFO","Based on <a href='http://www.nagiosql.org' target='_blank'>NagiosQL</a> $setFileVersion");
$maintp->parse("footer");
$maintp->show("footer");
?>