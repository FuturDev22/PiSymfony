<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeslikeEvt
 *
 * @ORM\Table(name="deslike_evt")
 * @ORM\Entity
 */
class DeslikeEvt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_deslike_evt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDeslikeEvt;

    /**
     * @var int
     *
     * @ORM\Column(name="id_evt", type="integer", nullable=false)
     */
    private $idEvt;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;


}
