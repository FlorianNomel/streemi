<?php

namespace App\Entity;

use App\Repository\SubscriptionHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionHistoryRepository::class)]
class SubscriptionHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'subscriptionHistory')]
    private Collection $UserID;

    /**
     * @var Collection<int, Subscriptions>
     */
    #[ORM\OneToMany(targetEntity: Subscriptions::class, mappedBy: 'subscriptionHistory')]
    private Collection $SubscriptionID;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $StartDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $EndDate = null;

    public function __construct()
    {
        $this->UserID = new ArrayCollection();
        $this->SubscriptionID = new ArrayCollection();
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
            $userID->setSubscriptionHistory($this);
        }

        return $this;
    }

    public function removeUserID(Users $userID): static
    {
        if ($this->UserID->removeElement($userID)) {
            // set the owning side to null (unless already changed)
            if ($userID->getSubscriptionHistory() === $this) {
                $userID->setSubscriptionHistory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Subscriptions>
     */
    public function getSubscriptionID(): Collection
    {
        return $this->SubscriptionID;
    }

    public function addSubscriptionID(Subscriptions $subscriptionID): static
    {
        if (!$this->SubscriptionID->contains($subscriptionID)) {
            $this->SubscriptionID->add($subscriptionID);
            $subscriptionID->setSubscriptionHistory($this);
        }

        return $this;
    }

    public function removeSubscriptionID(Subscriptions $subscriptionID): static
    {
        if ($this->SubscriptionID->removeElement($subscriptionID)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionID->getSubscriptionHistory() === $this) {
                $subscriptionID->setSubscriptionHistory(null);
            }
        }

        return $this;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTimeImmutable $StartDate): static
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTimeInterface $EndDate): static
    {
        $this->EndDate = $EndDate;

        return $this;
    }
}
