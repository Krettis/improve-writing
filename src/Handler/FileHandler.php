<?php

namespace ImproveWriting\Handler;

Class FileHandler
{

    private static $callback = null;

    public static function setCallback(LineCallBack $callback)
    {
        self::$callback = $callback;
    }

    public static function handle($fileName)
    {

        if (!file_exists($fileName)) {
            throw new Exception('File does not exist');
        }

        $handle = fopen($fileName, "r");
        if ($handle) {
            $lineNumber = 0;
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                $lineNumber++;
                $trimmedLine = preg_replace(
                    '/\s+/', ' ', trim($line)
                );
                self::$callback->pushLine($trimmedLine, $lineNumber);
            }

            fclose($handle);
        } else {
            // error opening the file.
            throw new Exception('Could not handle opening file');
        }
    }
}



