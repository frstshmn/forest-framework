<?php

require_once "core/_commands/make.php";

$make = new Make( $argv[2], $argv[3], $argv[4] );
$make->run();

//echo "\n";
//print_r($argv);

