<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorieprojet
 *
 * @ORM\Table(name="categorieprojet")
 * @ORM\Entity
 */
class Categorieprojet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_CategorieProjet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorieprojet;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_CategorieProjet", type="string", length=255, nullable=false)
     */
    private $nomCategorieprojet;


}
