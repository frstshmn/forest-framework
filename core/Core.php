<?php

require_once "Helper.php";

class Core {

    private string $version;
    private object $config;

    function __construct( $version ) {
        $this->version = $version;
        $this->config = $this->config();
        $this->db_connect();
    }

    function config(): object {
        return json_decode( file_get_contents( "config.json" ) )->{$this->version};
    }

    function run_routes() {
        global $CORE_VERSION;
        $CORE_VERSION = $this->version;
        include ( helper()->api_folder() . $this->version . "/routes.php" );
    }

    function db_connect() {
        DB()->connect( $this->config->host, $this->config->user, $this->config->password, $this->config->database, $this->config->port);
    }

}