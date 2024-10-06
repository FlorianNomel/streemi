<?php

namespace App\Entity;

use App\Enum\MediaTypeEnum;
use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class media
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

    /**
     * @var Collection<int, WatchHistory>
     */
    #[ORM\OneToMany(targetEntity: WatchHistory::class, mappedBy: 'MediaID')]
    private Collection $watchHistories;

    /**
     * @var Collection<int, PlaylistMedia>
     */
    #[ORM\OneToMany(targetEntity: PlaylistMedia::class, mappedBy: 'MediaID')]
    private Collection $playlistMedia;

    /**
     * @var Collection<int, CategoriesMedia>
     */
    #[ORM\OneToMany(targetEntity: CategoriesMedia::class, mappedBy: 'MediaID')]
    private Collection $categoriesMedia;

    /**
     * @var Collection<int, MediaLanguages>
     */
    #[ORM\OneToMany(targetEntity: MediaLanguages::class, mappedBy: 'MediaID')]
    private Collection $mediaLanguages;

    /**
     * @var Collection<int, Comments>
     */
    #[ORM\OneToMany(targetEntity: Comments::class, mappedBy: 'MediaID')]
    private Collection $comments;

    public function __construct()
    {
        $this->watchHistories = new ArrayCollection();
        $this->playlistMedia = new ArrayCollection();
        $this->categoriesMedia = new ArrayCollection();
        $this->mediaLanguages = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, WatchHistory>
     */
    public function getWatchHistories(): Collection
    {
        return $this->watchHistories;
    }

    public function addWatchHistory(WatchHistory $watchHistory): static
    {
        if (!$this->watchHistories->contains($watchHistory)) {
            $this->watchHistories->add($watchHistory);
            $watchHistory->setMediaID($this);
        }

        return $this;
    }

    public function removeWatchHistory(WatchHistory $watchHistory): static
    {
        if ($this->watchHistories->removeElement($watchHistory)) {
            // set the owning side to null (unless already changed)
            if ($watchHistory->getMediaID() === $this) {
                $watchHistory->setMediaID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistMedia>
     */
    public function getPlaylistMedia(): Collection
    {
        return $this->playlistMedia;
    }

    public function addPlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if (!$this->playlistMedia->contains($playlistMedium)) {
            $this->playlistMedia->add($playlistMedium);
            $playlistMedium->setMediaID($this);
        }

        return $this;
    }

    public function removePlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if ($this->playlistMedia->removeElement($playlistMedium)) {
            // set the owning side to null (unless already changed)
            if ($playlistMedium->getMediaID() === $this) {
                $playlistMedium->setMediaID(null);
            }
        }

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
            $categoriesMedium->setMediaID($this);
        }

        return $this;
    }

    public function removeCategoriesMedium(CategoriesMedia $categoriesMedium): static
    {
        if ($this->categoriesMedia->removeElement($categoriesMedium)) {
            // set the owning side to null (unless already changed)
            if ($categoriesMedium->getMediaID() === $this) {
                $categoriesMedium->setMediaID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MediaLanguages>
     */
    public function getMediaLanguages(): Collection
    {
        return $this->mediaLanguages;
    }

    public function addMediaLanguage(MediaLanguages $mediaLanguage): static
    {
        if (!$this->mediaLanguages->contains($mediaLanguage)) {
            $this->mediaLanguages->add($mediaLanguage);
            $mediaLanguage->setMediaID($this);
        }

        return $this;
    }

    public function removeMediaLanguage(MediaLanguages $mediaLanguage): static
    {
        if ($this->mediaLanguages->removeElement($mediaLanguage)) {
            // set the owning side to null (unless already changed)
            if ($mediaLanguage->getMediaID() === $this) {
                $mediaLanguage->setMediaID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setMediaID($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMediaID() === $this) {
                $comment->setMediaID(null);
            }
        }

        return $this;
    }
}
