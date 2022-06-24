<?php

require_once __DIR__ . "/../Helper.php";
require_once "Command.php";

class Make extends Command {

    protected $entities = array(
        "version",
        "model",
        "controller",
    );

    function __construct ( $target, $version, $value = false ) {

        if ( in_array( $target, $this->entities ) ) {
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


