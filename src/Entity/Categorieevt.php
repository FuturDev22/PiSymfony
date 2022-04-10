<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorieevt
 *
 * @ORM\Table(name="categorieevt")
 * @ORM\Entity
 */
class Categorieevt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *@Assert\NotBlank(message=" nom catégorie doit être non vide !")
     * @Assert\Length(
     *     min = 3,
     *     minMessage=" Entrer un nom au minimum de 3 caracteres"
     *     )
     * @ORM\Column(name="nom_categorie", type="string", length=255, nullable=false)
     */
    private $nomCategorie;

    public function getId(): ?int
    {
        return $this->idCategorie;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(?string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }
    public function __toString()
    {
        $format = "Categorieevt (id: %s, nomCategorie: %s)\n";
        return sprintf($format, $this->id, $this->nomCategorie);
    }
}
