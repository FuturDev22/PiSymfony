<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @Assert\NotBlank(message= "nom du projet doit être non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom de projet au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $nom_projet;

    /**
     * @Assert\NotBlank(message=" Categorie de projet doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un Categorie de projet au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     *
     */

    private $categorieProj;


    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     * @Assert\GreaterThan("today")
     *
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getDateDebut() < this.getDateFin()",
     *     message="La date fin ne doit pas être inférieure à la date début")
     *
     */
    private $date_fin;

    /**
     * @var integer|null
     * @Assert\NotBlank (message=" Le montant demandé doit etre non vide")
     * @ORM\Column(name="montant_demandee", type="integer", precision=10, scale=0, nullable=true)
     */
    private $montant_demandee;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="montant_collecte", type="integer", precision=10, scale=0, nullable=true)
     */
    private $montant_collecte;

    /**
     * @Assert\Choice({"Ouverture", "Collecte en cours","Clôture en cours"})
     *    message = "Choisir une valide etat de projet."
     * @ORM\Column(type="string", length=255)
     */
    private $etat_projet;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Categorieprojet::class, inversedBy="projets")
     */
    private $categories;







    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProjet(): ?string
    {
        return $this->nom_projet;
    }

    public function setNomProjet(string $nom_projet): self
    {
        $this->nom_projet = $nom_projet;

        return $this;
    }

    public function getCategorieProj(): ?string
    {
        return $this->categorieProj;
    }

    public function setCategorieProj(string $categorieProj): self
    {
        $this->categorieProj = $categorieProj;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getMontantDemandee(): ?int
    {
        return $this->montant_demandee;
    }

    public function setMontantDemandee(int $montant_demandee): self
    {
        $this->montant_demandee = $montant_demandee;

        return $this;
    }

    public function getMontantCollecte(): ?int
    {
        return $this->montant_collecte;
    }

    public function setMontantCollecte(int $montant_collecte): self
    {
        $this->montant_collecte = $montant_collecte;

        return $this;
    }

    public function getEtatProjet(): ?string
    {
        return $this->etat_projet;
    }

    public function setEtatProjet(string $etat_projet): self
    {
        $this->etat_projet = $etat_projet;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategories(): ?Categorieprojet
    {
        return $this->categories;
    }

    public function setCategories(?Categorieprojet $categories): self
    {
        $this->categories = $categories;

        return $this;
    }




}