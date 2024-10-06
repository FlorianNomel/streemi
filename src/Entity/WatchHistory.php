<?php

namespace App\Entity;

use App\Repository\WatchHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchHistoryRepository::class)]
class watchhistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'watchHistory')]
    private Collection $UserID;

    #[ORM\ManyToOne(inversedBy: 'watchHistories')]
    private ?Media $MediaID = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $LastWatched = null;

    #[ORM\Column]
    private ?int $NumberOfViews = null;

    public function __construct()
    {
        $this->UserID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUserID(): Collection
    {
        return $this->UserID;
    }

    public function addUserID(Users $userID): static
    {
        if (!$this->UserID->contains($userID)) {
            $this->UserID->add($userID);
            $userID->setWatchHistory($this);
        }

        return $this;
    }

    public function removeUserID(Users $userID): static
    {
        if ($this->UserID->removeElement($userID)) {
            // set the owning side to null (unless already changed)
            if ($userID->getWatchHistory() === $this) {
                $userID->setWatchHistory(null);
            }
        }

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

    public function getLastWatched(): ?\DateTimeInterface
    {
        return $this->LastWatched;
    }

    public function setLastWatched(\DateTimeInterface $LastWatched): static
    {
        $this->LastWatched = $LastWatched;

        return $this;
    }

    public function getNumberOfViews(): ?int
    {
        return $this->NumberOfViews;
    }

    public function setNumberOfViews(int $NumberOfViews): static
    {
        $this->NumberOfViews = $NumberOfViews;

        return $this;
    }
}
