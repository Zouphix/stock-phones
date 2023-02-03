<?php

namespace App\Entity;

use App\Repository\ImprimanteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImprimanteRepository::class)]
class Imprimante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'imprimantes')]
    private ?ModeleImprimante $modeleImprimanteId = null;

    #[ORM\ManyToOne(inversedBy: 'imprimantes')]
    private ?Lieu $lieuId = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    #[ORM\Column(length: 255)]
    private ?string $numSerie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModeleImprimanteId(): ?ModeleImprimante
    {
        return $this->modeleImprimanteId;
    }

    public function setModeleImprimanteId(?ModeleImprimante $modeleImprimanteId): self
    {
        $this->modeleImprimanteId = $modeleImprimanteId;

        return $this;
    }

    public function getLieuId(): ?Lieu
    {
        return $this->lieuId;
    }

    public function setLieuId(?Lieu $lieuId): self
    {
        $this->lieuId = $lieuId;

        return $this;
    }

    public function isIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getNumSerie(): ?string
    {
        return $this->numSerie;
    }

    public function setNumSerie(string $numSerie): self
    {
        $this->numSerie = $numSerie;

        return $this;
    }
}
