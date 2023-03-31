<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    //*type = ENUM = Plant, Seed */
    #[ORM\Column(type: "string", enumType: TypeProduct::class)]
    private TypeProduct $type;

    //*genus for Plant & Seed */
   #[ORM\ManyToOne(inversedBy: 'genus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genus $genus_id_FK;

    /* #[ORM\Column(length: 255)]
    private ?string $genus = null;  */

    //*state, height, with_pot, pot_height for Plant ONLY */
    /*state = ENUM = sprout, cutting, baby, adult */
    #[ORM\Column(type: "string", nullable: true, enumType: StatePlant::class)]
    private StatePlant $state;

    /* Express in centimeter (cm) */
    #[ORM\Column(nullable: true)]
    private ?int $height = null;

    #[ORM\Column]
    private ?bool $with_pot = null;

    #[ORM\Column(nullable: true)]
    private ?int $pot_height = null;

    //*species & vernaculary_name for Plant & Seed */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $species = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vernaculary_name = null;

//* Id
    public function getIdPlant(): ?int
    {
        return $this->id;
    }

//* Quantity
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

//* Type - Plant or Seed
    public function getType(): TypeProduct
    {
        return $this->type;
    }
    public function setType(): TypeProduct
    {
        return $this->type;
    }

//*Genus
    public function getGenus():Genus
    {
        return $this->genus_id_FK;
    }
    public function setGenus(string $genus_id_FK): self
    {
        $this->genus_id_FK = $genus_id_FK;

        return $this;
    }

//* Height - Plant Only
    public function getHeight(): ?int
    {
        return $this->height;
    }
    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

//* State = ENUM = sprout, cutting, baby, adult */
    public function getState(): ?StatePlant
    {
        return $this->state;
    }
    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

//* Pot - Plant Only
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

//* Species - Plant & Seed
    public function getSpecies(): ?string
    {
        return $this->species;
    }
    public function setSpecies(?string $species): self
    {
        $this->species = $species;

        return $this;
    }

//*Vernaculary Name - Plant & Seed
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
