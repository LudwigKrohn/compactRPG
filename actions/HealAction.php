<?php

class HealAction implements Action {
    public function getLabel(): string { return "Rest"; }

    public function execute(Game $game): void {
        $game->getPlayer()->heal();
    }
}