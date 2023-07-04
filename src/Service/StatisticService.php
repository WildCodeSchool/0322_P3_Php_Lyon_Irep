<?php

namespace App\Service;

use App\Entity\PageVisit;
use App\Entity\Picture;
use App\Repository\PageVisitRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class StatisticService
{
    private EntityManagerInterface $entityManager;
    private PageVisitRepository $pageVisitRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        PageVisitRepository $pageVisitRepository,
    ) {
        $this->entityManager = $entityManager;
        $this->pageVisitRepository = $pageVisitRepository;
    }

    public function recordPageVisit(string $routeName, Picture $picture = null): void
    {
        $pageVisit = new PageVisit();
        $pageVisit->setRouteName($routeName);
        $pageVisit->setVisitedAt(new DateTime());

        if ($picture) {
            $pageVisit->setPicture($picture);
        }

        $this->entityManager->persist($pageVisit);
        $this->entityManager->flush();
    }

    public function getPageVisitsCountByRoute(string $routeName): int
    {
        return $this->pageVisitRepository->count(['routeName' => $routeName]);
    }

    public function getPageVisitsCountByPicture(Picture $picture): int
    {
        return $this->pageVisitRepository->count(['picture' => $picture]);
    }


    public function getPageVisitsCountByRouteWithDates(string $routeName): array
    {
        $visits = $this->pageVisitRepository->createQueryBuilder('pv')
            ->select("pv.visitedAt, COUNT(pv.id) AS count")
            ->where('pv.routeName = :routeName')
            ->setParameter('routeName', $routeName)
            ->groupBy('pv.visitedAt')
            ->getQuery()
            ->getResult();

        $groupedVisits = [];

        foreach ($visits as $visit) {
            $date = $visit['visitedAt']->format('Y-m-d');
            if (!isset($groupedVisits[$date])) {
                $groupedVisits[$date] = 0;
            }
            $groupedVisits[$date] += $visit['count'];
        }

        return $groupedVisits;
    }

    public function getPageVisitsCountByPictureWithDates(Picture $picture): array
    {
        $visits = $this->pageVisitRepository->createQueryBuilder('pv')
            ->select("pv.visitedAt, COUNT(pv.id) AS count")
            ->where('pv.picture = :picture')
            ->setParameter('picture', $picture)
            ->groupBy('pv.visitedAt')
            ->getQuery()
            ->getResult();

        $groupedVisits = [];

        foreach ($visits as $visit) {
            $date = $visit['visitedAt']->format('Y-m-d');
            if (!isset($groupedVisits[$date])) {
                $groupedVisits[$date] = 0;
            }
            $groupedVisits[$date] += $visit['count'];
        }

        return $groupedVisits;
    }
}
