<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Name = null;

    #[ORM\Column(length: 100)]
    private ?string $Label = null;

    /**
     * @var Collection<int, CategoriesMedia>
     */
    #[ORM\OneToMany(targetEntity: CategoriesMedia::class, mappedBy: 'CategoryID')]
    private Collection $categoriesMedia;

    public function __construct()
    {
        $this->categoriesMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->Label;
    }

    public function setLabel(string $Label): static
    {
        $this->Label = $Label;

        return $this;
    }

    /**
     * @return Collection<int, CategoriesMedia>
     */
    public function getCategoriesMedia(): Collection
    {
        return $this->categoriesMedia;
    }

    public function addCategoriesMedium(CategoriesMedia $categoriesMedium): static
    {
        if (!$this->categoriesMedia->contains($categoriesMedium)) {
            $this->categoriesMedia->add($categoriesMedium);
            $categoriesMedium->setCategoryID($this);
        }

        return $this;
    }

    public function removeCategoriesMedium(CategoriesMedia $categoriesMedium): static
    {
        if ($this->categoriesMedia->removeElement($categoriesMedium)) {
            // set the owning side to null (unless already changed)
            if ($categoriesMedium->getCategoryID() === $this) {
                $categoriesMedium->setCategoryID(null);
            }
        }

        return $this;
    }
}
