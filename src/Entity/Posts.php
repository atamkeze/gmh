<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostsRepository::class)
 */
class Posts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $post_title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $post_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_filename;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="posts")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=ReplyComment::class, mappedBy="reply_comment_post")
     */
    private $replyComments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->replyComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPostTitle(): ?string
    {
        return $this->post_title;
    }

    public function setPostTitle(?string $post_title): self
    {
        $this->post_title = $post_title;

        return $this;
    }

    public function getPostDescription(): ?string
    {
        return $this->post_description;
    }

    public function setPostDescription(?string $post_description): self
    {
        $this->post_description = $post_description;

        return $this;
    }

    public function getPostFilename(): ?string
    {
        return $this->post_filename;
    }

    public function setPostFilename(string $post_filename): self
    {
        $this->post_filename = $post_filename;

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPosts($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPosts() === $this) {
                $comment->setPosts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReplyComment[]
     */
    public function getReplyComments(): Collection
    {
        return $this->replyComments;
    }

    public function addReplyComment(ReplyComment $replyComment): self
    {
        if (!$this->replyComments->contains($replyComment)) {
            $this->replyComments[] = $replyComment;
            $replyComment->setReplyCommentPost($this);
        }

        return $this;
    }

    public function removeReplyComment(ReplyComment $replyComment): self
    {
        if ($this->replyComments->removeElement($replyComment)) {
            // set the owning side to null (unless already changed)
            if ($replyComment->getReplyCommentPost() === $this) {
                $replyComment->setReplyCommentPost(null);
            }
        }

        return $this;
    }
}
