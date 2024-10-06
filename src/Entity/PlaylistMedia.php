<?php

namespace App\Entity;

use App\Repository\PlaylistMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistMediaRepository::class)]
class PlaylistMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistMedia')]
    private ?Playlist $PlaylistID = null;

    #[ORM\ManyToOne(inversedBy: 'playlistMedia')]
    private ?Media $MediaID = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $AddedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaylistID(): ?Playlist
    {
        return $this->PlaylistID;
    }

    public function setPlaylistID(?Playlist $PlaylistID): static
    {
        $this->PlaylistID = $PlaylistID;

        return $this;
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

    public function getAddedAt(): ?\DateTimeImmutable
    {
        return $this->AddedAt;
    }

    public function setAddedAt(\DateTimeImmutable $AddedAt): static
    {
        $this->AddedAt = $AddedAt;

        return $this;
    }
}
