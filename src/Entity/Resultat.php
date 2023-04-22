<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Traits\TimeStampTraits;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ResultatRepository;

#[ORM\Entity(repositoryClass: ResultatRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Resultat
{
    use TimeStampTraits;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filliere = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descr = null;

    #[ORM\Column(nullable: true)]
    private ?int $perc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filliere2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descr2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $perc2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filliere3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descr3 = null;

    #[ORM\Column(nullable: true)]
    private ?int $perc3 = null;

    #[ORM\ManyToOne(inversedBy: 'resultats')]
    private ?utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilliere(): ?string
    {
        return $this->filliere;
    }

    public function setFilliere(?string $filliere): self
    {
        $this->filliere = $filliere;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    public function getPerc(): ?int
    {
        return $this->perc;
    }

    public function setPerc(?int $perc): self
    {
        $this->perc = $perc;

        return $this;
    }

    public function getFilliere2(): ?string
    {
        return $this->filliere2;
    }

    public function setFilliere2(?string $filliere2): self
    {
        $this->filliere2 = $filliere2;

        return $this;
    }

    public function getDescr2(): ?string
    {
        return $this->descr2;
    }

    public function setDescr2(?string $descr2): self
    {
        $this->descr2 = $descr2;

        return $this;
    }

    public function getPerc2(): ?int
    {
        return $this->perc2;
    }

    public function setPerc2(?int $perc2): self
    {
        $this->perc2 = $perc2;

        return $this;
    }

    public function getFilliere3(): ?string
    {
        return $this->filliere3;
    }

    public function setFilliere3(?string $filliere3): self
    {
        $this->filliere3 = $filliere3;

        return $this;
    }

    public function getDescr3(): ?string
    {
        return $this->descr3;
    }

    public function setDescr3(?string $descr3): self
    {
        $this->descr3 = $descr3;

        return $this;
    }

    public function getPerc3(): ?int
    {
        return $this->perc3;
    }

    public function setPerc3(?int $perc3): self
    {
        $this->perc3 = $perc3;

        return $this;
    }

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
