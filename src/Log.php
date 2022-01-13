<?php

namespace App;

use SplSubject;
use SplObserver;

class Log implements SplObserver
{
    public function __construct(
        private array $data = []
    ) {
    }

    public function update(SplSubject $subject): void
    {
        echo "chance de survis de " . $subject->name . ": " . $this->data[$subject->sex]["class_" . $subject->class] . "\n";
    }
}
