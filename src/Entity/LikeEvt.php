<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikeEvt
 *
 * @ORM\Table(name="like_evt")
 * @ORM\Entity
 */
class LikeEvt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_like_evt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLikeEvt;

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
