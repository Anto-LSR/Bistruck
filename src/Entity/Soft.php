<?php

namespace App\Entity;

use App\Repository\SoftRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SoftRepository::class)
 */
class Soft
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=TypeBoisson::class, inversedBy="softs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeBoisson;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
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

    public function getTypeBoisson(): ?typeboisson
    {
        return $this->typeBoisson;
    }

    public function setTypeBoisson(?typeboisson $typeBoisson): self
    {
        $this->typeBoisson = $typeBoisson;

        return $this;
    }
}
