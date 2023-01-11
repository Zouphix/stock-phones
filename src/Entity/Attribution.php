<?php

namespace App\Entity;

use App\Repository\AttributionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributionRepository::class)]
class Attribution
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'attributions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employe $employeId = null;

    #[ORM\ManyToOne(inversedBy: 'attributions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ligne $ligneId = null;

    #[ORM\ManyToOne(inversedBy: 'attributions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Terminal $terminalId = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLigneId(): ?Ligne
    {
        return $this->ligneId;
    }

    public function setLigneId(?Ligne $ligneId): self
    {
        $this->ligneId = $ligneId;

        return $this;
    }

    public function getTerminalId(): ?Terminal
    {
        return $this->terminalId;
    }

    public function setTerminalId(?Terminal $terminalId): self
    {
        $this->terminalId = $terminalId;

        return $this;
    }
}
