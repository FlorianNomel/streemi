<?php

namespace App\Entity;

use App\Repository\SeasonsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonsRepository::class)]
class Seasons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $SeasonNumber = null;

    #[ORM\ManyToOne(inversedBy: 'seasons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TVShow $TvShowID = null;

    /**
     * @var Collection<int, Episodes>
     */
    #[ORM\OneToMany(targetEntity: Episodes::class, mappedBy: 'SeasonID')]
    private Collection $episodes;

    public function __construct()
    {
        $this->episodes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeasonNumber(): ?int
    {
        return $this->SeasonNumber;
    }

    public function setSeasonNumber(int $SeasonNumber): static
    {
        $this->SeasonNumber = $SeasonNumber;

        return $this;
    }

    public function getTvShowID(): ?TVShow
    {
        return $this->TvShowID;
    }

    public function setTvShowID(?TVShow $TvShowID): static
    {
        $this->TvShowID = $TvShowID;

        return $this;
    }

    /**
     * @return Collection<int, Episodes>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episodes $episode): static
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes->add($episode);
            $episode->setSeasonID($this);
        }

        return $this;
    }

    public function removeEpisode(Episodes $episode): static
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getSeasonID() === $this) {
                $episode->setSeasonID(null);
            }
        }

        return $this;
    }
}
