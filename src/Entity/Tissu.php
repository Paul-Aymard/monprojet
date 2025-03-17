<?php

namespace App\Entity;

use App\Repository\TissuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TissuRepository::class)]
class Tissu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libel_tiss = null;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'libel_tiss')]
    private Collection $clients;

    #[ORM\ManyToOne(inversedBy: 'tissus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $Design_fou = null;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelTiss(): ?string
    {
        return $this->libel_tiss;
    }

    public function setLibelTiss(string $libel_tiss): static
    {
        $this->libel_tiss = $libel_tiss;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->addLibelTiss($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            $client->removeLibelTiss($this);
        }

        return $this;
    }

    public function getDesignFou(): ?Fournisseur
    {
        return $this->Design_fou;
    }

    public function setDesignFou(?Fournisseur $Design_fou): static
    {
        $this->Design_fou = $Design_fou;

        return $this;
    }
}
