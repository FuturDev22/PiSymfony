<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity
 */
class Projet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_projet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_projet", type="string", length=255, nullable=false)
     */
    private $nomProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieProj", type="string", length=255, nullable=false)
     */
    private $categorieproj;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_debut", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $dateDebut = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_fin", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $dateFin = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="montant_demandee", type="integer", nullable=false)
     */
    private $montantDemandee;

    /**
     * @var int
     *
     * @ORM\Column(name="montant_collecte", type="integer", nullable=false)
     */
    private $montantCollecte;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_projet", type="string", length=255, nullable=false)
     */
    private $etatProjet;


}
