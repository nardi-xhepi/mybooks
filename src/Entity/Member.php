<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'member', targetEntity: Librairie::class)]
    private Collection $librairie;

    public function __construct()
    {
        $this->librairie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function __toString(): string
    {
        return $this->description;
    }

    /**
     * @return Collection<int, Librairie>
     */
    public function getLibrairie(): Collection
    {
        return $this->librairie;
    }

    public function addLibrairie(Librairie $librairie): static
    {
        if (!$this->librairie->contains($librairie)) {
            $this->librairie->add($librairie);
            $librairie->setMember($this);
        }

        return $this;
    }

    public function removeLibrairie(Librairie $librairie): static
    {
        if ($this->librairie->removeElement($librairie)) {
            // set the owning side to null (unless already changed)
            if ($librairie->getMember() === $this) {
                $librairie->setMember(null);
            }
        }

        return $this;
    }
}
