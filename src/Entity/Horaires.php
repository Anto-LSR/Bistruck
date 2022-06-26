<?php

namespace App\Entity;

use App\Repository\HorairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorairesRepository::class)
 */
class Horaires
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $lundi;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $mardi;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $mercredi;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $jeudi;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $vendredi;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $samedi;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $dimanche;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedToday;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $LundiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MardiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $MercrediFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $jeudiFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $VendrediFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $SamediFermeture;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $DimancheFermeture;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedLundi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedMardi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedMercredi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedJeudi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedVendredi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedSamedi;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $closedDimanche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLundi(): ?\DateTimeInterface
    {
        return $this->lundi;
    }

    public function setLundi(?\DateTimeInterface $lundi): self
    {
        $this->lundi = $lundi;

        return $this;
    }

    public function getMardi(): ?\DateTimeInterface
    {
        return $this->mardi;
    }

    public function setMardi(?\DateTimeInterface $mardi): self
    {
        $this->mardi = $mardi;

        return $this;
    }

    public function getMercredi(): ?\DateTimeInterface
    {
        return $this->mercredi;
    }

    public function setMercredi(?\DateTimeInterface $mercredi): self
    {
        $this->mercredi = $mercredi;

        return $this;
    }

    public function getJeudi(): ?\DateTimeInterface
    {
        return $this->jeudi;
    }

    public function setJeudi(?\DateTimeInterface $jeudi): self
    {
        $this->jeudi = $jeudi;

        return $this;
    }

    public function getVendredi(): ?\DateTimeInterface
    {
        return $this->vendredi;
    }

    public function setVendredi(?\DateTimeInterface $vendredi): self
    {
        $this->vendredi = $vendredi;

        return $this;
    }

    public function getSamedi(): ?\DateTimeInterface
    {
        return $this->samedi;
    }

    public function setSamedi(?\DateTimeInterface $samedi): self
    {
        $this->samedi = $samedi;

        return $this;
    }

    public function getDimanche(): ?\DateTimeInterface
    {
        return $this->dimanche;
    }

    public function setDimanche(?\DateTimeInterface $dimanche): self
    {
        $this->dimanche = $dimanche;

        return $this;
    }

    public function isClosedToday(): ?bool
    {
        return $this->closedToday;
    }

    public function setClosedToday(?bool $closedToday): self
    {
        $this->closedToday = $closedToday;

        return $this;
    }

    public function getLundiFermeture(): ?\DateTimeInterface
    {
        return $this->LundiFermeture;
    }

    public function setLundiFermeture(?\DateTimeInterface $LundiFermeture): self
    {
        $this->LundiFermeture = $LundiFermeture;

        return $this;
    }

    public function getMardiFermeture(): ?\DateTimeInterface
    {
        return $this->MardiFermeture;
    }

    public function setMardiFermeture(?\DateTimeInterface $MardiFermeture): self
    {
        $this->MardiFermeture = $MardiFermeture;

        return $this;
    }

    public function getMercrediFermeture(): ?\DateTimeInterface
    {
        return $this->MercrediFermeture;
    }

    public function setMercrediFermeture(?\DateTimeInterface $MercrediFermeture): self
    {
        $this->MercrediFermeture = $MercrediFermeture;

        return $this;
    }

    public function getJeudiFermeture(): ?\DateTimeInterface
    {
        return $this->jeudiFermeture;
    }

    public function setJeudiFermeture(?\DateTimeInterface $jeudiFermeture): self
    {
        $this->jeudiFermeture = $jeudiFermeture;

        return $this;
    }

    public function getVendrediFermeture(): ?\DateTimeInterface
    {
        return $this->VendrediFermeture;
    }

    public function setVendrediFermeture(?\DateTimeInterface $VendrediFermeture): self
    {
        $this->VendrediFermeture = $VendrediFermeture;

        return $this;
    }

    public function getSamediFermeture(): ?\DateTimeInterface
    {
        return $this->SamediFermeture;
    }

    public function setSamediFermeture(?\DateTimeInterface $SamediFermeture): self
    {
        $this->SamediFermeture = $SamediFermeture;

        return $this;
    }

    public function getDimancheFermeture(): ?\DateTimeInterface
    {
        return $this->DimancheFermeture;
    }

    public function setDimancheFermeture(?\DateTimeInterface $DimancheFermeture): self
    {
        $this->DimancheFermeture = $DimancheFermeture;

        return $this;
    }

    public function isClosedLundi(): ?bool
    {
        return $this->closedLundi;
    }

    public function setClosedLundi(?bool $closedLundi): self
    {
        $this->closedLundi = $closedLundi;

        return $this;
    }

    public function isClosedMardi(): ?bool
    {
        return $this->closedMardi;
    }

    public function setClosedMardi(?bool $closedMardi): self
    {
        $this->closedMardi = $closedMardi;

        return $this;
    }

    public function isClosedMercredi(): ?bool
    {
        return $this->closedMercredi;
    }

    public function setClosedMercredi(?bool $closedMercredi): self
    {
        $this->closedMercredi = $closedMercredi;

        return $this;
    }

    public function isClosedJeudi(): ?bool
    {
        return $this->closedJeudi;
    }

    public function setClosedJeudi(?bool $closedJeudi): self
    {
        $this->closedJeudi = $closedJeudi;

        return $this;
    }

    public function isClosedVendredi(): ?bool
    {
        return $this->closedVendredi;
    }

    public function setClosedVendredi(?bool $closedVendredi): self
    {
        $this->closedVendredi = $closedVendredi;

        return $this;
    }

    public function isClosedSamedi(): ?bool
    {
        return $this->closedSamedi;
    }

    public function setClosedSamedi(?bool $closedSamedi): self
    {
        $this->closedSamedi = $closedSamedi;

        return $this;
    }

    public function isClosedDimanche(): ?bool
    {
        return $this->closedDimanche;
    }

    public function setClosedDimanche(?bool $closedDimanche): self
    {
        $this->closedDimanche = $closedDimanche;

        return $this;
    }
}
