<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, ClientSubscription>
     */
    #[ORM\OneToMany(targetEntity: ClientSubscription::class, mappedBy: 'user')]
    private Collection $clientSubscriptions;

    public function __construct()
    {
        $this->clientSubscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, ClientSubscription>
     */
    public function getClientSubscriptions(): Collection
    {
        return $this->clientSubscriptions;
    }

    public function addClientSubscription(ClientSubscription $clientSubscription): static
    {
        if (!$this->clientSubscriptions->contains($clientSubscription)) {
            $this->clientSubscriptions->add($clientSubscription);
            $clientSubscription->setUser($this);
        }

        return $this;
    }

    public function removeClientSubscription(ClientSubscription $clientSubscription): static
    {
        if ($this->clientSubscriptions->removeElement($clientSubscription)) {
            // set the owning side to null (unless already changed)
            if ($clientSubscription->getUser() === $this) {
                $clientSubscription->setUser(null);
            }
        }

        return $this;
    }
}
