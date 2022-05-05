<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
<<<<<<< HEAD
 * @ORM\Table(name="utilisateur")
=======
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1D1C63B3E7927C74", columns={"email"})})
>>>>>>> b3779b0642f60ccc4446ed8f728136a6c938925b
 * @ORM\Entity
 */
class Utilisateur
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
<<<<<<< HEAD
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
=======
     * @ORM\Column(name="email", type="string", length=180, nullable=false)
>>>>>>> b3779b0642f60ccc4446ed8f728136a6c938925b
     */
    private $email;

    /**
<<<<<<< HEAD
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
=======
     * @var array
     *
     * @ORM\Column(name="roles", type="json", nullable=true)
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
>>>>>>> b3779b0642f60ccc4446ed8f728136a6c938925b
     */
    private $password;

    /**
     * @var string
     *
<<<<<<< HEAD
     * @ORM\Column(name="usertype", type="string", length=255, nullable=false)
     */
    private $usertype;

=======
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_blocked", type="boolean", nullable=true)
     */
    private $isBlocked;

    /**
     * @var float
     *
     * @ORM\Column(name="solde", type="float", precision=10, scale=0, nullable=true)
     */
    private $solde;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usertype", type="string", length=255, nullable=true)
     */
    private $usertype;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reset_token", type="string", length=255, nullable=true)
     */
    private $resetToken;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;
    
>>>>>>> b3779b0642f60ccc4446ed8f728136a6c938925b
    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

=======
>>>>>>> b3779b0642f60ccc4446ed8f728136a6c938925b
    public function getEmail(): ?string
    {
        return $this->email;
    }

<<<<<<< HEAD
    public function setEmail(string $email): self
=======
    public function setEmail(?string $email): self
>>>>>>> b3779b0642f60ccc4446ed8f728136a6c938925b
    {
        $this->email = $email;

        return $this;
    }

<<<<<<< HEAD
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsertype(): ?string
    {
        return $this->usertype;
    }

    public function setUsertype(string $usertype): self
    {
        $this->usertype = $usertype;

        return $this;
    }


=======
>>>>>>> b3779b0642f60ccc4446ed8f728136a6c938925b
}
