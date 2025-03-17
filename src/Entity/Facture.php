<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dat_factAt = null;

    #[ORM\Column(length: 255)]
    private ?string $mont_fact = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employe $Nom_emp = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $nom_cli = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatFactAt(): ?\DateTimeImmutable
    {
        return $this->dat_factAt;
    }

    public function setDatFactAt(\DateTimeImmutable $dat_factAt): static
    {
        $this->dat_factAt = $dat_factAt;

        return $this;
    }

    public function getMontFact(): ?string
    {
        return $this->mont_fact;
    }

    public function setMontFact(string $mont_fact): static
    {
        $this->mont_fact = $mont_fact;

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

    public function getNomCli(): ?Client
    {
        return $this->nom_cli;
    }

    public function setNomCli(?Client $nom_cli): static
    {
        $this->nom_cli = $nom_cli;

        return $this;
    }
}
