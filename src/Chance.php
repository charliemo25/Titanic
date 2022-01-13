<?php

namespace App;

use SplSubject;
use SplObserver;

class Chance implements SplObserver
{
    public function __construct(
        private array $data = []
    ) {
    }

    public function update(SplSubject $subject): void
    {
        $sex = $subject->sex === "female" ? "femme" : "homme";

        echo "chance de survis de " . $subject->name . " en tant que " . $sex . ": " . $this->data[$subject->sex]["survived"] . "\n\n";
    }
}
