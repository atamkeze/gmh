<?php

namespace App\Entity;

use App\Repository\PostReactionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostReactionsRepository::class)
 */
class PostReactions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $post_like;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $post_hate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostLike(): ?int
    {
        return $this->post_like;
    }

    public function setPostLike(?int $post_like): self
    {
        $this->post_like = $post_like;

        return $this;
    }

    public function getPostHate(): ?int
    {
        return $this->post_hate;
    }

    public function setPostHate(?int $post_hate): self
    {
        $this->post_hate = $post_hate;

        return $this;
    }
}
