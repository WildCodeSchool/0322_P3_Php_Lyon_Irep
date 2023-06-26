<?php

namespace App\Entity;

use App\Repository\PageVisitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageVisitRepository::class)]
class PageVisit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $routeName = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $visitedAt = null;

    #[ORM\ManyToOne(inversedBy: 'pageVisits')]
    private ?Picture $picture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRouteName(): ?string
    {
        return $this->routeName;
    }

    public function setRouteName(string $routeName): static
    {
        $this->routeName = $routeName;

        return $this;
    }

    public function getVisitedAt(): ?\DateTimeInterface
    {
        return $this->visitedAt;
    }

    public function setVisitedAt(\DateTimeInterface $visitedAt): static
    {
        $this->visitedAt = $visitedAt;

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): static
    {
        $this->picture = $picture;

        return $this;
    }
}
