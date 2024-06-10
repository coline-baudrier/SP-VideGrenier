<?php

// Exemple de middleware CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit; // Terminer le script si c'est une requête OPTIONS prévol
}

header('Content-Type: application/json');
readfile('../../public/swagger/openapi.json');