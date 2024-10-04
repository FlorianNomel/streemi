<?php

namespace App\Entity;

use App\Repository\SeasonsRepository;
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
}