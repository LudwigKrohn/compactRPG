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

    public function attack(Entity $target): void {
        echo "{$this->name} attacks {$target->name}." . PHP_EOL;
        $target->hp -= $this->damage;
        echo "{$target->name} takes {$this->damage} damage." . PHP_EOL . PHP_EOL;
    }

    public function isAlive(): bool { return $this->hp > 0; }
    public function getName(): string { return $this->name; }
    public function getHp(): int { return $this->hp; }
    public function getDamage(): int { return $this->damage; }

    protected function setHp(int $hp): void { $this->hp = $hp; }
}