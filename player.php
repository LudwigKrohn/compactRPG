<?php

require_once "entity.php";

class Player extends Entity {
    private int $maxHp;

    public function __construct(string $name, int $hp, int $damage) {
        parent::__construct($name, $hp, $damage);
        $this->maxHp = $hp;
    }

    public function heal(): void {
        $this->setHp($this->maxHp);
        echo "You're fully healed ({$this->maxHp} HP)." . PHP_EOL;
    }
}