<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $auteur = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $titre = null;

    #[ORM\ManyToOne(inversedBy: 'livres')]
    private ?Librairie $librairie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getauteur(): ?string
    {
        return $this->auteur;
    }

    public function setauteur(string $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function gettitre(): ?string
    {
        return $this->titre;
    }

    public function settitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLibrairie(): ?Librairie
    {
        return $this->librairie;
    }

    public function setLibrairie(?Librairie $librairie): static
    {
        $this->librairie = $librairie;

        return $this;
    }

    public function __toString(): string
    {
        return $this->titre;
    }
}
