<?php

namespace App\Model;

class Passenger
{
    public function __construct(
        private int $id,
        private bool $survived,
        private int $class,
        private string $name,
        private string $sex,
        private ?int $age = null,
        private int $sibSp,
        private int $parch,
        private string $ticket,
        private float $fare,
        private ?string $cabin = null,
        private ?string $embarked = null
    ) {
    }
}
