<?php

include 'filehandler.php';
include 'messaging.php';
$messenger = new Messaging();
$colors = new Colors();

if($argc !== 2){
  $messenger->output("usage: php " . $argv[0] . " [filename]");
  exit;
}

$fileName = $argv[1];

