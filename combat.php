<?php

require_once "entity.php";
require_once "player.php";

class Combat {
    public function run(Player $player, Entity $enemy): bool {
        echo PHP_EOL . strtoupper("*** Encounter: {$enemy->getName()} | HP: {$enemy->getHp()} ***") . PHP_EOL;
        
        while ($player->isAlive() && $enemy->isAlive()) {
            echo "What will you do? | Current HP: {$player->getHp()} ". PHP_EOL;
            echo "1. Fight." . PHP_EOL . "2. Heal." . PHP_EOL . "3. Run." . PHP_EOL;

            switch (trim(readline("> "))) {
                case "1":
                    $player->attack($enemy);
                    if ($enemy->isAlive()) $enemy->attack($player);
                    break;
                case "2":
                    $player->heal();
                    $enemy->attack($player);
                    break;
                case "3":
                    echo "No shame in tactical retreat!" . PHP_EOL;
                    return true;
                default:
                    echo "Invalid choice." . PHP_EOL;
            }
        }

        if (!$player->isAlive()) {
            echo "Y O U  D I E D." . PHP_EOL;
            return false;
        }

        echo "You defeated the {$enemy->getName()}!" . PHP_EOL;
        return true;
    }
}