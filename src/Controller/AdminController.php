<?php

namespace App\Controller;

use App\Entity\Exhibition;
use App\Repository\ExhibitionRepository;
use App\Repository\PictureRepository;
use App\Service\StatisticService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    private StatisticService $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    #[Route('/admin/statistics', name: 'admin_statistics')]
    public function showStatistics(PictureRepository $pictureRepository): Response
    {
        $homePageVisitsCount = $this->statisticService->getPageVisitsCountByRoute('app_home');
        $galleryVisitsCount = $this->statisticService->getPageVisitsCountByRoute('app_picture_index');
        $pictures = $pictureRepository->findAll();
        $picturesWithCounts = [];

        foreach ($pictures as $picture) {
            $visitCount = $this->statisticService->getPageVisitsCountByPicture($picture);
            $picturesWithCounts[] = [
                'picture' => $picture,
                'count' => $visitCount
            ];
        }

        return $this->render('admin/statistics.html.twig', [
            'homePageVisitsCount' => $homePageVisitsCount,
            'galleryVisitsCount' => $galleryVisitsCount,
            'pictures' => $picturesWithCounts,
        ]);
    }

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


    #[Route('/admin/exhibition/{id}', name: 'admin_exhibition_showlist')]
    public function showPresentationExhibition(Exhibition $exhibition): Response
    {
        $presExhibitions = $exhibition->getPresentationExhibitions();

        return $this->render('admin/showlist.html.twig', [
            'presentationExhibitions' => $presExhibitions,
        ]);
    }
}
