<?php

namespace App;

class ReadIterator
{

    public int $persons = 0;
    public int $survivors = 0;
    public array $male = ["survivors" => 0, "total" => 0];
    public array $female = ["survivors" => 0, "total" => 0];

    /**
     * Récupère la proportion de survivants
     *
     * @param string $fileName
     * @return void
     */
    public function getSurvivors(string $fileName)
    {
        $f = fopen($fileName, 'r');
        while (!feof($f)) {

            $line = fgetcsv(
                $f
            );

            ++$this->persons;

            //TODO: Helper en-têtes
            if ($line[1])
                ++$this->survivors;
        }
        fclose($f);
    }

    /**
     * Récupère la proportion de survivant en fonction de leur sexe
     *
     * @param string $fileName
     * @return void
     */
    public function getSurvivorsSex(string $fileName)
    {
        $f = fopen($fileName, 'r');
        while (!feof($f)) {

            $line = fgetcsv(
                $f
            );

            if ($line[4] === "male") {
                ++$this->male["total"];

                $line[1] ? ++$this->male["survivors"] : null;
            } else {
                ++$this->female["total"];

                $line[1] ? ++$this->female["survivors"] : null;
            }
        }
        fclose($f);
    }

    /**
     * Récupère la proportion de survivant en fonction de leur classe et de leur sexe
     *
     * @param string $fileName
     * @return void
     */
    public function getSurvivorsClassSex(string $fileName)
    {
    }
}
