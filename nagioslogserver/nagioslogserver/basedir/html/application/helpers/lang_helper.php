<?php

// Get a list of all available languages
function get_language_name($abbr)
{
    $languages = array('en_US' => _('English'),
                       'de_DE' => _('German'),
                       'es_ES' => _('Spanish'),
                       'fr_FR' => _('French'),
                       'it_IT' => _('Italian'),
                       'ja_JP' => _('Japanese'),
                       'ko_KR' => _('Korean'),
                       'pl_PL' => _('Polish'),
                       'pt_PT' => _('Portuguese'),
                       'ru_RU' => _('Russian'),
                       'zh_CN' => _('Chinese (Simplified)'),
                       'zh_TW' => _('Chinese (Traditional)'));
    return $languages[$abbr];
}

// Get all languages as an array
function get_languages()
{
    $languages = array();
    $path = APPPATH."language";
    $results = scandir($path);
    foreach ($results as $r) {
        if ($r === '.' || $r === '..' || $r === '.svn' || strpos($r,'_') != true) { continue; }
        if (is_dir($path . '/' . $r)) {
            if ($r == "en_US") {
                array_unshift($languages, $r);
            } else {
                $languages[] = $r;
            }
        }
    }

    return $languages;
}

function set_language($language)
{
    // Fix for wrong en_US language name (en and en_EN)
    if (empty($language)) {
        $language = 'en_US';
    }

    // Only set gettext (now _()) locale if we have a language file
    if (!file_exists(dirname(__FILE__) . '/../language/' . $language)) {
        return;
    }

    // Set the locale/environment language
    setlocale(LC_MESSAGES, $language, $language . '.utf-8', 'en_US', 'en_US.utf-8');
    putenv("LANG=" . $language);

    // Non-English numeric formats will turn decimals to commas and mess up all kinds of stuff
    // so we aren't going to do that
    setlocale(LC_NUMERIC, 'C');

    // Bind text domains
    bindtextdomain($language, dirname(__FILE__) . '/../language/');
    bind_textdomain_codeset($language, 'UTF-8');
    textdomain($language);
}
