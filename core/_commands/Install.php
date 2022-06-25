<?php

require_once __DIR__ . "/../Helper.php";
require_once "Command.php";

class Install extends Command {

    protected $entities = array(
        "project" => "Creates all needed files to run the project\n\tExample: php tinker install project",
        "token" => "Installs token package\n\tExample: php tinker install token",
    );

    function project () {
        if ( !is_dir( __DIR__ . "/../../api" ) ) {
            mkdir(__DIR__ . "/../../api");
        }

        if ( !file_exists( __DIR__ . "/../../config.json" ) ) {
            copy(__DIR__ . "/../_templates/config.json", __DIR__ . "/../../config.json");
        }
    }

    function token () {}

}


