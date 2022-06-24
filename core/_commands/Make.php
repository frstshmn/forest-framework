<?php

require_once __DIR__ . "/../Helper.php";
require_once "Command.php";

class Make extends Command {

    protected $entities = array(
        "version" => "Creates folder for specified version\n\tExample: php tinker make version 1.0",
        "model" => "Creates model with specified name in specified version\n\tExample: php tinker make model 1.0 User",
        "controller" => "Creates controller with specified name in specified version\n\tExample: php tinker make controller 1.0 UserController",
    );

    function __construct ( $target = null, $version = null, $value = null ) {

        if ( array_key_exists( $target, $this->entities ) ) {
            $this->target = $target;
            $this->version = $version;
            $this->value = $value;
        }

    }

    function version () {
        if ( !is_dir( __DIR__ . "/../../api" ) ) {
            mkdir(__DIR__ . "/../../api");
        }

        helper()->recursive_copy(__DIR__ . "/../_templates/version/", __DIR__ . "/../../api/" . $this->version);
    }

    function model () {

        if ( !is_dir( __DIR__ . "/../../api/" . $this->version ) ) {
            $this->version();
        }

        $file = file_get_contents(__DIR__ . "/../_templates/model.txt" );

        $file = str_replace( '{{entity}}', strtolower( str_replace("Controller", "", $this->value ) ), $file );
        $file = str_replace( '{{Entity}}', ucfirst( str_replace("Controller", "", $this->value ) ), $file );

        $file = str_replace( '{{entities}}', strtolower( str_replace("Controller", "", helper()->plural_form( $this->value ) ) ), $file );
        $file = str_replace( '{{Entities}}', ucfirst( str_replace("Controller", "", helper()->plural_form( $this->value ) ) ), $file );

        file_put_contents(__DIR__ . "/../../api/" . $this->version . "/models/" . $this->value . ".php" , $file );

    }

    function controller () {

        if ( !is_dir( __DIR__ . "/../../api/" . $this->version ) ) {
            $this->version();
        }

        $file = file_get_contents(__DIR__ . "/../_templates/controller.txt" );

        $file = str_replace( '{{entity}}', strtolower( str_replace("Controller", "", $this->value ) ), $file );
        $file = str_replace( '{{Entity}}', ucfirst( str_replace("Controller", "", $this->value ) ), $file );

        file_put_contents(__DIR__ . "/../../api/" . $this->version . "/controllers/" . $this->value . ".php" , $file );

    }

}


