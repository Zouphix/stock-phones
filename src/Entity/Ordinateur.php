<?php

namespace App\Entity;

use App\Repository\OrdinateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdinateurRepository::class)]
class Ordinateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numSerie = null;

    #[ORM\Column(length: 255)]
    private ?string $expirationGarantie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ip = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $domaine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?Employe $employeId = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?ModeleOrdinateur $modeleOrdinateurId = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?Lieu $lieuId = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?Statut $statutId = null;

    #[ORM\ManyToOne(inversedBy: 'ordinateurs')]
    private ?Type $typeId = null;

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

    public function getExpirationGarantie(): ?string
    {
        return $this->expirationGarantie;
    }

    public function setExpirationGarantie(string $expirationGarantie): self
    {
        $this->expirationGarantie = $expirationGarantie;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(?string $domaine): self
    {
        $this->domaine = $domaine;

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

    public function getEmployeId(): ?Employe
    {
        return $this->employeId;
    }

    public function setEmployeId(?Employe $employeId): self
    {
        $this->employeId = $employeId;

        return $this;
    }

    public function getModeleOrdinateurId(): ?ModeleOrdinateur
    {
        return $this->modeleOrdinateurId;
    }

    public function setModeleOrdinateurId(?ModeleOrdinateur $modeleOrdinateurId): self
    {
        $this->modeleOrdinateurId = $modeleOrdinateurId;

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

    public function getStatutId(): ?Statut
    {
        return $this->statutId;
    }

    public function setStatutId(?Statut $statutId): self
    {
        $this->statutId = $statutId;

        return $this;
    }

    public function getTypeId(): ?Type
    {
        return $this->typeId;
    }

    public function setTypeId(?Type $typeId): self
    {
        $this->typeId = $typeId;

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
