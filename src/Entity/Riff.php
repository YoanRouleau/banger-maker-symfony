<?php

namespace App\Entity;

use App\Repository\RiffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RiffRepository::class)
 */
class Riff
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
     * @ORM\Column(type="string", length=255)
     */
    private $decription;

    /**
     * @ORM\Column(type="text")
     */
    private $customsongfile;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="riffs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Instrument::class, inversedBy="riffs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $instrument;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="riffs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="riff", orphanRemoval=true)
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
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

    public function setDecription(string $decription): self
    {
        $this->decription = $decription;

        return $this;
    }

    public function getCustomsongfile(): ?string
    {
        return $this->customsongfile;
    }

    public function setCustomsongfile(string $customsongfile): self
    {
        $this->customsongfile = $customsongfile;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getInstrument(): ?Instrument
    {
        return $this->instrument;
    }

    public function setInstrument(?Instrument $instrument): self
    {
        $this->instrument = $instrument;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setRiff($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getRiff() === $this) {
                $note->setRiff(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
    public function getAverageNote(){
        $notes = $this->getNotes();
        $somme = 0;
        for ($i = 1; $i <= count($notes); $i++){
            $somme += $notes[$i-1]->getNote();
        }
        if (count($notes)!=0) {
            return $somme / count($notes);
        }
        else
            return 0;

    }

    public function getAverageNoteScaled(){
        $note = $this->getAverageNote();
        switch (true) {
            case (0<$note and $note <20 ) :
               return 1;
                break;
            case (20<=$note and $note <40 ):
                return 2;
                break;
            case (40<=$note and $note <60 ):
                return 3;
                break;
            case (60<=$note and $note <80 ):
                return 4;
                break;
            case (80<=$note and $note <=100 ):
                return 5;
                break;
        }
        return 0;

    }
}
