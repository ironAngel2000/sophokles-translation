<?php
/**
 * Created by VS-Code
 * User: Bernd Wagner
 * Date: 06.03.2019
 * Time: 07:40.
 */

namespace Sophokles\Translation;

final class translation
{
    private static $arrTranslation;
    private static $arrTexts;

    private function __construct()
    {
    }

    public static function addTranslation(string $key, string $language, string $text)
    {
        if (!\is_array(self::$arrTranslation)) {
            self::$arrTranslation = [];
        }
        if (!\is_array(self::$arrTexts)) {
            self::$arrTexts = [];
        }

        self::$arrTranslation[$key][$language] = $text;
        self::$arrTexts[$text] = $key;
    }

    public static function getTranslationString(string $key, string $language): string
    {
        $ret = '';

        if (isset(self::$arrTranslation[$key][$language])) {
            $ret = self::$arrTranslation[$key][$language];
        }

        return $ret;
    }

    public static function getTranslationKey(string $text): string
    {
        $ret = '';

        if (isset(self::$arrTexts[$text])) {
            $ret = self::$arrTexts[$text];
        }

        return $ret;
    }

    public static function registerFile($jsonFile)
    {
        if (\is_file($jsonFile)) {
            $fmod = fopen($jsonFile, 'r');
            $jsonTxt = fread($fmod, \filesize($jsonFile));
            fclose($fmod);

            $arrJson = json_decode($jsonTxt, true);

            $srcLang = null;
            $trgLang = null;
            if (isset($arrJson['languages']['source'])) {
                $srcLang = $arrJson['languages']['source'];
            }
            if (isset($arrJson['languages']['target'])) {
                $trgLang = $arrJson['languages']['target'];
            }

            if (isset($arrJson['translations']) && is_array($arrJson['translations'])) {
                foreach ($arrJson['translations'] as $arrTrans) {
                    if (isset($arrTrans['key'])) {
                        $key = $arrTrans['key'];
                    } else {
                        $key = uniqid('', false);
                    }
                    if (isset($arrTrans['source']) && $srcLang) {
                        self::addTranslation($key, $srcLang, $arrTrans['source']);
                    }
                    if (isset($arrTrans['target']) && $trgLang) {
                        self::addTranslation($key, $trgLang, $arrTrans['target']);
                    }
                }
            }
        }
    }
}
