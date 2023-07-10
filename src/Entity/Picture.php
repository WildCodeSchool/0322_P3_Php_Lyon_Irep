<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'picture', targetEntity: PageVisit::class, cascade: ["remove"])]
    private Collection $pageVisits;

    public function __construct()
    {
        $this->pageVisits = new ArrayCollection();
    }

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageCrop = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $smallImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mediumImage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $largeImage = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exhibition $exhibition = null;


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

    /**
     * @return Collection<int, PageVisit>
     */
    public function getPageVisits(): Collection
    {
        return $this->pageVisits;
    }

    public function addPageVisit(PageVisit $pageVisit): static
    {
        if (!$this->pageVisits->contains($pageVisit)) {
            $this->pageVisits->add($pageVisit);
            $pageVisit->setPicture($this);
        }

        return $this;
    }

    public function removePageVisit(PageVisit $pageVisit): static
    {
        if ($this->pageVisits->removeElement($pageVisit)) {
            // set the owning side to null (unless already changed)
            if ($pageVisit->getPicture() === $this) {
                $pageVisit->setPicture(null);
            }
        }

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

    public function getImageCrop(): ?string
    {
        return $this->imageCrop;
    }

    public function setImageCrop(?string $imageCrop): self
    {
        $this->imageCrop = $imageCrop;

        return $this;
    }

    public function getSmallImage(): ?string
    {
        return $this->smallImage;
    }

    public function setSmallImage(?string $smallImage): self
    {
        $this->smallImage = $smallImage;

        return $this;
    }

    public function getMediumImage(): ?string
    {
        return $this->mediumImage;
    }

    public function setMediumImage(?string $mediumImage): self
    {
        $this->mediumImage = $mediumImage;

        return $this;
    }

    public function getLargeImage(): ?string
    {
        return $this->largeImage;
    }

    public function setLargeImage(?string $largeImage): self
    {
        $this->largeImage = $largeImage;

        return $this;
    }

    public function getExhibition(): ?Exhibition
    {
        return $this->exhibition;
    }

    public function setExhibition(?Exhibition $exhibition): static
    {
        $this->exhibition = $exhibition;

        return $this;
    }
}
