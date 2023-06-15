<?php

namespace App\Entity;

use App\Repository\ExhibitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExhibitionRepository::class)]
class Exhibition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\OneToMany(mappedBy: 'exhibition', targetEntity: PresentationExhibition::class)]
    private Collection $presExhibition;

    public function __construct()
    {
        $this->presExhibition = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return Collection<int, PresentationExhibition>
     */
    public function getPresentationExhibitions(): Collection
    {
        return $this->presExhibition;
    }

    public function addPresentationExhibition(PresentationExhibition $presExhibition): self
    {
        if (!$this->presExhibition->contains($presExhibition)) {
            $this->presExhibition->add($presExhibition);
            $presExhibition->setExhibition($this);
        }

        return $this;
    }

    public function removePresentationExhibition(PresentationExhibition $presExhibition): self
    {
        if ($this->presExhibition->removeElement($presExhibition)) {
            // set the owning side to null (unless already changed)
            if ($presExhibition->getExhibition() === $this) {
                $presExhibition->setExhibition(null);
            }
        }

        return $this;
    }
}
