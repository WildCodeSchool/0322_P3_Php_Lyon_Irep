<?php

namespace App\Controller;

use App\Repository\PresentationExhibitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PresentationExhibitionRepository $presExhibitRepo): Response
    {
        $exhibitions = $presExhibitRepo->findAll();

        return $this->render(
            'home/index.html.twig',
            ['exhibitions' => $exhibitions]
        );
    }
}
