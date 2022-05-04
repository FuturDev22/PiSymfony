<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
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
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $nom = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $telephone = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $email = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $password = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="usertype", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $usertype = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="isBlocked", type="boolean", nullable=false)
     */
    private $isblocked = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="solde", type="float", precision=10, scale=0, nullable=true)
     */
    private $solde = '0';

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
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return int|null
     */
    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    /**
     * @param int|null $telephone
     */
    public function setTelephone(?int $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getUsertype(): ?string
    {
        return $this->usertype;
    }

    /**
     * @param string|null $usertype
     */
    public function setUsertype(?string $usertype): void
    {
        $this->usertype = $usertype;
    }

    /**
     * @return bool
     */
    public function isIsblocked()
    {
        return $this->isblocked;
    }

    /**
     * @param bool $isblocked
     */
    public function setIsblocked($isblocked): void
    {
        $this->isblocked = $isblocked;
    }

    /**
     * @return float|null
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * @param float|null $solde
     */
    public function setSolde($solde): void
    {
        $this->solde = $solde;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getId();
    }


}
