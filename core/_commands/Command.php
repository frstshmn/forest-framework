<?php

abstract class Command {
    protected $entities = array();
    protected $target;
    protected $version;
    protected $value;

    public function run () {
        return $this->{$this->target}();
    }

    protected function help () {
        return "help message";
    }
}