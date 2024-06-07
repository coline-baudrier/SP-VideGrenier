<?php

namespace App\Controllers;

use App\Models\Articles;
use \Core\View;
use Exception;
use App\Controllers\User;

/**
 * Home controller
 */
class Home extends \Core\Controller
{

    /**
     * Affiche la page d'accueil
     *
     * @return void
     * @throws \Exception
     */
    public function indexAction()
    {
        
        \App\Controllers\User::loginWithCookie(); //nom de la fonction des cookies

        View::renderTemplate('Home/index.html', []);
    }
}
