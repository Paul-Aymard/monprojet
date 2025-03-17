<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libel_mod = null;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'modeles')]
    private Collection $Nomemp;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'modeles')]
    private Collection $Nomclient;

    /**
     * @var Collection<int, Vetement>
     */
    #[ORM\OneToMany(targetEntity: Vetement::class, mappedBy: 'Libel_mod')]
    private Collection $vetements;

    public function __construct()
    {
        $this->Nomemp = new ArrayCollection();
        $this->Nomclient = new ArrayCollection();
        $this->vetements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelMod(): ?string
    {
        return $this->libel_mod;
    }

    public function setLibelMod(string $libel_mod): static
    {
        $this->libel_mod = $libel_mod;

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getNomemp(): Collection
    {
        return $this->Nomemp;
    }

    public function addNomemp(Employe $nomemp): static
    {
        if (!$this->Nomemp->contains($nomemp)) {
            $this->Nomemp->add($nomemp);
        }

        return $this;
    }

    public function removeNomemp(Employe $nomemp): static
    {
        $this->Nomemp->removeElement($nomemp);

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getNomclient(): Collection
    {
        return $this->Nomclient;
    }

    public function addNomclient(Client $nomclient): static
    {
        if (!$this->Nomclient->contains($nomclient)) {
            $this->Nomclient->add($nomclient);
        }

        return $this;
    }

    public function removeNomclient(Client $nomclient): static
    {
        $this->Nomclient->removeElement($nomclient);

        return $this;
    }

    /**
     * @return Collection<int, Vetement>
     */
    public function getVetements(): Collection
    {
        return $this->vetements;
    }

    public function addVetement(Vetement $vetement): static
    {
        if (!$this->vetements->contains($vetement)) {
            $this->vetements->add($vetement);
            $vetement->setLibelMod($this);
        }

        return $this;
    }

    public function removeVetement(Vetement $vetement): static
    {
        if ($this->vetements->removeElement($vetement)) {
            // set the owning side to null (unless already changed)
            if ($vetement->getLibelMod() === $this) {
                $vetement->setLibelMod(null);
            }
        }

        return $this;
    }
}
