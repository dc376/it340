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
// Component : Admin main site
// Website   : http://www.nagiosql.org
// Date      : $LastChangedDate: 2009-04-28 15:02:27 +0200 (Di, 28. Apr 2009) $
// Author    : $LastChangedBy: rouven $
// Version   : 3.0.3
// Revision  : $LastChangedRevision: 708 $
// SVN-ID    : $Id$
//
///////////////////////////////////////////////////////////////////////////////
//error_reporting(E_ALL);
error_reporting(E_ERROR);
//
// Menuvariabeln für diese Seite
// =============================
$intMain      = 1;
$intSub       = 0;
$intMenu      = 2;
$preContent   = "admin/mainpages.tpl.htm";
$prePosition  = "admin";
//
// Vorgabedatei einbinden
// ======================
require("functions/prepend_adm.php");
//
// Menu aufbauen
// =============
$myVisClass->getMenu($intMain,$intSub,$intMenu);
//
// Content einbinden
// =================
$conttp->setVariable("TITLE",_('NagiosQL Administration'));
$conttp->parse("header");
$conttp->show("header");
$conttp->setVariable("DESC",_('Admin description'));
$conttp->parse("main");
$conttp->show("main");
//
// Footer ausgeben
// ===============
$maintp->setVariable("VERSION_INFO","Based on <a href='http://www.nagiosql.org' target='_blank'>NagiosQL</a> $setFileVersion");
$maintp->parse("footer");
$maintp->show("footer");
?>