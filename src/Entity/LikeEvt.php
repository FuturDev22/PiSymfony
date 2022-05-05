<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikeEvt
 *
 * @ORM\Table(name="like_evt", indexes={@ORM\Index(name="FK_7CE748AA76ED343", columns={"id_user"}), @ORM\Index(name="FK_7CE748AA76ED344", columns={"id_evt"})})
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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=true)
     * })
     */
    private $idUser;

    /**
     * @var \Evenement
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_evt", referencedColumnName="id_evt")
     * })
     */
    private $idEvt;
    public function getId(): ?int
    {
        return $this->idLikeEvt;
    }
    public function getIdUser(): ?Utilisateur
    {
        return $this->idUser;
    }

    public function setIdUser(?Utilisateur $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
    public function getIdEvt(): ?Evenement
    {
        return $this->idEvt;
    }

    public function setIdEvt(?Evenement $idEvt): self
    {
        $this->idEvt = $idEvt;

        return $this;
    }
    public function __toString1()
    {
        $format = "LikeEvt (id_evt: %s)\n";
        return sprintf($format, $this->id_evt);
    }
    public function __toString()
    {
        $format = "LikeEvt (id_user: %s)\n";
        return sprintf($format, $this->id_user);
    }

}
