<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ApiResource]
class Comment //*Commentaire sur une annonce*//
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_comment;

    /*Nullable if user line has been deleted*/
    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $editor_id_FK = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post_id_FK = null;

    /* State = ENUM = inactive, unverified, verified, reported */
    //#[ORM\Column(length: 255)]
    //private ?string $state = null;
    #[ORM\Column(type: "string", enumType: StateComment::class)]
    private StateComment $state;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    public function getIdComment(): ?int
    {
        return $this->id_comment;
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

    public function getPostIdFK(): ?Post
    {
        return $this->post_id_FK;
    }

    public function setPostIdFK(?Post $post_id_FK): self
    {
        $this->post_id_FK = $post_id_FK;

        return $this;
    }

    public function getState(): ?StateComment
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
