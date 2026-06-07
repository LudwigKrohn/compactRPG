<?php
require "entity.php";

$player = new Entity("Player", 100, 5);
$goblin = new Entity("Goblin", 15, 10);
$orc = new Entity("Orc", 25, 15);
$slime = new Entity("Slime", 20, 5);

$enemyPool = [$goblin, $orc];

$game = true;

function getRandomEnemy(array $enemyPool): Entity {
    $randomEnemy = clone $enemyPool[rand(0, count($enemyPool) - 1)];
    return $randomEnemy;
}

function battleMenu(Entity $player, Entity $encounter): string {
    while (true) {
        echo strtoupper("*** Encounter: {$encounter->getName()} | HP: {$encounter->getHp()} ***") . PHP_EOL;
        echo "What will you do? | Current HP: {$player->getHp()} ". PHP_EOL;
        echo "1. Fight." . PHP_EOL;
        echo "2. Heal." . PHP_EOL;
        echo "3. Run." . PHP_EOL;

        $choice = readline("> ");

        if (in_array($choice, ["1", "2", "3"], true))
            return $choice;

        echo "Invalid input." . PHP_EOL;
    }
}

function battleAttack(Entity $player, Entity $enemy): void {
    $player->attack($enemy);
    if ($enemy->getHp() > 0) {
        $enemy->attack($player);
    }
}

$encounter = getRandomEnemy($enemyPool);

while ($game) {
    $choice = battleMenu($player, $encounter);

    switch ($choice) {
        case "1":
            battleAttack($player, $encounter);
            echo PHP_EOL . PHP_EOL;
            break;
        case "2":
            echo "Healing happening here." . PHP_EOL . PHP_EOL;
            exit(1);
        case "3":
            echo "No shame in tactical retreat." . PHP_EOL . PHP_EOL;
            exit(1);
    }

    if ($encounter->getHp() <= 0) {
        echo "You defeated the {$encounter->getName()}!" . PHP_EOL;

        $encounter = getRandomEnemy($enemyPool);
    }
}