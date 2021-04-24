<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $decription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity=Riff::class, mappedBy="categorie", orphanRemoval=true)
     */
    private $riffs;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="sousCategories")
     */
    private $superCategorie;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="superCategorie")
     */
    private $sousCategories;

    public function __construct()
    {
        $this->riffs = new ArrayCollection();
        $this->sousCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDecription(): ?string
    {
        return $this->decription;
    }

    public function setDecription(?string $decription): self
    {
        $this->decription = $decription;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Riff[]
     */
    public function getRiffs(): Collection
    {
        return $this->riffs;
    }

    public function addRiff(Riff $riff): self
    {
        if (!$this->riffs->contains($riff)) {
            $this->riffs[] = $riff;
            $riff->setCategorie($this);
        }

        return $this;
    }

    public function removeRiff(Riff $riff): self
    {
        if ($this->riffs->removeElement($riff)) {
            // set the owning side to null (unless already changed)
            if ($riff->getCategorie() === $this) {
                $riff->setCategorie(null);
            }
        }

        return $this;
    }

    public function getSuperCategorie(): ?self
    {
        return $this->superCategorie;
    }

    public function setSuperCategorie(?self $superCategorie): self
    {
        $this->superCategorie = $superCategorie;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategory(self $sousCategory): self
    {
        if (!$this->sousCategories->contains($sousCategory)) {
            $this->sousCategories[] = $sousCategory;
            $sousCategory->setSuperCategorie($this);
        }

        return $this;
    }

    public function removeSousCategory(self $sousCategory): self
    {
        if ($this->sousCategories->removeElement($sousCategory)) {
            // set the owning side to null (unless already changed)
            if ($sousCategory->getSuperCategorie() === $this) {
                $sousCategory->setSuperCategorie(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
     return $this->name;
    }

}
