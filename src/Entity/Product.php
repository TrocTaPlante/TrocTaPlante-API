<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column]
    public ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    public ?Genus $genus = null;

    #[ORM\Column(length: 255)]
    public ?string $state = null;

    #[ORM\Column]
    public ?int $height = null;

    #[ORM\Column]
    public ?int $pot_width = null;

    #[ORM\Column]
    public ?int $pot_height = null;

    #[ORM\Column(length: 255)]
    public ?string $species = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    public ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGenus(): ?Genus
    {
        return $this->genus;
    }

    public function setGenus(?Genus $genus): self
    {
        $this->genus = $genus;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getPotWidth(): ?int
    {
        return $this->pot_width;
    }

    public function setPotWidth(int $pot_width): self
    {
        $this->pot_width = $pot_width;

        return $this;
    }

    public function getPotHeight(): ?int
    {
        return $this->pot_height;
    }

    public function setPotHeight(int $pot_height): self
    {
        $this->pot_height = $pot_height;

        return $this;
    }

    public function getSpecies(): ?string
    {
        return $this->species;
    }

    public function setSpecies(string $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
