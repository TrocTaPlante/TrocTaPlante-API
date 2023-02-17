<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_comment = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $editor_id_FK = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post_id_FK = null;

    #[ORM\Column(length: 255)]
    private ?string $state = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdComment(): ?int
    {
        return $this->id_comment;
    }

    public function setIdComment(int $id_comment): self
    {
        $this->id_comment = $id_comment;

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

    public function getPostIdFK(): ?Post
    {
        return $this->post_id_FK;
    }

    public function setPostIdFK(?Post $post_id_FK): self
    {
        $this->post_id_FK = $post_id_FK;

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
