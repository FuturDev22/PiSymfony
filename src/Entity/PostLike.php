<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostLike
 *
 * @ORM\Table(name="post_like", indexes={@ORM\Index(name="IDX_653627B87294869C", columns={"article_id"}), @ORM\Index(name="IDX_653627B8A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class PostLike
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
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;


}
