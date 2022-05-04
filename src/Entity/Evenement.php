<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_evt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_evt", type="string", length=255, nullable=false)
     */
    private $nomEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="description_evt", type="text", length=65535, nullable=false)
     */
    private $descriptionEvt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_evt", type="date", nullable=true, options={"default"="NULL"})
     */
    private $dateEvt = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="heure_evt", type="time", nullable=true, options={"default"="NULL"})
     */
    private $heureEvt = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_evt", type="text", length=65535, nullable=false)
     */
    private $lieuEvt;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie_evt", type="string", length=255, nullable=false)
     */
    private $categorieEvt;

    /**
     * @var int|null
     *
     * @ORM\Column(name="affiche_evt", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $afficheEvt = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var int|null
     *
     * @ORM\Column(name="places", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $places = NULL;


}
