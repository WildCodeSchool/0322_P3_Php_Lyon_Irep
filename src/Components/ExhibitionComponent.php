<?php

namespace App\Components;

use App\Repository\ExhibitionRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class ExhibitionComponent
{
    private ExhibitionRepository $exhibitionRepository;

    public function __construct(ExhibitionRepository $exhibitionRepository)
    {
        $this->exhibitionRepository = $exhibitionRepository;
    }

    public function getExhibitions(): array
    {
        return $this->exhibitionRepository->findAll();
    }
}
