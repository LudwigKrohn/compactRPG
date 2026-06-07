<?php
require "entity.php";

$player = new Entity("Player", 100, 5);
$goblin = new Entity("Goblin", 20, 10);
$orc = new Entity("Orc", 25, 15);

$enemy_pool = [$goblin, $orc];

function battleMenu(Entity $player): string {
    while (true) {
        echo "***Current HP: {$player->getHp()}***" . PHP_EOL . "What will you do:" . PHP_EOL;
        echo "1. Fight" . PHP_EOL;
        echo "2. Heal." . PHP_EOL;
        echo "3. Run." . PHP_EOL;

        $choice = readline("> ");

        if (in_array($choice, ["1", "2", "3"], true)) {
            return $choice;
        }

        echo "Invalid choice.";
    }
}

while (true) {
    echo "***Current HP: {$player->getHp()}***" . PHP_EOL . "What will you do:" . PHP_EOL;
    echo "1. Fight." . PHP_EOL;
    echo "2. Rest." . PHP_EOL;
    echo "3. I don't wanna be an adventurer anymore ):" . PHP_EOL;
    $choice = readline("Choose wisely: ");

    switch($choice) {
        case "1":
            $encounter = (clone $enemy_pool[rand(0, count($enemy_pool) - 1)]);
            echo "Encountered {$encounter->getName()}!" . PHP_EOL;

            while ($player->getHp() > 0 && $encounter->getHp() > 0) {
                $player->attack($encounter);
                if ($encounter->getHp() > 0) {
                    $encounter->attack($player);
                }
            }

            if ($player->getHp() > 0 )
                echo "You win!" . PHP_EOL . PHP_EOL;
            break;
        case "2":
            $player->setHp(100);
            echo "You are fully rested and ready for a new adventure!" . PHP_EOL . PHP_EOL;
            break;
        case "3":
            echo "Coward..." . PHP_EOL . PHP_EOL;
            exit(1);
    }
    if ($player->getHp() <= 0) {
        echo "Y O U  D I E D." . PHP_EOL . PHP_EOL;
        break;
    }
}
