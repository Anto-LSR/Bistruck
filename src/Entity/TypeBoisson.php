<?php

namespace App\Entity;

use App\Repository\TypeBoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeBoissonRepository::class)
 */
class TypeBoisson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Alcool::class, mappedBy="TypeBoisson", orphanRemoval=true)
     */
    private $typeBoisson;

    /**
     * @ORM\OneToMany(targetEntity=Soft::class, mappedBy="TypeBoisson", orphanRemoval=true)
     */
    private $softs;

    public function __construct()
    {
        $this->typeBoisson = new ArrayCollection();
        $this->softs = new ArrayCollection();
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
     * @return Collection<int, Alcool>
     */
    public function getTypeBoisson(): Collection
    {
        return $this->typeBoisson;
    }

    public function addTypeBoisson(Alcool $typeBoisson): self
    {
        if (!$this->typeBoisson->contains($typeBoisson)) {
            $this->typeBoisson[] = $typeBoisson;
            $typeBoisson->setTypeBoisson($this);
        }

        return $this;
    }

    public function removeTypeBoisson(Alcool $typeBoisson): self
    {
        if ($this->typeBoisson->removeElement($typeBoisson)) {
            // set the owning side to null (unless already changed)
            if ($typeBoisson->getTypeBoisson() === $this) {
                $typeBoisson->setTypeBoisson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Soft>
     */
    public function getSofts(): Collection
    {
        return $this->softs;
    }

    public function addSoft(Soft $soft): self
    {
        if (!$this->softs->contains($soft)) {
            $this->softs[] = $soft;
            $soft->setTypeBoisson($this);
        }

        return $this;
    }

    public function removeSoft(Soft $soft): self
    {
        if ($this->softs->removeElement($soft)) {
            // set the owning side to null (unless already changed)
            if ($soft->getTypeBoisson() === $this) {
                $soft->setTypeBoisson(null);
            }
        }

        return $this;
    }
}
