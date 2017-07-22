<?php
namespace ImproveWriting\Handler\Callback;

use ImproveWriting\Handler\LineCallBack;
use ImproveWriting\Helpers\DuplicateFinder;

Class Duplicate extends LineCallBack
{
    public function pushLine($content, $lineNumber)
    {
        if (empty($content)) {
            return false;
        }
        $words = explode(' ', $content);
        if (!empty($words)) {
            $result = DuplicateFinder::check($words);
            if (!empty($result)) {
                $pattern = '/' . implode('|', $result) . '/';

                $lineColored = preg_replace(
                    $pattern,
                    '%ERROR_STRONG%${0}%ERROR_STRONG%',
                    substr($content, 0, -1)
                );

                $this->output(
                    'Found on line %INFO_STRONG%' . $lineNumber. '%INFO_STRONG%: ' .
                    $lineColored);
            }
        }
    }
}
