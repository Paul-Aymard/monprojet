<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_cli = null;

    #[ORM\Column(length: 255)]
    private ?string $Pre_cli = null;

    #[ORM\Column(length: 255)]
    private ?string $Tel_cli = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Sex_cli = null;

    /**
     * @var Collection<int, RendezVous>
     */
    #[ORM\OneToMany(targetEntity: RendezVous::class, mappedBy: 'nomcli', orphanRemoval: true)]
    private Collection $rendezVouses;

    /**
     * @var Collection<int, Mesure>
     */
    #[ORM\OneToMany(targetEntity: Mesure::class, mappedBy: 'nomclient')]
    private Collection $mesures;

    /**
     * @var Collection<int, Modele>
     */
    #[ORM\ManyToMany(targetEntity: Modele::class, mappedBy: 'Nomclient')]
    private Collection $modeles;

    /**
     * @var Collection<int, Tissu>
     */
    #[ORM\ManyToMany(targetEntity: Tissu::class, inversedBy: 'clients')]
    private Collection $libel_tiss;

    /**
     * @var Collection<int, Vetement>
     */
    #[ORM\OneToMany(targetEntity: Vetement::class, mappedBy: 'Nomcli')]
    private Collection $vetements;

    /**
     * @var Collection<int, Facture>
     */
    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'nom_cli')]
    private Collection $factures;

    public function __construct()
    {
        $this->rendezVouses = new ArrayCollection();
        $this->mesures = new ArrayCollection();
        $this->modeles = new ArrayCollection();
        $this->libel_tiss = new ArrayCollection();
        $this->vetements = new ArrayCollection();
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCli(): ?string
    {
        return $this->Nom_cli;
    }

    public function setNomCli(string $Nom_cli): static
    {
        $this->Nom_cli = $Nom_cli;

        return $this;
    }

    public function getPreCli(): ?string
    {
        return $this->Pre_cli;
    }

    public function setPreCli(string $Pre_cli): static
    {
        $this->Pre_cli = $Pre_cli;

        return $this;
    }

    public function getTelCli(): ?string
    {
        return $this->Tel_cli;
    }

    public function setTelCli(string $Tel_cli): static
    {
        $this->Tel_cli = $Tel_cli;

        return $this;
    }

    public function getSexCli(): ?string
    {
        return $this->Sex_cli;
    }

    public function setSexCli(?string $Sex_cli): static
    {
        $this->Sex_cli = $Sex_cli;

        return $this;
    }

    /**
     * @return Collection<int, RendezVous>
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): static
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->add($rendezVouse);
            $rendezVouse->setNomcli($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): static
    {
        if ($this->rendezVouses->removeElement($rendezVouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getNomcli() === $this) {
                $rendezVouse->setNomcli(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mesure>
     */
    public function getMesures(): Collection
    {
        return $this->mesures;
    }

    public function addMesure(Mesure $mesure): static
    {
        if (!$this->mesures->contains($mesure)) {
            $this->mesures->add($mesure);
            $mesure->setNomclient($this);
        }

        return $this;
    }

    public function removeMesure(Mesure $mesure): static
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getNomclient() === $this) {
                $mesure->setNomclient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Modele>
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(Modele $modele): static
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles->add($modele);
            $modele->addNomclient($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): static
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeNomclient($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Tissu>
     */
    public function getLibelTiss(): Collection
    {
        return $this->libel_tiss;
    }

    public function addLibelTiss(Tissu $libelTiss): static
    {
        if (!$this->libel_tiss->contains($libelTiss)) {
            $this->libel_tiss->add($libelTiss);
        }

        return $this;
    }

    public function removeLibelTiss(Tissu $libelTiss): static
    {
        $this->libel_tiss->removeElement($libelTiss);

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
            $vetement->setNomcli($this);
        }

        return $this;
    }

    public function removeVetement(Vetement $vetement): static
    {
        if ($this->vetements->removeElement($vetement)) {
            // set the owning side to null (unless already changed)
            if ($vetement->getNomcli() === $this) {
                $vetement->setNomcli(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Facture>
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): static
    {
        if (!$this->factures->contains($facture)) {
            $this->factures->add($facture);
            $facture->setNomCli($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): static
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getNomCli() === $this) {
                $facture->setNomCli(null);
            }
        }

        return $this;
    }
}
