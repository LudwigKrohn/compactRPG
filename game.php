<?php

require_once "player.php";
require_once "location.php";

class Game {
    private Player $player;
    private Location $currentLocation;
    private bool $running = true;

    public function __construct(Player $player, Location $currentLocation) {
        $this->player = $player;
        $this->currentLocation = $currentLocation;
    }

    public function run(): void {
        echo "A new adventure begins..." . PHP_EOL;
        while ($this->running) {
            $this->currentLocation->promptAction($this);
        }
    }

    public function travel(Location $location): void {
        $this->currentLocation = $location;
        echo "You travel to {$location->getName()}." . PHP_EOL;
    }

    public function stop(): void {
        $this->running = false;
    }

    public function getPlayer(): Player { return $this->player; }
    public function getCurrentLocation(): Location { return $this->currentLocation; }   
}