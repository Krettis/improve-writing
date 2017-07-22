<?php

use ImproveWriting\Helpers\Colors;
use ImproveWriting\Messaging\Messenger;

require_once 'vendor/autoload.php';

$messenger = new Messenger(Messenger::CLI);

if ($argc !== 2) {
    $messenger->output("usage: php " . $argv[0] . " [filename]");
    exit;
}

$fileName = $argv[1];

