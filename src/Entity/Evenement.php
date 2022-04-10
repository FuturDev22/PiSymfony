<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="FK_23A0E66CBAAAAB3", columns={"id_photo"}), @ORM\Index(name="FK_23A0E66CBAAAAB4", columns={"id_categorie"})})
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_evt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvt;

    /**
     * @var string
     *@Assert\NotBlank(message=" Titre doit être non vide !")
     * @Assert\Length(
     *     min = 3,
     *     minMessage=" Entrer un titre au minimum de 3 caracteres"
     *     )
     * @ORM\Column(name="nom_evt", type="string", length=255, nullable=false)
     */
    private $nomEvt;

    /**
     * @var string
     *@Assert\NotBlank(message=" Description doit être non vide !")
     * @Assert\Length(
     * min = 3,
     * max = 65535,
     * minMessage = "Description {{ value }} doit contenir au moins 3 caracteres",
     * maxMessage = "Description {{ value }} doit contenir au plus 65535 caracteres",
     * allowEmptyString = false
     * )
     * @ORM\Column(name="description_evt", type="text", length=65535, nullable=false)
     */
    private $descriptionEvt;

    /**
     * @var \DateTime
     *@Assert\NotBlank(message=" Date doit être  non vide !")
     *@Assert\GreaterThan("Today",message="Saisir date valide à partir de la date d'aujourd'hui")
     * @ORM\Column(name="date_evt", type="date", nullable=false)
     */
    private $dateEvt;

    /**
     * @var \DateTime
     *@Assert\NotBlank(message=" Heure doit être non vide !")
     *@Assert\Time
     * @ORM\Column(name="heure_evt", type="time", nullable=false)
     */
    private $heureEvt;

    /**
     * @var string
     *@Assert\NotBlank(message=" Lieu doit être non vide !")
     * @Assert\Length(
     * min = 3,
     * max = 200,
     * minMessage = "lieu doit contenir au moins 3 caracteres",
     * maxMessage = "lieu doit contenir au plus 200 caracteres",
     * allowEmptyString = false
     * )
     
     * @ORM\Column(name="lieu_evt", type="text", length=65535, nullable=false)
     */
    private $lieuEvt;

    /**
     * @var string
     *@Assert\NotBlank(message=" Email responsable doit être non vide !")
     *@Assert\Email( message=" adresse email non valide !")
         
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var int
     *@Assert\NotBlank(message=" Nombre de places doit être non vide !")
     * @Assert\Range(
     *      min = 1,
     *      max=100,
     *      minMessage = "Nombre de places doit être au moins 1 place",
     *      maxMessage = "Nombre de places doit être au maximum 100 places",
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(name="places", type="integer", nullable=false)
     */
    private $places;

    /**
     * @var \Photos
     *
     * @ORM\ManyToOne(targetEntity="Photos")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_photo", referencedColumnName="id_photo")
     * })
     */
    private $photo;

    /**
     * @var \Categorieevt
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorieevt" ,inversedBy="categorie")
     * @Assert\NotBlank(message=" Catégorie doit être non vide ! ")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_categorie", referencedColumnName="id_categorie")
     * })
     */
    private $categorie;

    public function getId(): ?int
    {
        return $this->idEvt;
    }

    public function getNomEvt(): ?string
    {
        return $this->nomEvt;
    }

    public function setNomEvt(string $nomEvt): self
    {
        $this->nomEvt = $nomEvt;

        return $this;
    }

    public function getDescriptionEvt(): ?string
    {
        return $this->descriptionEvt;
    }

    public function setDescriptionEvt(string $descriptionEvt): self
    {
        $this->descriptionEvt = $descriptionEvt;

        return $this;
    }

    public function getDateEvt(): ?\DateTimeInterface
    {
        return $this->dateEvt;
    }

    public function setDateEvt(?\DateTimeInterface $dateEvt): self
    {
        $this->dateEvt = $dateEvt;

        return $this;
    }

    public function getHeureEvt(): ?\DateTimeInterface
    {
        return $this->heureEvt;
    }

    public function setHeureEvt(?\DateTimeInterface $heureEvt): self
    {
        $this->heureEvt = $heureEvt;

        return $this;
    }

    public function getLieuEvt(): ?string
    {
        return $this->lieuEvt;
    }

    public function setLieuEvt(string $lieuEvt): self
    {
        $this->lieuEvt = $lieuEvt;

        return $this;
    }


    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    public function setResponsable(?string $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(?int $places): self
    {
        $this->places = $places;

        return $this;
    }
    public function getCategorie(): ?Categorieevt
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorieevt $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPhoto(): ?Photos
    {
        return $this->photo;
    }

    public function setPhotos(?Photos $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
    public function __toString()
    {
        $format = "Evenemment (id: %s, categorie_evt: %s, affiche_evt: %s, places: %s)\n";
        return sprintf($format, $this->id, $this->categorie_evt, $this->affiche_evt, $this->places);
    }

}
