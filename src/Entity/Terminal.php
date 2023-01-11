<?php

namespace App\Entity;

use App\Repository\TerminalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TerminalRepository::class)]
class Terminal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $achete = null;

    #[ORM\Column(length: 255)]
    private ?string $communiquant = null;

    #[ORM\Column(length: 255)]
    private ?string $imeiAchete = null;

    #[ORM\Column(length: 255)]
    private ?string $imeiCommuniquant = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    #[ORM\OneToMany(mappedBy: 'terminalId', targetEntity: Attribution::class)]
    private Collection $attributions;

    public function __construct()
    {
        $this->attributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAchete(): ?string
    {
        return $this->achete;
    }

    public function setAchete(string $achete): self
    {
        $this->achete = $achete;

        return $this;
    }

    public function getCommuniquant(): ?string
    {
        return $this->communiquant;
    }

    public function setCommuniquant(string $communiquant): self
    {
        $this->communiquant = $communiquant;

        return $this;
    }

    public function getImeiAchete(): ?string
    {
        return $this->imeiAchete;
    }

    public function setImeiAchete(string $imeiAchete): self
    {
        $this->imeiAchete = $imeiAchete;

        return $this;
    }

    public function getImeiCommuniquant(): ?string
    {
        return $this->imeiCommuniquant;
    }

    public function setImeiCommuniquant(string $imeiCommuniquant): self
    {
        $this->imeiCommuniquant = $imeiCommuniquant;

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

    /**
     * @return Collection<int, Attribution>
     */
    public function getAttributions(): Collection
    {
        return $this->attributions;
    }

    public function addAttribution(Attribution $attribution): self
    {
        if (!$this->attributions->contains($attribution)) {
            $this->attributions->add($attribution);
            $attribution->setTerminalId($this);
        }

        return $this;
    }

    public function removeAttribution(Attribution $attribution): self
    {
        if ($this->attributions->removeElement($attribution)) {
            // set the owning side to null (unless already changed)
            if ($attribution->getTerminalId() === $this) {
                $attribution->setTerminalId(null);
            }
        }

        return $this;
    }
}
