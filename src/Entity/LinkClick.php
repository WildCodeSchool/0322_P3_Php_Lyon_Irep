<?php

namespace App\Entity;

use App\Repository\LinkClickRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkClickRepository::class)]
class LinkClick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $clickedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getClickedAt(): ?\DateTimeInterface
    {
        return $this->clickedAt;
    }

    public function setClickedAt(\DateTimeInterface $clickedAt): static
    {
        $this->clickedAt = $clickedAt;

        return $this;
    }
}
