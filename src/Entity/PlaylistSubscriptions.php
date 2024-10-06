<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionsRepository::class)]
class PlaylistSubscriptions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscriptions')]
    private ?Users $UserID = null;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'playlistSubscriptions')]
    private Collection $PlaylistID;

    #[ORM\Column]
    private ?\DateTimeImmutable $SubscribedAt = null;

    public function __construct()
    {
        $this->PlaylistID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?Users
    {
        return $this->UserID;
    }

    public function setUserID(?Users $UserID): static
    {
        $this->UserID = $UserID;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylistID(): Collection
    {
        return $this->PlaylistID;
    }

    public function addPlaylistID(Playlist $playlistID): static
    {
        if (!$this->PlaylistID->contains($playlistID)) {
            $this->PlaylistID->add($playlistID);
            $playlistID->setPlaylistSubscriptions($this);
        }

        return $this;
    }

    public function removePlaylistID(Playlist $playlistID): static
    {
        if ($this->PlaylistID->removeElement($playlistID)) {
            // set the owning side to null (unless already changed)
            if ($playlistID->getPlaylistSubscriptions() === $this) {
                $playlistID->setPlaylistSubscriptions(null);
            }
        }

        return $this;
    }

    public function getSubscribedAt(): ?\DateTimeImmutable
    {
        return $this->SubscribedAt;
    }

    public function setSubscribedAt(\DateTimeImmutable $SubscribedAt): static
    {
        $this->SubscribedAt = $SubscribedAt;

        return $this;
    }
}
