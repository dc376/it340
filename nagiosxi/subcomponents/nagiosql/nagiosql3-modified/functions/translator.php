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
// Component : Translation Functions
// Website   : http://www.nagiosql.org
// Date      : $LastChangedDate: 2009-05-14 10:19:05 +0200 (Do, 14. Mai 2009) $
// Author    : $LastChangedBy: rouven $
// Version   : 3.0.3
// Revision  : $LastChangedRevision: 714 $
// SVN-ID    : $Id$
//
///////////////////////////////////////////////////////////////////////////////

///
/// Internationalization and Localization utilities
///
function getLanguageCodefromLanguage($languagetosearch) {
  $detaillanguages = getLanguageData();
  foreach ($detaillanguages as $key2=>$languagename) {
    if ($languagetosearch==$languagename['description']) {
      return $key2;
    }
  }
  // else return default en code
  return "en_EN";
}

function getLanguageNameFromCode($codetosearch, $withnative=true) {
  $detaillanguages = getLanguageData();
  if (isset($detaillanguages[$codetosearch]['description'])) {
    if ($withnative) {
      return $detaillanguages[$codetosearch]['description'].' - '.$detaillanguages[$codetosearch]['nativedescription'];
    } else {
      return $detaillanguages[$codetosearch]['description'];}
  } else  {
    // else return false
    return false;
  }
}


