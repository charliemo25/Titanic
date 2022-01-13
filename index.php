<?php

use App\Chance;
use App\DataService;
use App\Log;
use App\Model\Passenger;

require "vendor/autoload.php";

$generator = function (string $fileName) {
    $f = fopen($fileName, 'r');
    $count = 0;
    while (!feof($f)) {
        $line = fgetcsv($f);
        $count++;
        if (is_array($line) && $count > 1) {
            yield $line;
        }
    }
    fclose($f);
};

$counters = [
    "total" => 0,

    "male" => [
        "total" => 0,
        "survived" => 0,
        "class_1" => 0,
        "class_2" => 0,
        "class_3" => 0,
    ],
    "female" => [
        "total" => 0,
        "survived" => 0,
        "class_1" => 0,
        "class_2" => 0,
        "class_3" => 0,
    ],
];

foreach ($generator($fileName = __DIR__ . "/Data/titanic.csv") as $survivor) {
    $counters["total"]++;
    $sex = $survivor[4];
    $counters[$sex]["total"]++;

    if ($survivor[1]) {
        $class = $survivor[2];
        $counters[$sex]["survived"]++;
        $counters[$sex]["class_$class"]++;
    }
}

$dataService = new DataService();
$dataService->getSurvivorsStats($counters);

// Observers
$log = new Log($dataService->data);
$chance = new Chance($dataService->data);

foreach ($generator($fileName = __DIR__ . "/Data/titanic.csv") as $survivor) {

    // Passenger
    $passenger = new Passenger($survivor[0], $survivor[3], $survivor[1], $survivor[2], $survivor[4]);

    $passenger->attach($log);
    $passenger->attach($chance);
    $passenger->notify();
}


// print_r(DataService::getSurvivorsStats($counters));
