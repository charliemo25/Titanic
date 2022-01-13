<?php

namespace App;

class DataService
{

    public function __construct(
        public array $data = []
    ) {
    }

    public function getSurvivorsStats($data): array
    {

        extract($data);

        $stats = [
            "total" => self::getRate(($data["male"]["survived"] + $data["female"]["survived"]), $data["total"]),
        ];

        foreach (["male", "female"] as $sex) {
            $stats[$sex]["survived"] = self::getRate($data[$sex]["survived"], $data[$sex]["total"]);
            foreach (["class_1", "class_2", "class_3"] as $class) {
                $stats[$sex][$class] = self::getRate($data[$sex][$class], $data[$sex]["total"]);
            }
        }

        $this->data = $stats;

        return $stats;
    }

    public static function getRate($dividend, $divisor)
    {
        return round((100 * $dividend / $divisor), 2) . " %";
    }
}
