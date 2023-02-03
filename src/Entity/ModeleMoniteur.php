<?php

namespace App\Entity;

use App\Repository\ModeleMoniteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleMoniteurRepository::class)]
class ModeleMoniteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'modeleMoniteurId', targetEntity: Moniteur::class)]
    private Collection $moniteurs;

    public function __construct()
    {
        $this->moniteurs = new ArrayCollection();
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
     * @return Collection<int, Moniteur>
     */
    public function getMoniteurs(): Collection
    {
        return $this->moniteurs;
    }

    public function addMoniteur(Moniteur $moniteur): self
    {
        if (!$this->moniteurs->contains($moniteur)) {
            $this->moniteurs->add($moniteur);
            $moniteur->setModeleMoniteurId($this);
        }

        return $this;
    }

    public function removeMoniteur(Moniteur $moniteur): self
    {
        if ($this->moniteurs->removeElement($moniteur)) {
            // set the owning side to null (unless already changed)
            if ($moniteur->getModeleMoniteurId() === $this) {
                $moniteur->setModeleMoniteurId(null);
            }
        }

        return $this;
    }
}
