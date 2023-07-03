<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email(
        message: 'L\'adresse mail saisie n\'est pas valide.',
    )]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'newsletters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exhibition $exhibition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getExhibition(): ?Exhibition
    {
        return $this->exhibition;
    }

    public function setExhibition(?Exhibition $exhibition): self
    {
        $this->exhibition = $exhibition;

        return $this;
    }
}
