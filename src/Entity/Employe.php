<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_emp = null;

    #[ORM\Column(length: 255)]
    private ?string $Pre_emp = null;

    #[ORM\Column(length: 255)]
    private ?string $tel_emp = null;

    /**
     * @var Collection<int, Mesure>
     */
    #[ORM\OneToMany(targetEntity: Mesure::class, mappedBy: 'nomemp')]
    private Collection $mesures;

    /**
     * @var Collection<int, Modele>
     */
    #[ORM\ManyToMany(targetEntity: Modele::class, mappedBy: 'Nomemp')]
    private Collection $modeles;

    /**
     * @var Collection<int, Vetement>
     */
    #[ORM\OneToMany(targetEntity: Vetement::class, mappedBy: 'Nom_emp')]
    private Collection $vetements;

    /**
     * @var Collection<int, Fournisseur>
     */
    #[ORM\ManyToMany(targetEntity: Fournisseur::class, mappedBy: 'Noem_emp')]
    private Collection $fournisseurs;

    /**
     * @var Collection<int, Facture>
     */
    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'Nom_emp')]
    private Collection $factures;

    public function __construct()
    {
        $this->mesures = new ArrayCollection();
        $this->modeles = new ArrayCollection();
        $this->vetements = new ArrayCollection();
        $this->fournisseurs = new ArrayCollection();
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEmp(): ?string
    {
        return $this->Nom_emp;
    }

    public function setNomEmp(string $Nom_emp): static
    {
        $this->Nom_emp = $Nom_emp;

        return $this;
    }

    public function getPreEmp(): ?string
    {
        return $this->Pre_emp;
    }

    public function setPreEmp(string $Pre_emp): static
    {
        $this->Pre_emp = $Pre_emp;

        return $this;
    }

    public function getTelEmp(): ?string
    {
        return $this->tel_emp;
    }

    public function setTelEmp(string $tel_emp): static
    {
        $this->tel_emp = $tel_emp;

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
            $mesure->setNomemp($this);
        }

        return $this;
    }

    public function removeMesure(Mesure $mesure): static
    {
        if ($this->mesures->removeElement($mesure)) {
            // set the owning side to null (unless already changed)
            if ($mesure->getNomemp() === $this) {
                $mesure->setNomemp(null);
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
            $modele->addNomemp($this);
        }

        return $this;
    }

    public function removeModele(Modele $modele): static
    {
        if ($this->modeles->removeElement($modele)) {
            $modele->removeNomemp($this);
        }

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
            $vetement->setNomEmp($this);
        }

        return $this;
    }

    public function removeVetement(Vetement $vetement): static
    {
        if ($this->vetements->removeElement($vetement)) {
            // set the owning side to null (unless already changed)
            if ($vetement->getNomEmp() === $this) {
                $vetement->setNomEmp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fournisseur>
     */
    public function getFournisseurs(): Collection
    {
        return $this->fournisseurs;
    }

    public function addFournisseur(Fournisseur $fournisseur): static
    {
        if (!$this->fournisseurs->contains($fournisseur)) {
            $this->fournisseurs->add($fournisseur);
            $fournisseur->addNoemEmp($this);
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): static
    {
        if ($this->fournisseurs->removeElement($fournisseur)) {
            $fournisseur->removeNoemEmp($this);
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
            $facture->setNomEmp($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): static
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getNomEmp() === $this) {
                $facture->setNomEmp(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->Nom_emp;
      }
}
