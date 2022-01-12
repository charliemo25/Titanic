<?php

use App\ReadIterator;

require "vendor/autoload.php";

$iterator = new ReadIterator;
$fileName = __DIR__ . "/Data/titanic.csv";

$iterator->getSurvivors($fileName);

echo  "total: " . $iterator->persons . "\n";

echo  "survivant: " . $iterator->survivors . "\n";

echo "proportion de survivant: " . round(100 * $iterator->survivors / $iterator->persons, 2) . "% \n";

echo "_ _ _ _ _ _ \n\n";

$iterator->getSurvivorsSex($fileName);

echo "total d'hommes: " . $iterator->male["total"] . "\n";

echo "total d'hommes survivant': " . $iterator->male["survivors"] . "\n";

echo "proportion d'hommes survivant': " . round(100 * $iterator->male["survivors"] / $iterator->male["total"], 2) . "% \n\n";

// Femmes

echo "total de femmes: " . $iterator->female["total"] . "\n";

echo "total de femmes survivantes: " . $iterator->female["survivors"] . "\n";

echo "proportion de femmes survivantes: " . round(100 * $iterator->female["survivors"] / $iterator->female["total"], 2) . "% \n";
