<?php

class BattleAction implements Action {
    public function getLabel(): string { return "Battle"; }

    public function execute(Game $game): void {
        $goblin = new Entity("Goblin", 15, 5);
        $orc = new Entity("Orc", 25, 15);
        $slime = new Entity("Slime", 20, 5);

        $enemyPool = [$goblin, $orc, $slime];
        $encounter = $enemyPool[rand(0, count($enemyPool) - 1)];

        $survived = (new Combat())->run($game->getPlayer(), $encounter);
        if (!$survived) {
            $game->stop();
        }
    }
}