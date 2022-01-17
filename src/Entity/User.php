<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_of_birth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profile_photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover_photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $about_info;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pass;

    /**
     * @ORM\OneToMany(targetEntity=Posts::class, mappedBy="user")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\OneToOne(targetEntity=UserGallery::class, mappedBy="gallery_user", cascade={"persist", "remove"})
     */
    private $userGallery;

    /**
     * @ORM\ManyToOne(targetEntity=Following::class, inversedBy="following_user")
     */
    private $following;

    /**
     * @ORM\OneToMany(targetEntity=Followers::class, mappedBy="follower_user")
     */
    private $followers;

    /**
     * @ORM\OneToMany(targetEntity=ReplyComment::class, mappedBy="reply_comment_user")
     */
    private $replyComments;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->followers = new ArrayCollection();
        $this->replyComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getProfilePhoto(): ?string
    {
        return $this->profile_photo;
    }

    public function setProfilePhoto(?string $profile_photo): self
    {
        $this->profile_photo = $profile_photo;

        return $this;
    }

    public function getCoverPhoto(): ?string
    {
        return $this->cover_photo;
    }

    public function setCoverPhoto(?string $cover_photo): self
    {
        $this->cover_photo = $cover_photo;

        return $this;
    }

    public function getAboutInfo(): ?string
    {
        return $this->about_info;
    }

    public function setAboutInfo(?string $about_info): self
    {
        $this->about_info = $about_info;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @return Collection|Posts[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Posts $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Posts $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function getUserGallery(): ?UserGallery
    {
        return $this->userGallery;
    }

    public function setUserGallery(UserGallery $userGallery): self
    {
        // set the owning side of the relation if necessary
        if ($userGallery->getGalleryUser() !== $this) {
            $userGallery->setGalleryUser($this);
        }

        $this->userGallery = $userGallery;

        return $this;
    }

    public function getFollowing(): ?Following
    {
        return $this->following;
    }

    public function setFollowing(?Following $following): self
    {
        $this->following = $following;

        return $this;
    }

    /**
     * @return Collection|Followers[]
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    public function addFollower(Followers $follower): self
    {
        if (!$this->followers->contains($follower)) {
            $this->followers[] = $follower;
            $follower->setFollowerUser($this);
        }

        return $this;
    }

    public function removeFollower(Followers $follower): self
    {
        if ($this->followers->removeElement($follower)) {
            // set the owning side to null (unless already changed)
            if ($follower->getFollowerUser() === $this) {
                $follower->setFollowerUser(null);
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
            $replyComment->setReplyCommentUser($this);
        }

        return $this;
    }

    public function removeReplyComment(ReplyComment $replyComment): self
    {
        if ($this->replyComments->removeElement($replyComment)) {
            // set the owning side to null (unless already changed)
            if ($replyComment->getReplyCommentUser() === $this) {
                $replyComment->setReplyCommentUser(null);
            }
        }

        return $this;
    }
}
