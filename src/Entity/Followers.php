<?php

namespace App\Entity;

use App\Repository\FollowersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FollowersRepository::class)
 */
class Followers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="followers")
     */
    private $follower_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFollowerUser(): ?User
    {
        return $this->follower_user;
    }

    public function setFollowerUser(?User $follower_user): self
    {
        $this->follower_user = $follower_user;

        return $this;
    }
}
