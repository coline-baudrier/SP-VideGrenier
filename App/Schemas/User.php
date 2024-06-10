<?php

namespace App\Schemas; 

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      schema="User"
 * )
 */

class User{

    /**
     * @OA\Property(property="id", type="integer", description="ID de l'utilisateur"),
     * @var int
     */
    public $id;

    /**
     *  @OA\Property(property="username", type="string", description="Nom d'utilisateur"),
     * @var string
     */
    public $username;

    /**
     * @OA\Property(property="email", type="string", description="Email de l'utilisateur"),
     * @var string
     */
    public $email;

    /**
     * @OA\Property(property="password", type="string", description="Mot de passe"),
     * @var string
     */
    public $password;

    /**
     * @OA\Property(property="salt", type="string", description="Sel pour le mot de passe"),
     * @var int
     */
    public $salt;

    /**
     * @OA\Property(property="is_admin", type="boolean", description="Indique si l'utilisateur est administrateur")
     * @var boolean
     */
    public $is_admin;



}
