<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $design_fou = null;

    #[ORM\Column(length: 255)]
    private ?string $tel_fou = null;

    /**
     * @var Collection<int, Tissu>
     */
    #[ORM\OneToMany(targetEntity: Tissu::class, mappedBy: 'Design_fou')]
    private Collection $tissus;

    /**
     * @var Collection<int, Employe>
     */
    #[ORM\ManyToMany(targetEntity: Employe::class, inversedBy: 'fournisseurs')]
    private Collection $Noem_emp;

    public function __construct()
    {
        $this->tissus = new ArrayCollection();
        $this->Noem_emp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignFou(): ?string
    {
        return $this->design_fou;
    }

    public function setDesignFou(string $design_fou): static
    {
        $this->design_fou = $design_fou;

        return $this;
    }

    public function getTelFou(): ?string
    {
        return $this->tel_fou;
    }

    public function setTelFou(string $tel_fou): static
    {
        $this->tel_fou = $tel_fou;

        return $this;
    }

    /**
     * @return Collection<int, Tissu>
     */
    public function getTissus(): Collection
    {
        return $this->tissus;
    }

    public function addTissu(Tissu $tissu): static
    {
        if (!$this->tissus->contains($tissu)) {
            $this->tissus->add($tissu);
            $tissu->setDesignFou($this);
        }

        return $this;
    }

    public function removeTissu(Tissu $tissu): static
    {
        if ($this->tissus->removeElement($tissu)) {
            // set the owning side to null (unless already changed)
            if ($tissu->getDesignFou() === $this) {
                $tissu->setDesignFou(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getNoemEmp(): Collection
    {
        return $this->Noem_emp;
    }

    public function addNoemEmp(Employe $noemEmp): static
    {
        if (!$this->Noem_emp->contains($noemEmp)) {
            $this->Noem_emp->add($noemEmp);
        }

        return $this;
    }

    public function removeNoemEmp(Employe $noemEmp): static
    {
        $this->Noem_emp->removeElement($noemEmp);

        return $this;
    }
}
