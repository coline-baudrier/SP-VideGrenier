<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

use App\Models\Articles;

session_start();

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';




/**
 * Error and Exception handling
 */
require __DIR__ . '../../Core/Error.php';
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('login', ['controller' => 'User', 'action' => 'login']);
$router->add('register', ['controller' => 'User', 'action' => 'register']);
$router->add('reset', ['controller' => 'User', 'action' => 'reset']);
$router->add('logout', ['controller' => 'User', 'action' => 'logout', 'private' => true]);
$router->add('account', ['controller' => 'User', 'action' => 'account', 'private' => true]);
$router->add('terms-of-sales', ['controller' => 'Legal', 'action' => 'termsOfSales']);
$router->add('terms-of-cookies', ['controller' => 'Legal', 'action' => 'termsCookies']);
$router->add('terms-of-confidentiality', ['controller' => 'Legal', 'action' => 'termsConfidentiality']);
$router->add('product', ['controller' => 'Product', 'action' => 'index', 'private' => true]);
$router->add('product/{id:\d+}', ['controller' => 'Product', 'action' => 'show']);
$router->add('{controller}/{action}');

/*
 * Gestion des erreurs dans le routing
 */
try {
    $router->dispatch($_SERVER['QUERY_STRING']);
} catch(Exception $e){
    switch($e->getMessage()){
        case 'You must be logged in':
            header('Location: /login');
            break;
    }
}

//
//try {
//    Articles::testDBConnection();
//    echo "Connexion réussie à la base de données.";
//} catch (PDOException $e) {
//    die("Erreur de connexion à la base de données : " . $e->getMessage());
//}
