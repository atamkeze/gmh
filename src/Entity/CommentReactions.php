<?php

namespace App\Entity;

use App\Repository\CommentReactionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentReactionsRepository::class)
 */
class CommentReactions
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
    private $comment_like;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentLike(): ?int
    {
        return $this->comment_like;
    }

    public function setCommentLike(?int $comment_like): self
    {
        $this->comment_like = $comment_like;

        return $this;
    }
}
