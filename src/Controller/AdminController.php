<?php

namespace App\Controller;

use App\Entity\Exhibition;
use App\Repository\ExhibitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    #[Route('/admin/list', name: 'admin_exhibition_list')]
    public function listExhibition(ExhibitionRepository $exhibitionRepository): Response
    {
        $exhibitionRepository = $exhibitionRepository->findAll();

        return $this->render('admin/list.html.twig', [
            'exhibitions' => $exhibitionRepository
        ]);
    }


/*   #[Route('/admin/exhibition/{id}', name: 'admin_exhibition_showlist')]
   public function showPresentationExhibition(Exhibition $exhibition): Response
    {
        $presExhibitions = $exhibition->getPresentations();

        return $this->render('admin/showlist.html.twig', [
            'presentationExhibitions' => $presExhibitions,
        ]);
    }
    */
}
