<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ApiResource]
class Review //*Avis sur un troqueur*//
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    //* FK from User
    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?User $user_id_FK = null;
    //* FK from User
    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?User $editor_id_FK = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $content = null;

    #[ORM\Column]//*limited 1 to 5*//
    private ?int $note = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /* State = ENUM = unpublished, published, traded, deleted, refused */
    #[ORM\Column(type: "string", enumType: StatePost::class)]
    private StatePost $state;

/* CONSTRUCTOR */
    public function __construct()
    {
        $this->state = StatePost::unpublished;
    }

//* Id
    public function getIdReview(): ?int
    {
        return $this->id;
    }

    public function getUserIdFK(): ?User
    {
        return $this->user_id_FK;
    }
    public function setUserIdFK(?User $user_id_FK): self
    {
        $this->user_id_FK = $user_id_FK;

        return $this;
    }
    public function getEditorIdFK(): ?User
    {
        return $this->editor_id_FK;
    }
    public function setEditorIdFK(?User $editor_id_FK): self
    {
        $this->editor_id_FK = $editor_id_FK;

        return $this;
    }

//* Content
    public function getContent(): ?string
    {
        return $this->content;
    }
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

//* Note (from 1 to 5)
    public function getNote(): ?int
    {
        return $this->note;
    }
    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

//* Date
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

//* State ENUM = unpublished, published, traded, deleted, refused */
    public function getState(): ?StatePost
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
