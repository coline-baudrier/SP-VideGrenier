<?php

namespace App\Controllers;

use \Core\View;

/**
 * Legal controller
 */
class Legal extends \Core\Controller
{

    /**
     * Affiche les conditions générales de ventes
     *
     * @return void
     * @throws \Exception
     */
    public function termsOfSales()
    {

        View::renderTemplate('Legal/termsOfSales.html', []);
    }


    /**
     * Affiche les politiques de cookies
     *
     * @return void
     * @throws \Exception
     */
    public function termsCookies()
    {

        View::renderTemplate('Legal/termsCookies.html', []);
    }

    /**
     * Affiche les politiques de confidentialité
     *
     * @return void
     * @throws \Exception
     */
    public function termsConfidentiality()
    {

        View::renderTemplate('Legal/termsConfidentiality.html', []);
    }
}