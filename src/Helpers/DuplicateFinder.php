<?php

namespace ImproveWriting\Helpers;

class DuplicateFinder
{
    private static $lastWords = array();
    private static $listDuplicates = array();

    public static function check(array $words)
    {
        $found = [];
        foreach ($words as $key => $value) {
            if (in_array($value, self::$lastWords)) {
                $found[] = $value;
            }

            array_push(self::$lastWords, $value);
            if (count(self::$lastWords) > 2) {
                array_shift(self::$lastWords);
            }
        }

        return $found;
    }

    public static function getList()
    {
        return self::$listDuplicates;
    }
}
