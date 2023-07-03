<?php

namespace App\Entity;

use App\Repository\ExhibitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExhibitionRepository::class)]
class Exhibition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le nom de l'exposition est trop long. Veuillez limiter votre saisie à 255 caractères."
    )]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'exhibition', targetEntity: Presentation::class, orphanRemoval: true)]
    private Collection $presentations;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThanOrEqual(
        'today',
        message: "La date saisie ne peut pas être antérieure à la date du jour."
    )]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\GreaterThan(
        'today',
        message: "La date saisie doit obligatoirement être supérieure à la date du jour."
    )]
    private ?\DateTimeInterface $end = null;

    #[ORM\OneToMany(mappedBy: 'exhibition', targetEntity: Newsletter::class)]
    private Collection $newsletters;

    public function __construct()
    {
        $this->presentations = new ArrayCollection();
        $this->newsletters = new ArrayCollection();
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


    /**
     * @return Collection<int, Presentation>
     */
    public function getPresentations(): Collection
    {
        return $this->presentations;
    }

    public function addPresentation(Presentation $presentation): self
    {
        if (!$this->presentations->contains($presentation)) {
            $this->presentations->add($presentation);
            $presentation->setExhibition($this);
        }

        return $this;
    }

    public function removePresentation(Presentation $presentation): self
    {
        if ($this->presentations->removeElement($presentation)) {
            // set the owning side to null (unless already changed)
            if ($presentation->getExhibition() === $this) {
                $presentation->setExhibition(null);
            }
        }

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
     * @return Collection<int, Newsletter>
     */
    public function getNewsletters(): Collection
    {
        return $this->newsletters;
    }

    public function addNewsletter(Newsletter $newsletter): self
    {
        if (!$this->newsletters->contains($newsletter)) {
            $this->newsletters->add($newsletter);
            $newsletter->setExhibition($this);
        }

        return $this;
    }

    public function removeNewsletter(Newsletter $newsletter): self
    {
        if ($this->newsletters->removeElement($newsletter)) {
            // set the owning side to null (unless already changed)
            if ($newsletter->getExhibition() === $this) {
                $newsletter->setExhibition(null);
            }
        }

        return $this;
    }
}
