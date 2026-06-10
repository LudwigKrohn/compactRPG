<?php

// imports
require_once "entity.php";
require_once "player.php";
require_once "action.php";
require_once "location.php";
require_once "game.php";
require_once "combat.php";
require_once "actions/TravelAction.php";
require_once "actions/HealAction.php";
require_once "actions/BattleAction.php";
require_once "actions/RetireAction.php";

// world map
$tavern = new Location("Tavern");
$forest = new Location("Forest");
$tavern->addConnection($forest);
$forest->addConnection($tavern);

// create all actions
$travel = new TravelAction();
$heal = new HealAction();
$battle = new BattleAction();
$retire = new RetireAction();

// wiring actions
$tavern->addAction($travel);
$tavern->addAction($heal);
$tavern->addAction($retire);

$forest->addAction($travel);
$forest->addAction($battle);

// start
$player = new Player("Adventurer", 100, 10);
$game = new Game($player, $tavern);
$game->run();