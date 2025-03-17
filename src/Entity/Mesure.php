<?php

namespace App\Entity;

use App\Repository\MesureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MesureRepository::class)]
class Mesure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libel_mess = null;

    #[ORM\ManyToOne(inversedBy: 'mesures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $nomclient = null;

    #[ORM\ManyToOne(inversedBy: 'mesures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employe $nomemp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelMess(): ?string
    {
        return $this->libel_mess;
    }

    public function setLibelMess(string $libel_mess): static
    {
        $this->libel_mess = $libel_mess;

        return $this;
    }

    public function getNomclient(): ?Client
    {
        return $this->nomclient;
    }

    public function setNomclient(?Client $nomclient): static
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    public function getNomemp(): ?Employe
    {
        return $this->nomemp;
    }

    public function setNomemp(?Employe $nomemp): static
    {
        $this->nomemp = $nomemp;

        return $this;
    }
}
