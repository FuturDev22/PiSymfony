<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="FK_7CE748AA76ED345", columns={"id_user"}), @ORM\Index(name="FK_7CE748AA76ED346", columns={"id_evt"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_participation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParticipation;

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
        return $this->idParticipation;
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
}
