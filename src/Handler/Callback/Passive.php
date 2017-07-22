<?php

namespace ImproveWriting\Handler\Callback;

use ImproveWriting\Handler\LineCallBack;
use ImproveWriting\Handler\PassiveHandler;

Class Passive extends LineCallBack
{

    public function pushLine($content, $lineNumber)
    {
        $pattern = PassiveHandler::getRegularExpression();
        preg_match($pattern, $content, $matches);
        if (!empty($matches)) {

            $this->output(
                'Found on line %INFO_STRONG%' . $lineNumber. '%INFO_STRONG%: ' .
                preg_replace($pattern, '%ERROR_STRONG%ditis leuk%ERROR_STRONG%', $content)
            );
        }
    }
}
