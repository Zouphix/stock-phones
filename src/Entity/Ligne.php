<?php

namespace App\Entity;

use App\Repository\LigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneRepository::class)]
class Ligne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $miseService = null;

    #[ORM\Column(length: 255)]
    private ?string $finEngagement = null;

    #[ORM\Column(length: 255)]
    private ?string $facturation = null;

    #[ORM\Column]
    private ?int $portage = null;

    #[ORM\ManyToOne(inversedBy: 'lignes')]
    private ?Liste $listeId = null;

    #[ORM\ManyToOne(inversedBy: 'lignes')]
    private ?Forfait $forfaitId = null;

    #[ORM\Column(nullable: true)]
    private ?int $csim = null;

    #[ORM\Column(nullable: true)]
    private ?int $numeroPrive = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $changementTerminal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modificationForfait = null;

    #[ORM\Column(nullable: true)]
    private ?bool $ligneSecondaire = null;

    #[ORM\Column(nullable: true)]
    private ?int $lignePrincipale = null;

    #[ORM\Column(nullable: true)]
    private ?int $masterIdAcces = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    #[ORM\OneToMany(mappedBy: 'ligneId', targetEntity: Attribution::class)]
    private Collection $attributions;

    public function __construct()
    {
        $this->attributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getMiseService(): ?string
    {
        return $this->miseService;
    }

    public function setMiseService(string $miseService): self
    {
        $this->miseService = $miseService;

        return $this;
    }

    public function getFinEngagement(): ?string
    {
        return $this->finEngagement;
    }

    public function setFinEngagement(string $finEngagement): self
    {
        $this->finEngagement = $finEngagement;

        return $this;
    }

    public function getFacturation(): ?string
    {
        return $this->facturation;
    }

    public function setFacturation(string $facturation): self
    {
        $this->facturation = $facturation;

        return $this;
    }

    public function getPortage(): ?int
    {
        return $this->portage;
    }

    public function setPortage(int $portage): self
    {
        $this->portage = $portage;

        return $this;
    }

    public function getListeId(): ?Liste
    {
        return $this->listeId;
    }

    public function setListeId(?Liste $listeId): self
    {
        $this->listeId = $listeId;

        return $this;
    }

    public function getForfaitId(): ?Forfait
    {
        return $this->forfaitId;
    }

    public function setForfaitId(?Forfait $forfaitId): self
    {
        $this->forfaitId = $forfaitId;

        return $this;
    }

    public function getCsim(): ?int
    {
        return $this->csim;
    }

    public function setCsim(?int $csim): self
    {
        $this->csim = $csim;

        return $this;
    }

    public function getNumeroPrive(): ?int
    {
        return $this->numeroPrive;
    }

    public function setNumeroPrive(?int $numeroPrive): self
    {
        $this->numeroPrive = $numeroPrive;

        return $this;
    }

    public function getChangementTerminal(): ?string
    {
        return $this->changementTerminal;
    }

    public function setChangementTerminal(?string $changementTerminal): self
    {
        $this->changementTerminal = $changementTerminal;

        return $this;
    }

    public function getModificationForfait(): ?string
    {
        return $this->modificationForfait;
    }

    public function setModificationForfait(?string $modificationForfait): self
    {
        $this->modificationForfait = $modificationForfait;

        return $this;
    }

    public function isLigneSecondaire(): ?bool
    {
        return $this->ligneSecondaire;
    }

    public function setLigneSecondaire(?bool $ligneSecondaire): self
    {
        $this->ligneSecondaire = $ligneSecondaire;

        return $this;
    }

    public function getLignePrincipale(): ?int
    {
        return $this->lignePrincipale;
    }

    public function setLignePrincipale(?int $lignePrincipale): self
    {
        $this->lignePrincipale = $lignePrincipale;

        return $this;
    }

    public function getMasterIdAcces(): ?int
    {
        return $this->masterIdAcces;
    }

    public function setMasterIdAcces(?int $masterIdAcces): self
    {
        $this->masterIdAcces = $masterIdAcces;

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
            $attribution->setLigneId($this);
        }

        return $this;
    }

    public function removeAttribution(Attribution $attribution): self
    {
        if ($this->attributions->removeElement($attribution)) {
            // set the owning side to null (unless already changed)
            if ($attribution->getLigneId() === $this) {
                $attribution->setLigneId(null);
            }
        }

        return $this;
    }
}
