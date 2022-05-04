<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction", indexes={@ORM\Index(name="emetteur", columns={"emetteur"})})
 * @ORM\Entity
 */
class Transaction
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
     * @Assert\NotBlank(message="Veuillez choisir un type de transaction")
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;

    /**
     * @Assert\NotBlank(message="Veuillez saisir une valeur")
     * @Assert\PositiveOrZero(message="La valeur doit être positive")
     * @var int
     *
     * @ORM\Column(name="valeur", type="integer", nullable=false)
     */
    private $valeur;

    /**
     * @Assert\NotBlank(message="Veuillez choisir une date")
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @Assert\NotBlank(message="Veuillez saisir l'heure")
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="time", nullable=false)
     */
    private $heure;

    /**
     * @Assert\NotBlank(message="Veuillez saisir un identifiant")
     * @var int
     * @Assert\Length(
     *      min = 3,
     *      minMessage="Les identifiants contiennent au moins 3 caractères"
     *     )
     *
     * @ORM\Column(name="recepteur", type="integer", nullable=false)
     */
    private $recepteur;

    /**
     * @Assert\NotBlank(message="Veuillez choisir un identifiant")
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emetteur", referencedColumnName="id")
     * })
     */
    private $emetteur;

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
     * @return bool
     */
    public function isType(): ?bool
    {
        return $this->type;
    }

    /**
     * @param bool $type
     */
    public function setType(bool $type): void
    {
        $this->type = $type;
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
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getHeure(): ?\DateTime
    {
        return $this->heure;
    }

    /**
     * @param \DateTime $heure
     */
    public function setHeure(\DateTime $heure): void
    {
        $this->heure = $heure;
    }

    /**
     * @return int
     */
    public function getRecepteur(): ?int
    {
        return $this->recepteur;
    }

    /**
     * @param int $recepteur
     */
    public function setRecepteur(int $recepteur): void
    {
        $this->recepteur = $recepteur;
    }

    /**
     * @return Utilisateur
     */
    public function getEmetteur(): ?Utilisateur
    {
        return $this->emetteur;
    }

    /**
     * @param Utilisateur $emetteur
     */
    public function setEmetteur(Utilisateur $emetteur): void
    {
        $this->emetteur = $emetteur;
    }




}
