<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recharge
 *
 * @ORM\Table(name="recharge", indexes={@ORM\Index(name="benéficiaire", columns={"beneficiaire"})})
 * @ORM\Entity
 */
class Recharge
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="num_serie", type="string", length=255, nullable=false)
     */
    private $numSerie;

    /**
     * @var int
     *
     * @ORM\Column(name="valeur", type="integer", nullable=false)
     */
    private $valeur;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var bool
     *
     * @ORM\Column(name="validite", type="boolean", nullable=false)
     */
    private $validite;

    /**
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="beneficiaire", referencedColumnName="id")
     * })
     */
    private $beneficiaire;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNumSerie(): ?string
    {
        return $this->numSerie;
    }

    /**
     * @param string $numSerie
     */
    public function setNumSerie(string $numSerie): void
    {
        $this->numSerie = $numSerie;
    }

    /**
     * @return int
     */
    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    /**
     * @param int $valeur
     */
    public function setValeur(int $valeur): void
    {
        $this->valeur = $valeur;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return bool
     */
    public function isValidite(): ?bool
    {
        return $this->validite;
    }

    /**
     * @param bool $validite
     */
    public function setValidite(bool $validite): void
    {
        $this->validite = $validite;
    }

    /**
     * @return Utilisateur
     */
    public function getBeneficiaire(): ?Utilisateur
    {
        return $this->beneficiaire;
    }

    /**
     * @param Utilisateur $beneficiaire
     */
    public function setBeneficiaire(Utilisateur $beneficiaire): void
    {
        $this->beneficiaire = $beneficiaire;
    }




}
