<?php

namespace App\Entity;

use App\Enum\StatusEnum;
use App\Repository\CommentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Users $UserID = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Media $MediaID = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'comments')]
    private ?self $ParentComment = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'ParentComment')]
    private Collection $comments;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Content = null;

    #[ORM\Column(enumType: StatusEnum::class)]
    private ?StatusEnum $Status = null;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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

    public function getMediaID(): ?Media
    {
        return $this->MediaID;
    }

    public function setMediaID(?Media $MediaID): static
    {
        $this->MediaID = $MediaID;

        return $this;
    }

    public function getParentComment(): ?self
    {
        return $this->ParentComment;
    }

    public function setParentComment(?self $ParentComment): static
    {
        $this->ParentComment = $ParentComment;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(self $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setParentComment($this);
        }

        return $this;
    }

    public function removeComment(self $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getParentComment() === $this) {
                $comment->setParentComment(null);
            }
        }

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): static
    {
        $this->Content = $Content;

        return $this;
    }

    public function getStatus(): ?StatusEnum
    {
        return $this->Status;
    }

    public function setStatus(StatusEnum $Status): static
    {
        $this->Status = $Status;

        return $this;
    }
}
