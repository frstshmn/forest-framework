<?php

require_once "Helper.php";

class Core {

    private string $version;
    private object $config;
    private object $routes;

    function __construct( $version ) {
        $this->version = $version;
        $this->config = $this->config();
        $this->routes = $this->routes();
    }

    function config(): object {
        return json_decode( file_get_contents( "../config.json" ) )->{$this->version};
    }

    function routes(): object {
        return json_decode( file_get_contents( helper()->api_folder() . $this->version . "/routes.json" ) );
    }


}

$core = new Core( "1.3" );

print_r( $core->config() );
