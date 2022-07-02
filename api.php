<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

echo "<pre>";

require_once("core/load.php");

$uri = explode( '?', trim( $_SERVER['REQUEST_URI'],'/') );
$uri = explode( '/', $uri[0]);

$core = new Core( $uri[1] );

$core->run_routes();