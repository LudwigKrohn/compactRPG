<?php

class Option {
    private string $name;
    private $callback;

    function __construct(string $name, callable $callback) {
        $this->name = $name;
        $this->callback = $callback;
    }

    function execute() {
        return ($this->callback)();
    }

    function getName(): string {
        return $this->name;
    }

}