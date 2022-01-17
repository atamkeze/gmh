<?php

namespace App\Entity;

use App\Repository\ReplyCommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReplyCommentRepository::class)
 */
class ReplyComment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reply_comment_message;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="replyComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reply_comment_user;

    /**
     * @ORM\ManyToOne(targetEntity=Posts::class, inversedBy="replyComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reply_comment_post;

    /**
     * @ORM\ManyToOne(targetEntity=Comments::class, inversedBy="replyComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reply_comment_cmt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReplyCommentMessage(): ?string
    {
        return $this->reply_comment_message;
    }

    public function setReplyCommentMessage(string $reply_comment_message): self
    {
        $this->reply_comment_message = $reply_comment_message;

        return $this;
    }

    public function getReplyCommentUser(): ?User
    {
        return $this->reply_comment_user;
    }

    public function setReplyCommentUser(?User $reply_comment_user): self
    {
        $this->reply_comment_user = $reply_comment_user;

        return $this;
    }

    public function getReplyCommentPost(): ?Posts
    {
        return $this->reply_comment_post;
    }

    public function setReplyCommentPost(?Posts $reply_comment_post): self
    {
        $this->reply_comment_post = $reply_comment_post;

        return $this;
    }

    public function getReplyCommentCmt(): ?Comments
    {
        return $this->reply_comment_cmt;
    }

    public function setReplyCommentCmt(?Comments $reply_comment_cmt): self
    {
        $this->reply_comment_cmt = $reply_comment_cmt;

        return $this;
    }
}
