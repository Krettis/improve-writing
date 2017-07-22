<?php

namespace ImproveWriting\Handler;

Class PassiveHandler
{
    private static $words = [];
    private static $irragulaRexExp = 'am|are|were|being|is|been|was|be';

    private static function appendWords(array $words)
    {
        self::$words = array_merge(self::$words, $words);
    }

    public static function appendWordsFromFile($fileName)
    {
        $lines = file($fileName);
        $words = array_filter(
            array_map(
                function ($var) {
                    return strtok($var, ' ');
                },
                array_map('trim', $lines)
            ),
            function ($line) {
                return !empty($line) ? true : false;
            }
        );

        self::appendWords($words);
    }

    public static function getWords()
    {
        return implode('|', self::$words);
    }

    public static function getRegularExpression()
    {
        return '/\s+(' . self::$irragulaRexExp . ')\s+(' . PassiveHandler::getWords() . ')/i';
    }
}

