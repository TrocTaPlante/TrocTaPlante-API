<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User //*Utilisateur*//
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $email;

    #[ORM\Column(length: 255)]
    private ?string $password_hash = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $zipcode = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    /* Role = ENUM = "anonymous", "basic", "moderator", "administrator" or "super" */
    //#[ORM\Column(length: 255)]
    #[ORM\Column(type: "string", enumType: RoleUser::class)]
    private RoleUser $role;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column]
    private ?bool $validated = null;

    /* If the user has been bloqued by Super Admin - must be anonymized */
    #[ORM\Column]
    private ?bool $bloqued = null;

    #[ORM\Column(length: 255)]
    private ?string $street_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $street_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\OneToMany(mappedBy: 'user_id_FK', targetEntity: Post::class, orphanRemoval: true)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: 'editor_id_FK', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $comments;

    #[ORM\OneToMany(mappedBy: 'user_id_FK', targetEntity: Review::class)]
    private Collection $reviews;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->role = RoleUser::anonymous;
        $this->reviews = new ArrayCollection();
    }

//* Id
    public function getIdUser(): ?int
    {
        return $this->id;
    }

//* Email
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

//* Password
    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }
    public function setPasswordHash(string $password_hash): self
    {
        $this->password_hash = $password_hash;

        return $this;
    }

//* Pseudo
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

//* City
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

//* Zip Code
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

//* Latitude
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }
    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

//* Longitude
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

//* Role - ENUM = anonymous", "basic", "moderator","administrator" or "super
    public function getRole(): ?RoleUser
    {
        return $this->role;
    }
    public function setRole(string $role): self
    {
        $this->role = $role;

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

//* Validated
    public function isValidated(): ?bool
    {
        return $this->validated;
    }
    public function setValidated(bool $validated): self
    {
        $this->validated = $validated;

        return $this;
    }

//* Bloqued
    public function isBloqued(): ?bool
    {
        return $this->bloqued;
    }
    public function setBloqued(bool $bloqued): self
    {
        $this->bloqued = $bloqued;

        return $this;
    }

//* Phone
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

//* Firstname
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

//* Lastname
    public function getLastname(): ?string
    {
        return $this->lastname;
    }
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

//* FK Post
    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }
    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setUserIdFK($this);
        }

        return $this;
    }
    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUserIdFK() === $this) {
                $post->setUserIdFK(null);
            }
        }

        return $this;
    }

//* Street name
public function getStreetName(): ?string
{
    return $this->street_name;
}
public function setStreetName(string $street_name): self
{
    $this->street_name = $street_name;
    return $this;
}

//* Street number
public function getStreetNumber(): ?string
{
    return $this->street_number;
}
public function setStreetNumber(?string $street_number): self
{
    $this->street_number = $street_number;
    return $this;
}

//* FK Comment
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
            $comment->setEditorIdFK($this);
        }
        return $this;
    }
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEditorIdFK() === $this) {
                $comment->setEditorIdFK(null);
            }
        }
        return $this;
    }


//* FK Review
    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setUserIdFK($this);
        }
        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getUserIdFK() === $this) {
                $review->setUserIdFK(null);
            }
        }
        return $this;
    }
}
