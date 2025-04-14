<?php

namespace App\Entity;

use App\Repository\ClientSubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientSubscriptionRepository::class)]
class ClientSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $transation_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $EndAt = null;

    #[ORM\ManyToOne(inversedBy: 'clientSubscriptions')]
    private ?user $user = null;

    #[ORM\Column]
    private ?bool $isExpired = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransationId(): ?int
    {
        return $this->transation_id;
    }

    public function setTransationId(int $transation_id): static
    {
        $this->transation_id = $transation_id;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->EndAt;
    }

    public function setEndAt(\DateTimeImmutable $EndAt): static
    {
        $this->EndAt = $EndAt;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isExpired(): ?bool
    {
        return $this->isExpired;
    }

    public function setIsExpired(bool $isExpired): static
    {
        $this->isExpired = $isExpired;

        return $this;
    }
}
