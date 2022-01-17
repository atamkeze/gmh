<?php

namespace App\Entity;

use App\Repository\UserGalleryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserGalleryRepository::class)
 */
class UserGallery
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userGallery", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $gallery_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uploaded_filenames;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uploaded_filetype;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGalleryUser(): ?User
    {
        return $this->gallery_user;
    }

    public function setGalleryUser(User $gallery_user): self
    {
        $this->gallery_user = $gallery_user;

        return $this;
    }

    public function getUploadedFilenames(): ?string
    {
        return $this->uploaded_filenames;
    }

    public function setUploadedFilenames(string $uploaded_filenames): self
    {
        $this->uploaded_filenames = $uploaded_filenames;

        return $this;
    }

    public function getUploadedFiletype(): ?string
    {
        return $this->uploaded_filetype;
    }

    public function setUploadedFiletype(string $uploaded_filetype): self
    {
        $this->uploaded_filetype = $uploaded_filetype;

        return $this;
    }
}
