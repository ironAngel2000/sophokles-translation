<?php
/**
 * Created by VS-Code
 * User: Bernd Wagner
 * Date: 06.03.2019
 * Time: 07:40.
 */

namespace Sophokles\Translation;

final class lang
{
    private static $langugange='en';

    private function __construct()
    {
    }

    public static function get(string $text)
    {
        $ret = $text;

        if(defined('SOPHOKLES_DEBUG') && SOPHOKLES_DEBUG===true){
            $ret .= '~';
        }

        $transKey = translation::getTranslationString($text, self::$langugange);

        if (trim($transKey) !== '') {
            $ret = $transKey;
        } else {
            $key = translation::getTranslationKey($text);
            if (trim($key) !== '') {
                $transKey = translation::getTranslationString($key, self::$langugange);
                if (trim($transKey) !== '') {
                    $ret = $transKey;
                }
            }
        }

        return $ret;
    }

    public static function setLanguage(string $language)
    {
        self::$langugange = $language;
    }
}
