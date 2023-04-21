<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReportingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportingRepository::class)]
#[ApiResource]
class Reporting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    //* Source - ENUM = post, message, review
    #[ORM\Column(type: "string", enumType: SourceReporting::class)]
    private SourceReporting $source;

    //* Reason - ENUM = "insult", "foreign", "misspelling"
    #[ORM\Column(type: "string", enumType: ReasonReporting::class)]
    private ReasonReporting $reason;

    #[ORM\Column(length: 255)]
    private ?string $state = null;

    #[ORM\Column]
    private ?int $source_id = null;

/* CONSTRUCTOR */
    public function __construct()
    {
        $this->source = SourceReporting::post;
        $this->reason = ReasonReporting::misspelling;
    }

//* Id
    public function getId(): ?int
    {
        return $this->id;
    }

//* Date
    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }
    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;
        return $this;
    }

//* Source - ENUM = post, message, review
    public function getSource(): SourceReporting
    {
        return $this->source;
    }
    public function setSource(int $source): self
    {
        $this->source = $source;
        return $this;
    }
    //*id from Post, Message or Review depend on "source" field
    public function getSourceId(): ?int
    {
        return $this->source_id;
    }
    public function setSourceId(int $source_id): self
    {
        $this->source_id = $source_id;
        return $this;
    }

//* Reason - ENUM = "insult", "foreign", "misspelling"
    public function getReason(): ?ReasonReporting
    {
        return $this->reason;
    }
    public function setReason(string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

//* State - ENUM
    public function getState(): ?string
    {
        return $this->state;
    }
    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

}
