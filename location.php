<?php
require "option.php";

class Location {
    private string $name;
    private array $connections = [];
    private array $options = [];

    function __construct(string $name) {
        $this->name = $name;
    }

    function addConnection(Location $loc) {
        $this->connections[] = $loc;
    }

    function addOption(Option $option) {
        $this->options[] = $option;
    }

    function pickOption() {
        echo "What do you want to do?" . PHP_EOL;
        for ($i = 0; $i < count($this->options); $i++) {
            echo "{$i}: {$this->options[$i]->getName()}" . PHP_EOL;
        }
        $choice = readline("> ");
        $this->options[(int)$choice]->execute();
    }

    function getConnections(): array {
        return $this->connections;
    }

    function getName(): string {
        return $this->name;
    }

    function setName(string $name) {
        $this->name = $name;
    }
}