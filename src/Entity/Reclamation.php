<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utl", type="integer", nullable=false)
     */
    private $idUtl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obj", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $obj = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="rec", type="string", length=200, nullable=false)
     */
    private $rec;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReclamation", type="date", nullable=false, options={"default"="current_timestamp()"})
     */
    private $datereclamation = 'current_timestamp()';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;


}
