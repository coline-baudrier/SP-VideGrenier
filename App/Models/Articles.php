<?php

namespace App\Models;

use Core\Model;
use App\Core;
use DateTime;
use Exception;
use App\Utility;
use \PDO;
use OpenApi\Annotations as OA;

/**
 * Articles Model
 */
class Articles extends Model {

    /**
     * @OA\Get(
     *     path="/articles",
     *     summary="Récupère tous les articles",
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Filtre pour trier les articles (views, date, perDay)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Articles")),
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getAll($filter) {
        $db = static::getDB();

        $query = 'SELECT * FROM articles ';

        $aujourdhui = date('Y-m-d'); // Obtenir la date du jour au format YYYY-MM-DD

        switch ($filter){
            case 'views':
                $query .= ' ORDER BY articles.views DESC';
                break;
            case 'date':
                $query .= ' ORDER BY articles.published_date DESC';
                break;
            case 'perDay':
                $query .= ' WHERE DATE(articles.published_date) = "' . $aujourdhui . '"';
                break;
            case '':
                break;
        }
        
        $stmt = $db->query($query);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Get(
     *     path="/api/articles/search",
     *     summary="Recherche des articles",
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         description="Critère de recherche",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Liste des articles trouvés",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Articles")),
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function search($q)
    {
        $db = static::getDB();

        $query = "SELECT *, articles.id as id FROM articles
        INNER JOIN users ON articles.user_id = users.id
        WHERE articles.name LIKE :q OR articles.description LIKE :q";

        $stmt = $db->prepare($query);

        $stmt->bindValue(':q', '%'.$q.'%', PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Get(
     *     path="/articles/{id}",
     *     summary="Récupère un article par ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'article",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Détails de l'article",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Articles")),
     * 
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getOne($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT * FROM articles
            INNER JOIN users ON articles.user_id = users.id
            WHERE articles.id = ? 
            LIMIT 1');

        $stmt->execute([$id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Patch(
     *     path="/api/articles/{id}/views",
     *     summary="Ajoute une vue à un article",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'article",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Nombre de vues mis à jour"
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function addOneView($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            UPDATE articles 
            SET articles.views = articles.views + 1
            WHERE articles.id = ?');

        $stmt->execute([$id]);
    }

    /**
     * @OA\Get(
     *     path="/api/articles/user/{id}",
     *     summary="Récupère les articles par utilisateur",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de l'utilisateur",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Articles de l'utilisateur",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Articles"))
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getByUser($id) {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT *, articles.id as id FROM articles
            LEFT JOIN users ON articles.user_id = users.id
            WHERE articles.user_id = ?');

        $stmt->execute([$id]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @OA\Get(
     *     path="/api/articles/suggest",
     *     summary="Récupère les articles suggérés",
     *     @OA\Response(
     *         response=200,
     *         description="Articles suggérés",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Articles"))
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function getSuggest() {
        $db = static::getDB();

        $stmt = $db->prepare('
            SELECT *, articles.id as id FROM articles
            INNER JOIN users ON articles.user_id = users.id
            ORDER BY published_date DESC LIMIT 10');

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }



    /**
     * @OA\Post(
     *     path="/api/articles",
     *     summary="Crée un nouvel article",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Articles")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Article créé",
     *         @OA\JsonContent(ref="#/components/schemas/Articles")
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */
    public static function save($data) {
        $db = static::getDB();

        $stmt = $db->prepare('INSERT INTO articles(name, description, user_id, published_date) VALUES (:name, :description, :user_id,:published_date)');

        $published_date =  new DateTime();
        $published_date = $published_date->format('Y-m-d');
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':published_date', $published_date);
        $stmt->bindParam(':user_id', $data['user_id']);

        $stmt->execute();

        return $db->lastInsertId();
    }


    /**
     * @OA\Patch(
     *     path="/api/articles/{articleId}/picture",
     *     summary="Ajoute une image à un article",
     *     @OA\Parameter(
     *         name="articleId",
     *         in="path",
     *         description="ID de l'article",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="pictureName", type="string", description="Nom de l'image")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Image ajoutée"
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */

    public static function attachPicture($articleId, $pictureName){
        $db = static::getDB();

        $stmt = $db->prepare('UPDATE articles SET picture = :picture WHERE articles.id = :articleid');

        $stmt->bindParam(':picture', $pictureName);
        $stmt->bindParam(':articleid', $articleId);


        $stmt->execute();
    }

    public static function testDBConnection() {
        $db = static::getDB();
    }


}

