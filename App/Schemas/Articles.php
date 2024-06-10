<?php

namespace App\Schemas; 

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="Articles"
 * )
 */

class Articles{

    /**
     * @OA\Property(property="id", type="integer", description="ID de l'article")
     * @var int
     */
    public $id;

    /**
     *  @OA\Property(property="name", type="string", description="Nom de l'article")
     * @var string
     */
    public $name;

    /**
     *  @OA\Property(property="name", type="string", description="Nom de l'article")
     * @var string
     */
    public $description;

    /**
     * @OA\Property(property="published_date", type="string", format="date", description="Date de publication"),
     * @var date
     */
    public $published_date;

    /**
     * @OA\Property(property="user_id", type="integer", description="ID de l'utilisateur"),
     * @var int
     */
    public $user_id;

    /**
     * @OA\Property(property="views", type="integer", description="Nombre de vues"),
     * @var int
     */
    public $views;

    /**
     * @OA\Property(property="picture", type="string", description="URL de l'image")
     * @var string
     */
    public $picture;



}
