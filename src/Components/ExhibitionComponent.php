<?php

namespace App\Components;

use App\Repository\ExhibitionRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class ExhibitionComponent
{
    private ExhibitionRepository $exhibitionRepository;
    private SessionInterface $session;

    public function __construct(ExhibitionRepository $exhibitionRepository, RequestStack $requestStack)
    {
        $this->exhibitionRepository = $exhibitionRepository;
        $this->session = $requestStack->getSession();
    }

    public function getExhibitions(): array
    {
        return $this->exhibitionRepository->findCurrentExhibitions();
    }

    public function getSelectedExhibition(): ?int
    {
        return $this->session->get('exhibitionId');
    }
}
