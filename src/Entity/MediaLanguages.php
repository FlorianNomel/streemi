<?php

namespace App\Entity;

use App\Repository\MediaLanguagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaLanguagesRepository::class)]
class MediaLanguages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'mediaLanguages')]
    private ?Media $MediaID = null;

    #[ORM\ManyToOne(inversedBy: 'mediaLanguages')]
    private ?Languages $LanguageID = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMediaID(): ?Media
    {
        return $this->MediaID;
    }

    public function setMediaID(?Media $MediaID): static
    {
        $this->MediaID = $MediaID;

        return $this;
    }

    public function getLanguageID(): ?Languages
    {
        return $this->LanguageID;
    }

    public function setLanguageID(?Languages $LanguageID): static
    {
        $this->LanguageID = $LanguageID;

        return $this;
    }
}
