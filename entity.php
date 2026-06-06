<?php

class Entity {
    private string $name;
    private int $hp;
    private int $damage;

    function __construct(string $name, int $hp, int $damage) {
        $this->name = $name;
        $this->hp = $hp;
        $this->damage = $damage;
    }

    public function attack(Entity $target) {
        echo "{$this->getName()} attacks {$target->getName()}." . PHP_EOL;
        $target->setHp($target->getHp() - $this->getDamage());
        echo "{$target->getName()} takes {$this->getDamage()} damage." . PHP_EOL;
    }

    function getName(): string {
        return $this->name;
    }

    function getHp(): int {
        return $this->hp;
    } 
    function getDamage(): int {
        return $this->damage;
    }

    function setName(string $name) {
        $this->name = $name;
    }

    function setHp(int $hp) {
        $this->hp = $hp;
    } 
    function setDamage(int $damage) {
        $this->damage = $damage;
    }
}