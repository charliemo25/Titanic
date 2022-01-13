<?php

namespace App\Model;

use SplObserver;
use SplSubject;

class Passenger implements SplSubject
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $survived,
        public int $class,
        public string $sex,
        public array $observers = []
    ) {
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers[get_class($observer)] = $observer;
    }

    public function detach(SplObserver $observer): void
    {
        unset($this->observers[get_class($observer)]);
    }

    public function notify(): void
    {
        foreach ($this->observers as $key => $observer) {
            $observer->update($this);
        }
    }
}
