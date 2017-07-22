<?php

namespace ImproveWriting\Messaging;

interface Medium
{
    public function output($message);
    public function send();
}
