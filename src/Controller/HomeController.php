<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Repository\ExhibitionRepository;
use App\Repository\PresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PresentationRepository $presentRepository): Response
    {

        $presentations = $presentRepository->showPresentationByDate();

        return $this->render(
            'home/index.html.twig',
            ['presentations' => $presentations]
        );
    }
}
