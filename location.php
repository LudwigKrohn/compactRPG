<?php

require_once "action.php";

class Location {
    private string $name;
    private array $connections = [];
    private array $actions = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function addConnection(Location $location): void {
        $this->connections[] = $location;
    }

    public function addAction(Action $action) {
        $this->actions[] = $action;
    }

    public function promptAction(Game $game): void {
        echo PHP_EOL . "*** {$this->name} ***" . PHP_EOL;
        foreach ($this->actions as $i => $action) {
            echo "{$i}: {$action->getLabel()}" . PHP_EOL;
        }

        $choice = $this->readInt(0, count($this->actions) - 1);
        $this->actions[$choice]->execute($game);
    }

    private function readInt(int $min, int $max): int {
        while (true) {
            $input = trim(readline("> "));
            if (ctype_digit($input) && (int)$input >= $min && (int)$input <= $max) {
                return (int)$input;
            }
            echo "Enter a number between {$min} and {$max}." . PHP_EOL;
        }
    }

    public function getConnections(): array { return $this->connections; }
    public function getName(): string { return $this->name; }
}