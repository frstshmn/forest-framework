<?php

abstract class Command {
    protected $entities = array();
    protected $target;
    protected $version;
    protected $value;

    public function run () {

        if ( in_array( $this->target, $this->entities ) ) {
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