<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lib_rdv = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_rdvAt = null;

    /**
     * @var Collection<int, Alerte>
     */
    #[ORM\OneToMany(targetEntity: Alerte::class, mappedBy: 'libelrdv', orphanRemoval: true)]
    private Collection $alertes;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $nomcli = null;

    public function __construct()
    {
        $this->alertes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibRdv(): ?string
    {
        return $this->lib_rdv;
    }

    public function setLibRdv(string $lib_rdv): static
    {
        $this->lib_rdv = $lib_rdv;

        return $this;
    }

    public function getDateRdvAt(): ?\DateTimeImmutable
    {
        return $this->date_rdvAt;
    }

    public function setDateRdvAt(\DateTimeImmutable $date_rdvAt): static
    {
        $this->date_rdvAt = $date_rdvAt;

        return $this;
    }

    /**
     * @return Collection<int, Alerte>
     */
    public function getAlertes(): Collection
    {
        return $this->alertes;
    }

    public function addAlerte(Alerte $alerte): static
    {
        if (!$this->alertes->contains($alerte)) {
            $this->alertes->add($alerte);
            $alerte->setLibelrdv($this);
        }

        return $this;
    }

    public function removeAlerte(Alerte $alerte): static
    {
        if ($this->alertes->removeElement($alerte)) {
            // set the owning side to null (unless already changed)
            if ($alerte->getLibelrdv() === $this) {
                $alerte->setLibelrdv(null);
            }
        }

        return $this;
    }

    public function getNomcli(): ?Client
    {
        return $this->nomcli;
    }

    public function setNomcli(?Client $nomcli): static
    {
        $this->nomcli = $nomcli;

        return $this;
    }
}
