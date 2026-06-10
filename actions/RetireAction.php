<?php

class RetireAction implements Action {
    public function getLabel(): string { return "Retire"; }

    public function execute(Game $game): void {
        echo "Coward..." . PHP_EOL;
        $game->stop();
    }
}