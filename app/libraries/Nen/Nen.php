<?php

namespace App\Libraries\Nen;

/**
 * Class Nen
 * @package App\Libraries\Nen
 */
class Nen
{
    /**
     * @param string $content
     *
     * @return string
     */
    public static function encode(string $content): string
    {
        $result  = $content;

        $number = 26;
        foreach (range('Z', 'A') as $letter) {
            $result = preg_replace("#'0" . ($number--). '([^0-9]*)#isU', strtoupper($letter) . '$1', $result);
        };

        $number = 26;
        foreach (range('z', 'a') as $letter) {
            $result = preg_replace("#'" . ($number--). '([^0-9]*)#isU', strtolower($letter) . '$1', $result);
        };

        $result = preg_replace("#'_#isu", ' ', $result);
        $result = preg_replace('#"([^"])#isu', '$1', $result);

        return $result;
    }

    /**
     * @param string $content
     *
     * @return string
     */
    public static function decode(string $content): string
    {
        $from = $to = [];

        foreach (range('a', 'z') as $letter) {
            $from[] = strtolower($letter);
        };

        foreach (range(1, 26) as $number) {
            $to[] = '\'' . $number;
        };

        foreach (range('A', 'Z') as $letter) {
            $from[] = strtoupper($letter);
        };

        foreach (range(1, 26) as $number) {
            $to[] = '\'0' . $number;
        };

        $from[] = ' ';
        $to[] = '\'_';

        return str_replace($from, $to, preg_replace('#([^a-z \n\r]+)#isu', '"$1', $content));
    }
}
