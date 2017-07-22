<?php

use ImproveWriting\Handler\Callback\Duplicate;
use ImproveWriting\Handler\FileHandler;

include 'startup.php';

$duplicates = Duplicate::create($messenger);

$messenger->output('Duplicate finder');
FileHandler::setCallback($duplicates);
FileHandler::handle($fileName);
$messenger->output('----');
$messenger->send();
