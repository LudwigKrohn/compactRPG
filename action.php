<?php

interface Action {
    public function getLabel(): string;
    public function execute(Game $game): void;
}