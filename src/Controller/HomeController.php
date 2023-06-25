<?php

namespace App\Controller;

use App\Repository\PresentationExhibitionRepository;
use App\Service\StatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private StatisticService $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }
    #[Route('/', name: 'app_home')]
    public function index(PresentationExhibitionRepository $presExhibitRepo): Response
    {
        $exhibitions = $presExhibitRepo->findAll();
        $this->statisticService->recordPageVisit('home');

        return $this->render(
            'home/index.html.twig',
            ['exhibitions' => $exhibitions]
        );
    }
}
