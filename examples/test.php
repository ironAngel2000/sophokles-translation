<?php

//Define the Root - Directory
$baseDir = __DIR__.'/';
define('BASEDIR', $baseDir);

//Enable the debuging of the translations
define('SOPHOKLES_DEBUG',true);

require_once $baseDir.'vendor/autoload.php';

//Set the target language
lang::setLanguage('de');


\Sophokles\Translation\translation::registerFile(BASEDIR . 'translations/lang.de.json');

echo 'Tranlation of "save" in german: '.\Sophokles\Translation\lang::get('save').'<br />';
echo 'Tranlation of "cancel" in german: '.\Sophokles\Translation\lang::get('cancel').'<br />';

// If SOPHOKLES_DEBUG is defined and true

// Use es string not defined in the tranlation json file
echo 'Tranlation of "wonderful" in german: '.\Sophokles\Translation\lang::get('wonderful').'<br />';