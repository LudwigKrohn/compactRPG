<?php
require "location.php";
require "entity.php";

// locations
$tavern = new Location("Tavern");
$forest = new Location("Forest");

// connections
$tavern->addConnection($forest);
$forest->addConnection($tavern);

// game state
$currentLocation = $tavern;
$player = new Entity("Player", 100, 5);

// helpers
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

// options
$travel = new Option("Travel", function() use (&$currentLocation) {
    echo "Where do you want to go?" . PHP_EOL;
    for ($i = 0; $i < count($currentLocation->getConnections()); $i++) {
        echo "{$i}: {$currentLocation->getConnections()[$i]->getName()}" . PHP_EOL;
    }
    $choice = readline("> ");
    $currentLocation = $currentLocation->getConnections()[(int)$choice];
});

$rest = new Option("Rest", function() use (&$player) {
    echo "You're fully rested and ready for an adventure!" . PHP_EOL . PHP_EOL;
    $player->setHp(100);
});

$retire = new Option("I don't want to be an adventurer anymore ):", function() {
    echo "Coward." . PHP_EOL . PHP_EOL;
    exit(1);
});

$battle = new Option("Battle", function() use (&$player) {
    $goblin = new Entity("Goblin", 15, 5);
    $orc = new Entity("Orc", 25, 15);
    $slime = new Entity("Slime", 20, 5);

    $enemyPool = [$goblin, $orc, $slime];
    $encounter = $enemyPool[rand(0, count($enemyPool) - 1)];

    while (true) {
        $choice = battleMenu($player, $encounter);

        switch ($choice) {
            case "1":
                battleAttack($player, $encounter);
                echo PHP_EOL . PHP_EOL;
                break;
            case "2":
                $player->setHp(100);
                echo "You're fully healed now." . PHP_EOL . PHP_EOL;
                break;
            case "3":
                echo "No shame in tactical retreat." . PHP_EOL . PHP_EOL;
                exit(1);
        }

        if ($encounter->getHp() <= 0) {
            echo "You defeated the {$encounter->getName()}!" . PHP_EOL;
            break;
        }
        elseif ($player->getHp() <= 0) {
            echo "Y O U  D I E D." . PHP_EOL;
            exit(1);
        }
    }
});

// tavern menu
$tavern->addOption($travel);
$tavern->addOption($rest);
$tavern->addOption($retire);

// forest menu
$forest->addOption($travel);
$forest->addOption($battle);

// game loop
while (true) {
    $currentLocation->pickOption();
}
