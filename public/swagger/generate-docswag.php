<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php'; // __DIR__, 2 => car on remonte de 2 niveaux depuis le répertoire swagger pour inclure l'autoloader de Composer

use OpenApi\Generator;

// Chemin vers les répertoires contenant les contrôleurs et modèles annotés pour la doc swagger
$openapi = Generator::scan([dirname(__DIR__, 2) . '/App/Controllers', dirname(__DIR__, 2) . '/App/Models']);

header('Content-Type: application/x-yaml');
echo $openapi->toYaml();