<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once("api/Loader.php");

$uri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

$loader = Loader::getInstance();

if ( $uri[1] == "dev" ) {
    $loader->loadConfig( "dev" );
    $entity = $uri[2];

} else {
    $loader->loadConfig( "live" );
    $entity = $uri[1];
}

$entity = explode('?', $entity);

$api = $loader->loadController( $entity[0] );

echo $api->run();