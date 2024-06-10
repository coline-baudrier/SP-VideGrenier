<?php

namespace App\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Cities"
 * )
 */
class Cities {

    /**
     * @OA\Property(property="ville_id", type="integer", description="ID de la ville")
     * @var int
     */
    public $ville_id;

    /**
     * @OA\Property(property="ville_departement", type="string", description="Département de la ville")
     * @var string
     */
    public $ville_departement;

    /**
     * @OA\Property(property="ville_slug", type="string", description="Slug de la ville")
     * @var string
     */
    public $ville_slug;

    /**
     * @OA\Property(property="ville_nom", type="string", description="Nom de la ville")
     * @var string
     */
    public $ville_nom;

    /**
     * @OA\Property(property="ville_nom_simple", type="string", description="Nom simple de la ville")
     * @var string
     */
    public $ville_nom_simple;

    /**
     * @OA\Property(property="ville_nom_reel", type="string", description="Nom réel de la ville")
     * @var string
     */
    public $ville_nom_reel;

    /**
     * @OA\Property(property="ville_nom_soundex", type="string", description="Nom soundex de la ville")
     * @var string
     */
    public $ville_nom_soundex;

    /**
     * @OA\Property(property="ville_nom_metaphone", type="string", description="Nom metaphone de la ville")
     * @var string
     */
    public $ville_nom_metaphone;

    /**
     * @OA\Property(property="ville_code_postal", type="string", description="Code postal de la ville")
     * @var string
     */
    public $ville_code_postal;

    /**
     * @OA\Property(property="ville_commune", type="string", description="Commune de la ville")
     * @var string
     */
    public $ville_commune;

    /**
     * @OA\Property(property="ville_code_commune", type="string", description="Code commune de la ville")
     * @var string
     */
    public $ville_code_commune;

    /**
     * @OA\Property(property="ville_arrondissement", type="integer", description="Arrondissement de la ville")
     * @var int
     */
    public $ville_arrondissement;

    /**
     * @OA\Property(property="ville_canton", type="string", description="Canton de la ville")
     * @var string
     */
    public $ville_canton;

    /**
     * @OA\Property(property="ville_amdi", type="integer", description="AMDI de la ville")
     * @var int
     */
    public $ville_amdi;

    /**
     * @OA\Property(property="ville_population_2010", type="integer", description="Population de la ville en 2010")
     * @var int
     */
    public $ville_population_2010;

    /**
     * @OA\Property(property="ville_population_1999", type="integer", description="Population de la ville en 1999")
     * @var int
     */
    public $ville_population_1999;

    /**
     * @OA\Property(property="ville_population_2012", type="integer", description="Population de la ville en 2012")
     * @var int
     */
    public $ville_population_2012;

    /**
     * @OA\Property(property="ville_densite_2010", type="integer", description="Densité de la ville en 2010")
     * @var int
     */
    public $ville_densite_2010;

    /**
     * @OA\Property(property="ville_surface", type="number", format="float", description="Surface de la ville")
     * @var float
     */
    public $ville_surface;

    /**
     * @OA\Property(property="ville_longitude_deg", type="number", format="float", description="Longitude en degrés")
     * @var float
     */
    public $ville_longitude_deg;

    /**
     * @OA\Property(property="ville_latitude_deg", type="number", format="float", description="Latitude en degrés")
     * @var float
     */
    public $ville_latitude_deg;

    /**
     * @OA\Property(property="ville_longitude_grd", type="string", description="Longitude en GRD")
     * @var string
     */
    public $ville_longitude_grd;

    /**
     * @OA\Property(property="ville_latitude_grd", type="string", description="Latitude en GRD")
     * @var string
     */
    public $ville_latitude_grd;

    /**
     * @OA\Property(property="ville_longitude_dms", type="string", description="Longitude en DMS")
     * @var string
     */
    public $ville_longitude_dms;

    /**
     * @OA\Property(property="ville_latitude_dms", type="string", description="Latitude en DMS")
     * @var string
     */
    public $ville_latitude_dms;

    /**
     * @OA\Property(property="ville_zmin", type="integer", description="Altitude minimale")
     * @var int
     */
    public $ville_zmin;

    /**
     * @OA\Property(property="ville_zmax", type="integer", description="Altitude maximale")
     * @var int
     */
    public $ville_zmax;
}






















/**
 * @OA\Schema(
 *     schema="City",
 *     type="object",
 *     description="Ville",
 *     properties={
 *         @OA\Property(property="ville_id", type="integer", description="ID de la ville"),
 *         @OA\Property(property="ville_departement", type="string", description="Département de la ville"),
 *         @OA\Property(property="ville_slug", type="string", description="Slug de la ville"),
 *         @OA\Property(property="ville_nom", type="string", description="Nom de la ville"),
 *         @OA\Property(property="ville_nom_simple", type="string", description="Nom simple de la ville"),
 *         @OA\Property(property="ville_nom_reel", type="string", description="Nom réel de la ville"),
 *         @OA\Property(property="ville_nom_soundex", type="string", description="Nom soundex de la ville"),
 *         @OA\Property(property="ville_nom_metaphone", type="string", description="Nom metaphone de la ville"),
 *         @OA\Property(property="ville_code_postal", type="string", description="Code postal de la ville"),
 *         @OA\Property(property="ville_commune", type="string", description="Commune de la ville"),
 *         @OA\Property(property="ville_code_commune", type="string", description="Code commune de la ville"),
 *         @OA\Property(property="ville_arrondissement", type="integer", description="Arrondissement de la ville"),
 *         @OA\Property(property="ville_canton", type="string", description="Canton de la ville"),
 *         @OA\Property(property="ville_amdi", type="integer", description="AMDI de la ville"),
 *         @OA\Property(property="ville_population_2010", type="integer", description="Population de la ville en 2010"),
 *         @OA\Property(property="ville_population_1999", type="integer", description="Population de la ville en 1999"),
 *         @OA\Property(property="ville_population_2012", type="integer", description="Population de la ville en 2012"),
 *         @OA\Property(property="ville_densite_2010", type="integer", description="Densité de la ville en 2010"),
 *         @OA\Property(property="ville_surface", type="number", format="float", description="Surface de la ville"),
 *         @OA\Property(property="ville_longitude_deg", type="number", format="float", description="Longitude en degrés"),
 *         @OA\Property(property="ville_latitude_deg", type="number", format="float", description="Latitude en degrés"),
 *         @OA\Property(property="ville_longitude_grd", type="string", description="Longitude en GRD"),
 *         @OA\Property(property="ville_latitude_grd", type="string", description="Latitude en GRD"),
 *         @OA\Property(property="ville_longitude_dms", type="string", description="Longitude en DMS"),
 *         @OA\Property(property="ville_latitude_dms", type="string", description="Latitude en DMS"),
 *         @OA\Property(property="ville_zmin", type="integer", description="Altitude minimale"),
 *         @OA\Property(property="ville_zmax", type="integer", description="Altitude maximale")
 *     }
 * )
 */