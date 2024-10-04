<?php

namespace App\Entity;

use App\Enum\MediaTypeEnum;
use App\Repository\MediaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: MediaTypeEnum::class)]
    private ?MediaTypeEnum $media_type = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ShortDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $LongDescription = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $ReleaseDate = null;

    #[ORM\Column(length: 255)]
    private ?string $CoverImage = null;

    #[ORM\Column]
    private array $Staff = [];

    #[ORM\Column]
    private array $Casts = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMediaType(): ?MediaTypeEnum
    {
        return $this->media_type;
    }

    public function setMediaType(MediaTypeEnum $media_type): static
    {
        $this->media_type = $media_type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->ShortDescription;
    }

    public function setShortDescription(string $ShortDescription): static
    {
        $this->ShortDescription = $ShortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->LongDescription;
    }

    public function setLongDescription(string $LongDescription): static
    {
        $this->LongDescription = $LongDescription;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->ReleaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $ReleaseDate): static
    {
        $this->ReleaseDate = $ReleaseDate;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->CoverImage;
    }

    public function setCoverImage(string $CoverImage): static
    {
        $this->CoverImage = $CoverImage;

        return $this;
    }

    public function getStaff(): array
    {
        return $this->Staff;
    }

    public function setStaff(array $Staff): static
    {
        $this->Staff = $Staff;

        return $this;
    }

    public function getCasts(): array
    {
        return $this->Casts;
    }

    public function setCasts(array $Casts): static
    {
        $this->Casts = $Casts;

        return $this;
    }
}
