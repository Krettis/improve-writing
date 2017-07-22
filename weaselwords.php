<?php
use ImproveWriting\Handler\Callback\Weasel;
use ImproveWriting\Handler\FileHandler;
use ImproveWriting\Handler\WeaselHandler;

include 'startup.php';

$passive = Weasel::create($messenger);

$messenger->output('Find weasel words');
WeaselHandler::appendWordsFromFile( __DIR__ . '/data/locales/en/weasel-words.txt');
FileHandler::setCallback($passive);
FileHandler::handle($fileName);
$messenger->output('----');
$messenger->send();
