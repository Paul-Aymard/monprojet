<?php

namespace App\Entity;

use App\Repository\AlerteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlerteRepository::class)]
class Alerte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lib_alert = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Dat_alertAt = null;

    #[ORM\ManyToOne(inversedBy: 'alertes')]
    #[ORM\JoinColumn(nullable: false )]
    private ?RendezVous $libelrdv = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibAlert(): ?string
    {
        return $this->lib_alert;
    }

    public function setLibAlert(string $lib_alert): static
    {
        $this->lib_alert = $lib_alert;

        return $this;
    }

    public function getDatAlertAt(): ?\DateTimeImmutable
    {
        return $this->Dat_alertAt;
    }

    public function setDatAlertAt(\DateTimeImmutable $Dat_alertAt): static
    {
        $this->Dat_alertAt = $Dat_alertAt;

        return $this;
    }

    public function getLibelrdv(): ?RendezVous
    {
        return $this->libelrdv;
    }

    public function setLibelrdv(?RendezVous $libelrdv): static
    {
        $this->libelrdv = $libelrdv;

        return $this;
    }
}
