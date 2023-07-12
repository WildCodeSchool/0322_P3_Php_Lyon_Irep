<?php

namespace App\Controller;

use App\Entity\Exhibition;
use App\Repository\ExhibitionRepository;
use App\Repository\PictureRepository;
use App\Service\StatisticService;
use App\Service\DateFormatService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    private StatisticService $statisticService;
    private DateFormatService $dateFormatService;

    public function __construct(StatisticService $statisticService, DateFormatService $dateFormatService)
    {
        $this->statisticService = $statisticService;
        $this->dateFormatService = $dateFormatService;
    }

    #[Route('/admin/statistics/{id}', name: 'admin_statistics')]
    public function showStatistics(
        PictureRepository $pictureRepository,
        ExhibitionRepository $exhibitionRepository,
        int $id = null
    ): Response {
        $exhibition = null;
        if ($id !== null) {
            $exhibition = $exhibitionRepository->find($id);
        } elseif ($id === null) {
            $exhibition = $exhibitionRepository->findOneBy([]);
        }

        $homePageVisitsCount = $this->dateFormatService->formatDateArray(
            $this->statisticService->getPageVisitsCountByRouteWithDates('app_home')
        );

        $galleryVisitsCount = [];
        if ($exhibition) {
            $galleryVisitsCount = $this->dateFormatService->formatDateArray(
                $this->statisticService->getPageVisitsCountByRouteWithDates('app_picture_index/' . $exhibition->getId())
            );
        }

        $pictures = $pictureRepository->findBy(['exhibition' => $exhibition]);
        $picturesWithCounts = [];
        $maxViewsCount = 0;

        foreach ($pictures as $picture) {
            $visitCount = $this->statisticService->getPageVisitsCountByPictureWithDates($picture);
            $picturesWithCounts[$picture->getTitle()] = $this->dateFormatService->formatDateArray($visitCount);

            if ($visitCount > $maxViewsCount) {
                $maxViewsCount = $visitCount;
            }
        }

        return $this->render('admin/statistics.html.twig', [
            'homePageVisitsCount' => $homePageVisitsCount,
            'galleryVisitsCount' => $galleryVisitsCount,
            'pictures' => $picturesWithCounts,
            'maxViewsCount' => $maxViewsCount,
            'exhibitions' => $exhibitionRepository->findAll(),
            'selectedExhibition' => $exhibition
        ]);
    }


    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        return $this->redirectToRoute('app_exhibition_index');
    }
}
