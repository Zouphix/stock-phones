<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuRepository::class)]
class Lieu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'lieuId', targetEntity: Moniteur::class)]
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
            $moniteur->setLieuId($this);
        }

        return $this;
    }

    public function removeMoniteur(Moniteur $moniteur): self
    {
        if ($this->moniteurs->removeElement($moniteur)) {
            // set the owning side to null (unless already changed)
            if ($moniteur->getLieuId() === $this) {
                $moniteur->setLieuId(null);
            }
        }

        return $this;
    }
}
