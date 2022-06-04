<?php

namespace App\Entity;

use App\Repository\AlcoolRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlcoolRepository::class)
 */
class Alcool
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=TypeBoisson::class, inversedBy="TypeBoisson")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeBoisson;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixPinte;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTypeBoisson(): ?TypeBoisson
    {
        return $this->typeBoisson;
    }

    public function setTypeBoisson(?TypeBoisson $typeBoisson): self
    {
        $this->typeBoisson = $typeBoisson;

        return $this;
    }

    public function getPrixPinte(): ?float
    {
        return $this->prixPinte;
    }

    public function setPrixPinte(?float $prixPinte): self
    {
        $this->prixPinte = $prixPinte;

        return $this;
    }
}
