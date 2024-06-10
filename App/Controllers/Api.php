<?php

namespace App\Controllers;

use App\Models\Articles;
use App\Models\Cities;
use App\Models\User;
use \Core\View;
use Exception;
use OpenApi\Annotations as OA;

/**
 *   @OA\Info(
 *     title="API de videgrenier",
 *     version="0.1")
 *   @OA\Server(
 *      url="https://localhost:8029"),
 *      description="API vide grenier"
 * )
 */
class Api extends \Core\Controller
{

    /**
     *   @OA\Get(
     *     path="/api/products",
     *     summary="Affiche la liste des articles / produits pour la page d'accueil",
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Critère de tri (views, date, perDay)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Articles"))
     *     )
     * )
     */
    public function ProductsAction()
    {
        $query = $_GET['sort'] ?? '';

        $articles = Articles::getAll($query);

        header('Content-Type: application/json');
        echo json_encode($articles);
    }

    /**
     *   @OA\Get(
     *     path="/api/users",
     *     summary="Affiche la liste des utilisateurs",
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Critère de tri",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des utilisateurs",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    public function UsersAction()
    {
        $query = $_GET['sort'] ?? '';

        $users = User::getAll($query);

        header('Content-Type: application/json');
        echo json_encode($users);
    }

    /**
     *   @OA\Get(
     *     path="/api/cities",
     *     summary="Recherche dans la liste des villes",
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         description="Critère de recherche",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des villes"
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Cities"))
     *     )
     * )
     */
    public function CitiesAction(){

        $cities = Cities::search($_GET['query']);

        header('Content-Type: application/json');
        echo json_encode($cities);
    }


    /**
     *   @OA\Get(
     *     path="/api/search",
     *     summary="Recherche des articles",
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Critère de recherche",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles trouvés",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Articles"))
     *     )
     * )
     */
    public function searchAction()
    {

        $query = $_GET['search'];

        $articles = Articles::search($query);

        header('Content-Type: application/json');
        echo json_encode($articles);
    }


}
