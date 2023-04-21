<?php
namespace App\Entity;
use App\Config\StateMessage;


use App\Repository\MessageRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ApiResource]
class Message //*Message between*//
//TODO tester les groups
//TODO continuer vidéo https://www.youtube.com/watch?v=PLBYYe435qo&list=PLjwdMgw5TTLU7DcDwEt39EvPBi9EiJnF4&index=3
// symfony serve pour allumer et tester le serveur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_message;

    /*Nullable if user line has been deleted*/
    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $editor_id_FK = null;

    /*Nullable if user line has been deleted*/
    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $receptor_id_FK = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Post $post_id_FK = null;

    /* State = ENUM = inactive, unverified, verified, reported */
    //#[ORM\Column(length: 255)]
    //private ?string $state = null;
    #[ORM\Column(type: "string", enumType: StateMessage::class)]
    public StateMessage $state;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

/* CONSTRUCTOR */
    public function __construct()
    {
        $this->state = StateMessage::toValidate;
    }

    public function getIdMessage(): ?int
    {
        return $this->id_message;
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

    public function getReceptorIdFK(): ?User
    {
        return $this->receptor_id_FK;
    }

    public function setReceptorIdFK(?User $receptor_id_FK): self
    {
        $this->receptor_id_FK = $receptor_id_FK;

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

    public function getState(): ?StateMessage
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
