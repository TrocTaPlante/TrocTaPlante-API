<?php

namespace App\Entity;

use App\Repository\SeedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeedRepository::class)]
class Seed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_seed = null;

    #[ORM\Column(length: 255)]
    private ?string $genus = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $species = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vernaculary_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSeed(): ?int
    {
        return $this->id_seed;
    }

    public function setIdSeed(int $id_seed): self
    {
        $this->id_seed = $id_seed;

        return $this;
    }

    public function getGenus(): ?string
    {
        return $this->genus;
    }

    public function setGenus(string $genus): self
    {
        $this->genus = $genus;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(?string $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getVernacularyName(): ?string
    {
        return $this->vernaculary_name;
    }

    public function setVernacularyName(?string $vernaculary_name): self
    {
        $this->vernaculary_name = $vernaculary_name;

        return $this;
    }
}
