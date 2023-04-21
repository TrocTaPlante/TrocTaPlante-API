<?php

namespace App\Entity;
//use App\Entity\EnumType\TypePost;
use App\Config\TypePost;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post //*Annonces*//
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    //#[Groups(['read:collection'])]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Product $product_id_FK = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id_FK = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    //#[Groups(['read:collection'])]
    private ?\DateTimeInterface $created_at = null;

    /* Type = ENUM = plant or seed */
    //#[ORM\Column(length: 255)]
    //private ?string $type = null;
    #[ORM\Column(type: "string", enumType: TypePost::class)]
    //#[Groups(['read:collection'])]
    public TypePost $type;

    /* State = ENUM = unpublished, published, traded, deleted, refused */
    //#[ORM\Column(length: 255)]
    //private ?string $state = null;
    #[ORM\Column(type: "string", enumType: StatePost::class)]
    //#[Groups(['read:collection'])]
    public StatePost $state;

    /* If the post has been validated by an admin */
    #[ORM\Column]
    private ?bool $validated = null;

    #[ORM\OneToMany(mappedBy: 'post_id_FK', targetEntity: Message::class, orphanRemoval: true)]
    //#[Groups(['read:collection'])]
    public Collection $messages;

    public function __construct()
    {
        $this->state = StatePost::unpublished;
        $this->type = TypePost::plant;
        $this->messages = new ArrayCollection();
    }
//* Id
    public function getIdPost(): ?int
    {
        return $this->id;
    }

//* FK Product
    public function getPlantIdFK(): ?Product
    {
        return $this->product_id_FK;
    }
    public function setPlantIdFK(?Product $product_id_FK): self
    {
        $this->product_id_FK = $product_id_FK;

        return $this;
    }

//* FK User
    public function getUserIdFK(): ?User
    {
        return $this->user_id_FK;
    }
    public function setUserIdFK(?User $user_id_FK): self
    {
        $this->user_id_FK = $user_id_FK;

        return $this;
    }

//* Created at
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

//* Type
    public function getType(): ?TypePost
    {
        return $this->type;
    }
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

//* State
    public function getState(): ?StatePost
    {
        return $this->state;
    }
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

//* Validated
    public function setValidated(string $validated): self
    {
        $this->validated = $validated;

        return $this;
    }

//* Message table Link
    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }
    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setPostIdFK($this);
        }
        return $this;
    }
    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getPostIdFK() === $this) {
                $message->setPostIdFK(null);
            }
        }
        return $this;
    }
}
