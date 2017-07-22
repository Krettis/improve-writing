#!/usr/bin/env php
<?php

use ImproveWriting\Handler\Callback\Passive;
use ImproveWriting\Handler\FileHandler;
use ImproveWriting\Handler\PassiveHandler;

include 'startup.php';

$passive = Passive::create($messenger);

$messenger->output('Find passive words');
PassiveHandler::appendWordsFromFile(__DIR__ . '/data/locales/en/passive-words.txt');
FileHandler::setCallback($passive);
FileHandler::handle($fileName);
$messenger->output('----');
$messenger->send();
