<?php

namespace App\Entity;

use App\Repository\FollowingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FollowingRepository::class)
 */
class Following
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="following")
     */
    private $following_user;

    public function __construct()
    {
        $this->following_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getFollowingUser(): Collection
    {
        return $this->following_user;
    }

    public function addFollowingUser(User $followingUser): self
    {
        if (!$this->following_user->contains($followingUser)) {
            $this->following_user[] = $followingUser;
            $followingUser->setFollowing($this);
        }

        return $this;
    }

    public function removeFollowingUser(User $followingUser): self
    {
        if ($this->following_user->removeElement($followingUser)) {
            // set the owning side to null (unless already changed)
            if ($followingUser->getFollowing() === $this) {
                $followingUser->setFollowing(null);
            }
        }

        return $this;
    }
}