function getLanguageData() {
  unset($supportedLanguages);
  // English
  $supportedLanguages['en_GB']['description'] = _('English');
  $supportedLanguages['en_GB']['nativedescription'] = 'English';

  // German
  $supportedLanguages['de_DE']['description'] = _('German');
  $supportedLanguages['de_DE']['nativedescription'] = 'Deutsch';

  // Chinese (Simplified)
  $supportedLanguages['zh_CN']['description'] = _('Chinese (Simplified)');
  $supportedLanguages['zh_CN']['nativedescription'] = '&#31616;&#20307;&#20013;&#25991;';

  // Polish
  $supportedLanguages['pl_PL']['description'] = _('Polish');
  $supportedLanguages['pl_PL']['nativedescription'] = 'Polski';

  // Italian
  $supportedLanguages['it_IT']['description'] = _('Italian');
  $supportedLanguages['it_IT']['nativedescription'] = 'Italiano';

  // French
  $supportedLanguages['fr_FR']['description'] = _('French');
  $supportedLanguages['fr_FR']['nativedescription'] = 'Fran&#231;ais';

  // Russian
  $supportedLanguages['ru_RU']['description'] = _('Russian');
  $supportedLanguages['ru_RU']['nativedescription'] = '&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;';

	// Spanish
	$supportedLanguages['es_ES']['description'] = _('Spanish');
	$supportedLanguages['es_ES']['nativedescription'] = 'Espa&#241;ol';

// Postponed until 3.1.0
//  // Spanish (Argentina)
//  $supportedLanguages['es_AR']['description'] = _('Spanish (Argentina)');
//  $supportedLanguages['es_AR']['nativedescription'] = 'Espa&#241;ol Argentina';
//
//  // Brazilian Portuguese
//  $supportedLanguages['pt_BR']['description'] = _('Portuguese (Brazilian)');
//  $supportedLanguages['pt_BR']['nativedescription'] = 'Portugu&#234;s do Brasil';
//
//  // Dutch
//  $supportedLanguages['nl_NL']['description'] = _('Dutch');
//  $supportedLanguages['nl_NL']['nativedescription'] = 'Nederlands';
//
  ///
  /// Currently not supported languages
  //
  //  // Albanian
  //  $supportedLanguages['sq']['description'] = $clang->_('Albanian');
  //  $supportedLanguages['sq']['nativedescription'] = 'Shqipe';
  //
  //  // Basque
  //  $supportedLanguages['eu']['description'] = _('Basque');
  //  $supportedLanguages['eu']['nativedescription'] = 'Euskara';
  //
  //  // Bosnian
  //  $supportedLanguages['bs']['description'] = _('Bosnian');
  //  $supportedLanguages['bs']['nativedescription'] = '&#x0411;&#x044a;&#x043b;&#x0433;&#x0430;&#x0440;&#x0441;&#x043a;&#x0438;';
  //
  //  // Bulgarian
  //  $supportedLanguages['bg']['description'] = _('Bulgarian');
  //  $supportedLanguages['bg']['nativedescription'] = '&#x0411;&#x044a;&#x043b;&#x0433;&#x0430;&#x0440;&#x0441;&#x043a;&#x0438;';
  //
  //  // Catalan
  //  $supportedLanguages['ca']['description'] = _('Catalan');
  //  $supportedLanguages['ca']['nativedescription'] = 'Catal&#940;';
  //
  //  // Welsh
  //  $supportedLanguages['cy']['description'] = _('Welsh');
  //  $supportedLanguages['cy']['nativedescription'] = 'Cymraeg';
  //
  //  // Chinese (Traditional - Hong Kong)
  //  $supportedLanguages['zh-Hant-HK']['description'] = _('Chinese (Traditional - Hong Kong)');
  //  $supportedLanguages['zh-Hant-HK']['nativedescription'] = '&#32321;&#39636;&#20013;&#25991;&#35486;&#31995;';
  //
  //  // Chinese (Traditional - Taiwan)
  //  $supportedLanguages['zh-Hant-TW']['description'] = _('Chinese (Traditional - Taiwan)');
  //  $supportedLanguages['zh-Hant-TW']['nativedescription'] = 'Chinese (Traditional - Taiwan)';
  //
  //  // Croatian
  //  $supportedLanguages['hr']['description'] = _('Croatian');
  //  $supportedLanguages['hr']['nativedescription'] = 'Hrvatski';
  //
  //  // Czech
  //  $supportedLanguages['cs']['description'] = _('Czech');
  //  $supportedLanguages['cs']['nativedescription'] = '&#x010c;esky';
  //
  //  // Danish
  //  $supportedLanguages['da']['description'] = _('Danish');
  //  $supportedLanguages['da']['nativedescription'] = 'Dansk';
  //
  //  // Estonian
  //  $supportedLanguages['et']['description'] = _('Estonian');
  //  $supportedLanguages['et']['nativedescription'] = 'Eesti';
  //
  //  // Finnish
  //  $supportedLanguages['fi']['description'] = _('Finnish');
  //  $supportedLanguages['fi']['nativedescription'] = 'Suomi';
  //
  //  // Galician
  //  $supportedLanguages['gl']['description'] = _('Galician');
  //  $supportedLanguages['gl']['nativedescription'] = 'Galego';
  //
  //  // German informal
  //  $supportedLanguages['de-informal']['description'] = _('German informal');
  //  $supportedLanguages['de-informal']['nativedescription'] = 'Deutsch (Du)';
  //
  //  // Greek
  //  $supportedLanguages['el']['description'] = _('Greek');
  //  $supportedLanguages['el']['nativedescription'] = '&#949;&#955;&#955;&#951;&#957;&#953;&#954;&#940;';
  //
  //  // Hebrew
  //  $supportedLanguages['he']['description'] = _('Hebrew');
  //  $supportedLanguages['he']['nativedescription'] = ' &#1506;&#1489;&#1512;&#1497;&#1514;';
  //
  //  // Hungarian
  //  $supportedLanguages['hu']['description'] = _('Hungarian');
  //  $supportedLanguages['hu']['nativedescription'] = 'Magyar';
  //
  //  // Indonesian
  //  $supportedLanguages['id']['description'] = _('Indonesian');
  //  $supportedLanguages['id']['nativedescription'] = 'Bahasa Indonesia';
  //
  //  // Japanese
  //  $supportedLanguages['ja']['description'] = _('Japanese');
  //  $supportedLanguages['ja']['nativedescription'] = '&#x65e5;&#x672c;&#x8a9e;';
  //
  //  // Lithuanian
  //  $supportedLanguages['lt']['description'] = _('Lithuanian');
  //  $supportedLanguages['lt']['nativedescription'] = 'Lietuvi&#371;';
  //
  //  // Macedonian
  //  $supportedLanguages['mk']['description'] = _('Macedonian');
  //  $supportedLanguages['mk']['nativedescription'] = '&#1052;&#1072;&#1082;&#1077;&#1076;&#1086;&#1085;&#1089;&#1082;&#1080;';
  //
  //  // Norwegian Bokml
  //  $supportedLanguages['nb']['description'] = _('Norwegian (Bokmal)');
  //  $supportedLanguages['nb']['nativedescription'] = 'Norsk Bokm&#229;l';
  //
  //  // Norwegian Nynorsk
  //  $supportedLanguages['nn']['description'] = _('Norwegian (Nynorsk)');
  //  $supportedLanguages['nn']['nativedescription'] = 'Norsk Nynorsk';
  //
  //  // Portuguese
  //  $supportedLanguages['pt']['description'] = _('Portuguese');
  //  $supportedLanguages['pt']['nativedescription'] = 'Portugu&#234;s';
  //
  //  // Romanian
  //  $supportedLanguages['ro']['description'] = _('Romanian');
  //  $supportedLanguages['ro']['nativedescription'] = 'Rom&#226;nesc';
  //
  //  // Slovak
  //  $supportedLanguages['sk']['description'] = _('Slovak');
  //  $supportedLanguages['sk']['nativedescription'] = 'Slov&aacute;k';
  //
  //  // Slovenian
  //  $supportedLanguages['sl']['description'] = _('Slovenian');
  //  $supportedLanguages['sl']['nativedescription'] = 'Sloven&#353;&#269;ina';
  //
  //  // Serbian
  //  $supportedLanguages['sr']['description'] = _('Serbian');
  //  $supportedLanguages['sr']['nativedescription'] = 'Srpski';
  //
  //  // Spanish (Mexico)
  //  $supportedLanguages['es-MX']['description'] = _('Spanish (Mexico)');
  //  $supportedLanguages['es-MX']['nativedescription'] = 'Espa&#241;ol Mejicano';
  //
  //  // Swedish
  //  $supportedLanguages['sv']['description'] = _('Swedish');
  //  $supportedLanguages['sv']['nativedescription'] = 'Svenska';
  //
  //  // Turkish
  //  $supportedLanguages['tr']['description'] = _('Turkish');
  //  $supportedLanguages['tr']['nativedescription'] = 'T&#252;rk&#231;e';
  //
  //  // Thai
  //  $supportedLanguages['th']['description'] = _('Thai');
  //  $supportedLanguages['th']['nativedescription'] = '&#3616;&#3634;&#3625;&#3634;&#3652;&#3607;&#3618;';
  //
  //  // Vietnamese
  //  $supportedLanguages['vi']['description'] = _('Vietnamese');
  //  $supportedLanguages['vi']['nativedescription'] = 'Ti&#7871;ng Vi&#7879;t';

  uasort($supportedLanguages,"user_sort");
  Return $supportedLanguages;
}

function user_sort($a, $b) {
  // smarts is all-important, so sort it first
  if($a['description'] >$b['description']) {
    return 1;
  } else {
  return -1;
  }
}
?>