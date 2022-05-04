<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="forum")
 * @ORM\Entity
 */
class Forum
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_frm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFrm;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utl", type="integer", nullable=false)
     */
    private $idUtl;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_frm", type="string", length=220, nullable=false)
     */
    private $contenuFrm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_frm", type="date", nullable=false, options={"default"="current_timestamp()"})
     */
    private $dateFrm = 'current_timestamp()';

    /**
     * @var int
     *
     * @ORM\Column(name="report", type="integer", nullable=false)
     */
    private $report;

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer", nullable=false)
     */
    private $likes;


}
