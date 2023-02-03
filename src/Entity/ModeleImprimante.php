<?php

namespace App\Entity;

use App\Repository\ModeleImprimanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleImprimanteRepository::class)]
class ModeleImprimante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'modeleImprimanteId', targetEntity: Imprimante::class)]
    private Collection $imprimantes;

    public function __construct()
    {
        $this->imprimantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Imprimante>
     */
    public function getImprimantes(): Collection
    {
        return $this->imprimantes;
    }

    public function addImprimante(Imprimante $imprimante): self
    {
        if (!$this->imprimantes->contains($imprimante)) {
            $this->imprimantes->add($imprimante);
            $imprimante->setModeleImprimanteId($this);
        }

        return $this;
    }

    public function removeImprimante(Imprimante $imprimante): self
    {
        if ($this->imprimantes->removeElement($imprimante)) {
            // set the owning side to null (unless already changed)
            if ($imprimante->getModeleImprimanteId() === $this) {
                $imprimante->setModeleImprimanteId(null);
            }
        }

        return $this;
    }
}
