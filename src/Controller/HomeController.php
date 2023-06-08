<?php

namespace App\Controller;

use App\Repository\ExhibitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ExhibitionRepository $exhibitionRepository): Response
    {   
        $exhibitions = $exhibitionRepository->findAll();

        return $this->render('home/index.html.twig', 
        ['exhibitions' => $exhibitions]
        );
    }
}
