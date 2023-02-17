<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_plant = null;

    #[ORM\Column(length: 255)]
    private ?string $genus = null;

    #[ORM\Column(nullable: true)]
    private ?int $height = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $state = null;

    #[ORM\Column]
    private ?bool $with_pot = null;

    #[ORM\Column(nullable: true)]
    private ?int $pot_height = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $species = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vernaculary_name = null;

    public function getId(): ?int
    {
        return $this->id_plant;
    }

    public function getIdPlant(): ?int
    {
        return $this->id_plant;
    }

    public function setIdPlant(int $id_plant): self
    {
        $this->id_plant = $id_plant;

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

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function isWithPot(): ?bool
    {
        return $this->with_pot;
    }

    public function setWithPot(bool $with_pot): self
    {
        $this->with_pot = $with_pot;

        return $this;
    }

    public function getPotHeight(): ?int
    {
        return $this->pot_height;
    }

    public function setPotHeight(?int $pot_height): self
    {
        $this->pot_height = $pot_height;

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
