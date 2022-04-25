<?php

namespace App\Entity;

use App\Repository\CategorieprojetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieprojetRepository::class)
 */
class Categorieprojet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message= "nom du categorie doit être non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom de catégorie au mini de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     *
     *
     */


    private $nom_CategorieProjet;

    /**
     * @ORM\OneToMany(targetEntity=Projet::class, mappedBy="categories")
     */
    private $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorieProjet(): ?string
    {
        return $this->nom_CategorieProjet;
    }

    public function setNomCategorieProjet(string $nom_CategorieProjet): self
    {
        $this->nom_CategorieProjet = $nom_CategorieProjet;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setCategories($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getCategories() === $this) {
                $projet->setCategories(null);
            }
        }

        return $this;
    }



}
