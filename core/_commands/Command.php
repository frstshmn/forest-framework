<?php

abstract class Command {
    protected $entities = array();
    protected $target;
    protected $version;
    protected $value;

    function __construct ( $target = null, $version = null, $value = null ) {

        if ( array_key_exists( $target, $this->entities ) ) {
            $this->target = $target;
            $this->version = $version;
            $this->value = $value;
        }

    }

    public function run () {

        if ( array_key_exists( $this->target, $this->entities ) ) {
            return $this->{$this->target}();
        } else {
            echo "Unknown command, see help below:";
            $this->help();
            return false;
        }

    }

    protected function help () {

        echo "\n";
        foreach ($this->entities as $name => $description) {
            echo "\t\e[32m" . $name . "\e[39m:\n";
            echo "\t\e[2m" . $description . "\e[22m\n\n";
        }

    }
}