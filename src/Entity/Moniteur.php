<?php

namespace App\Entity;

use App\Repository\MoniteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MoniteurRepository::class)]
class Moniteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numSerie = null;

    #[ORM\ManyToOne(inversedBy: 'moniteurs')]
    private ?ModeleMoniteur $modeleMoniteurId = null;

    #[ORM\ManyToOne(inversedBy: 'moniteurs')]
    private ?Lieu $lieuId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getModeleMoniteurId(): ?ModeleMoniteur
    {
        return $this->modeleMoniteurId;
    }

    public function setModeleMoniteurId(?ModeleMoniteur $modeleMoniteurId): self
    {
        $this->modeleMoniteurId = $modeleMoniteurId;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

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
}
