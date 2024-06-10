<?php

namespace App\Models;

use App\Utility\Hash;
use Core\Model;
use App\Core;
use Exception;
use App\Utility;
use OpenApi\Annotations as OA;

/**
 * City Model:
 */
class Cities extends Model {

    /**
     * @OA\Get(
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
     *         description="Liste des villes",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Cities"))
     *     )
     * )
     * @access public
     * @return string|boolean
     * @throws Exception
     */

    public static function search($str) {
        $db = static::getDB();

        $stmt = $db->prepare('SELECT ville_id FROM villes_france WHERE ville_nom_reel LIKE :query');

        $query = $str . '%';

        $stmt->bindParam(':query', $query);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_COLUMN, 0);
    }
}
