<?php

namespace App\Entity;

use App\Repository\DiscRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscRepository::class)]
class Disc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\ManyToOne(inversedBy: 'discs')]
    private ?Artist $artist = null;

    #[ORM\Column(length:255)]
    private ?int $year = null;

    #[ORM\Column(length:255)]
    private ?string $genre = null;

    // #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    // private ?float $prix = null;

    // #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    // private ?string $prix = null;
    #[ORM\Column(type: 'integer', precision: 10, nullable: true)]
    private ?int $prix = null;


    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?int $quantite = null;


    #[ORM\OneToMany(mappedBy: 'disc', targetEntity: Detail::class)]
    private Collection $details;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }


    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }


    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

     /**
     * @ORM\Column(type="integer")
     */
    // private $sales;
    // private $vente;

    #[ORM\Column(nullable: true)]
    private ?int $quantiteVendu = null;

    public function getQuantiteVendu(): ?int
    {
        return $this->quantiteVendu;
    }

    public function setQuantiteVendu(?int $quantiteVendu): static
    {
        $this->quantiteVendu = $quantiteVendu;

        return $this;
    }


    /**
     * @return Collection|Detail[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Detail $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setDisc($this);
        }

        return $this;
    }

    public function removeDetail(Detail $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getDisc() === $this) {
                $detail->setDisc(null);
            }
        }

        return $this;
    }

    // public function getVente(): ?int
    // {
    //     return $this->vente;
    // }

    // public function setVente(?int $vente): static
    // {
    //     $this->vente = $vente;

    //     return $this;
    // }

   
}
