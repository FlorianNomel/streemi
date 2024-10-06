<?php

namespace App\Entity;

use App\Repository\CategoriesMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesMediaRepository::class)]
class CategoriesMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'categoriesMedia')]
    private ?Media $MediaID = null;

    #[ORM\ManyToOne(inversedBy: 'categoriesMedia')]
    private ?Categories $CategoryID = null;

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

    public function getCategoryID(): ?Categories
    {
        return $this->CategoryID;
    }

    public function setCategoryID(?Categories $CategoryID): static
    {
        $this->CategoryID = $CategoryID;

        return $this;
    }
}
