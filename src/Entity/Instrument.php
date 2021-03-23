<?php

namespace App\Entity;

use App\Repository\InstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstrumentRepository::class)
 */
class Instrument
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
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $customId;

    /**
     * @ORM\OneToMany(targetEntity=Riff::class, mappedBy="instrument", orphanRemoval=true)
     */
    private $riffs;

    public function __construct()
    {
        $this->riffs = new ArrayCollection();
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCustomId(): ?int
    {
        return $this->customId;
    }

    public function setCustomId(int $customId): self
    {
        $this->customId = $customId;

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
            $riff->setInstrument($this);
        }

        return $this;
    }

    public function removeRiff(Riff $riff): self
    {
        if ($this->riffs->removeElement($riff)) {
            // set the owning side to null (unless already changed)
            if ($riff->getInstrument() === $this) {
                $riff->setInstrument(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->name;
    }

}
