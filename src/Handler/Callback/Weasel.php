<?php

namespace ImproveWriting\Handler\Callback;

use ImproveWriting\Handler\LineCallBack;
use ImproveWriting\Handler\WeaselHandler;

Class Weasel extends LineCallBack{

    public function pushLine($content, $lineNumber){
        $pattern = WeaselHandler::getRegularExpression();
        preg_match($pattern, $content, $matches);
        if(!empty($matches)){

            $this->output(
                'Found on line %INFO_STRONG%' . $lineNumber. '%INFO_STRONG%: ' .
                preg_replace($pattern, '%ERROR_STRONG%${0}%ERROR_STRONG%', $content)
            );
        }
    }
}
