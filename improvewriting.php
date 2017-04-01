#!/usr/bin/env php
<?php

include 'startup.php';

passthru('php '. __DIR__. '/dups.php ' . $fileName);
passthru('php ' . __DIR__ . '/passivevoice.php ' . $fileName);
passthru('php ' . __DIR__ . '/weaselwords.php ' . $fileName);