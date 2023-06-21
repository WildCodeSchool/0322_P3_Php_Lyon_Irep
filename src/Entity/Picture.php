<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reference = null;


    #[ORM\Column(length: 255)]
    private ?string $title = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subtitle = null;





    #[ORM\Column(length: 255, nullable: true)]
    private ?string $technic = null;


    #[ORM\Column(length: 255)]
    private ?string $size = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $category = null;


    #[ORM\Column(nullable: true)]
    private ?int $number = null;


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;


    #[ORM\Column(length: 300, nullable: true)]
    private ?string $link = null;


    #[ORM\Column(length: 255)]
    private ?string $image = null;
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getReference(): ?string
    {
        return $this->reference;
    }


    public function setReference(?string $reference): self
    {
        $this->reference = $reference;


        return $this;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }


    public function setTitle(string $title): self
    {
        $this->title = $title;


        return $this;
    }


    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }


    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;


        return $this;
    }








    public function getTechnic(): ?string
    {
        return $this->technic;
    }


    public function setTechnic(?string $technic): self
    {
        $this->technic = $technic;


        return $this;
    }


    public function getSize(): ?string
    {
        return $this->size;
    }


    public function setSize(string $size): self
    {
        $this->size = $size;


        return $this;
    }


    public function getCategory(): ?string
    {
        return $this->category;
    }


    public function setCategory(?string $category): self
    {
        $this->category = $category;


        return $this;
    }


    public function getNumber(): ?int
    {
        return $this->number;
    }


    public function setNumber(?int $number): self
    {
        $this->number = $number;


        return $this;
    }


    public function getComment(): ?string
    {
        return $this->comment;
    }


    public function setComment(?string $comment): self
    {
        $this->comment = $comment;


        return $this;
    }


    public function getLink(): ?string
    {
        return $this->link;
    }


    public function setLink(?string $link): self
    {
        $this->link = $link;


        return $this;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }


    public function setImage(string $image): self
    {
        $this->image = $image;


        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }
}
