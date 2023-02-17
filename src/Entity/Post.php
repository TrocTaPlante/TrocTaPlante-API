<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_post = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Plant $plant_id_FK = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Seed $seed_id_FK = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id_FK = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    /* Type = ENUM = plant or seed */
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $state = null;

    #[ORM\Column]
    private ?bool $validated = null;

    #[ORM\OneToMany(mappedBy: 'post_id_FK', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPost(): ?int
    {
        return $this->id_post;
    }

    public function setIdPost(int $id_post): self
    {
        $this->id_post = $id_post;

        return $this;
    }

    public function getPlantIdFK(): ?Plant
    {
        return $this->plant_id_FK;
    }

    public function setPlantIdFK(?Plant $plant_id_FK): self
    {
        $this->plant_id_FK = $plant_id_FK;

        return $this;
    }

    public function getSeedIdFK(): ?Seed
    {
        return $this->seed_id_FK;
    }

    public function setSeedIdFK(?Seed $seed_id_FK): self
    {
        $this->seed_id_FK = $seed_id_FK;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function setValidated(string $validated): self
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setPostIdFK($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPostIdFK() === $this) {
                $comment->setPostIdFK(null);
            }
        }

        return $this;
    }
}
