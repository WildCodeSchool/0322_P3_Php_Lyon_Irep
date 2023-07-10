<?php

namespace App\Controller;

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

    #[Route('/admin/statistics', name: 'admin_statistics')]
    public function showStatistics(PictureRepository $pictureRepository): Response
    {
        $homePageVisitsCount = $this->dateFormatService->formatDateArray(
            $this->statisticService->getPageVisitsCountByRouteWithDates('app_home')
        );

        $galleryVisitsCount = $this->dateFormatService->formatDateArray(
            $this->statisticService->getPageVisitsCountByRouteWithDates('app_picture_index')
        );

        $pictures = $pictureRepository->findAll();
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
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
