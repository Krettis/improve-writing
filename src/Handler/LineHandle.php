<?php
namespace ImproveWriting\Handler;

interface LineHandle
{
    public function pushLine($content, $lineNumber);
}
