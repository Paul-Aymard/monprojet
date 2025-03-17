<?php

namespace App\Entity;

use App\Repository\VetementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VetementRepository::class)]
class Vetement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libel_vet = null;

    #[ORM\ManyToOne(inversedBy: 'vetements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employe $Nom_emp = null;

    #[ORM\ManyToOne(inversedBy: 'vetements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modele $Libel_mod = null;

    #[ORM\ManyToOne(inversedBy: 'vetements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $Nomcli = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelVet(): ?string
    {
        return $this->libel_vet;
    }

    public function setLibelVet(string $libel_vet): static
    {
        $this->libel_vet = $libel_vet;

        return $this;
    }

    public function getNomEmp(): ?Employe
    {
        return $this->Nom_emp;
    }

    public function setNomEmp(?Employe $Nom_emp): static
    {
        $this->Nom_emp = $Nom_emp;

        return $this;
    }

    public function getLibelMod(): ?Modele
    {
        return $this->Libel_mod;
    }

    public function setLibelMod(?Modele $Libel_mod): static
    {
        $this->Libel_mod = $Libel_mod;

        return $this;
    }

    public function getNomcli(): ?Client
    {
        return $this->Nomcli;
    }

    public function setNomcli(?Client $Nomcli): static
    {
        $this->Nomcli = $Nomcli;

        return $this;
    }
}
