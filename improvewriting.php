#!/usr/bin/env php
<?php

include 'startup.php';

passthru('php dups.php ' . $fileName);
passthru('php passivevoice.php ' . $fileName);
passthru('php weaselwords.php ' . $fileName);