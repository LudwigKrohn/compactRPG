<?php

class TravelAction implements Action {
    public function getLabel(): string { return "Travel"; }

    public function execute(Game $game): void {
        $connections = $game->getCurrentLocation()->getConnections();

        if (empty($connections)) {
            echo "There's nowhere to go from here." . PHP_EOL;
            return;
        }

        echo PHP_EOL . "Where do you want to go?" . PHP_EOL;
        foreach ($connections as $i => $location) {
            echo " {$i}: {$location->getName()}" . PHP_EOL;
        }

        $input = trim(readline("> "));
        if (ctype_digit($input) && isset($connections[(int)$input])) {
            $game->travel($connections[(int)$input]);
        } else {
            echo "Invalid desitination." . PHP_EOL;
        }
    }
}