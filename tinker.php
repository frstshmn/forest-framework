<?php

$files = scandir("core/_commands/");

foreach ( $files as $key => $file ) {
    if ( $file == "Command.php" || $file == "." || $file == ".." ) {
        unset( $files[$key] );
    } else {
        $files[$key] = strtolower( substr( $file, 0, strrpos( $file, '.' ) ) );
    }
}

if ( in_array($argv[1], $files) ) {

    $command = ucfirst( $argv[1] );
    require_once "core/_commands/" . $command . ".php";

    $command = new $command( @$argv[2], @$argv[3], @$argv[4] );
    $command->run();

} else {
    echo "Unknown command, available variants:\n";
    foreach ($files as $file) {
        echo "\t\e[32m" . $file . "\e[39m:\n";
    }
}

