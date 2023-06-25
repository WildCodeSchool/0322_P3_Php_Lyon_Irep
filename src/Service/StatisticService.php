<?php

namespace App\Service;

use App\Entity\PageVisit;
use App\Entity\LinkClick;
use App\Repository\LinkClickRepository;
use App\Repository\PageVisitRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class StatisticService
{
    private EntityManagerInterface $entityManager;
    private PageVisitRepository $pageVisitRepository;
    private LinkClickRepository $linkClickRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        PageVisitRepository $pageVisitRepository,
        LinkClickRepository $linkClickRepository
    ) {
        $this->entityManager = $entityManager;
        $this->pageVisitRepository = $pageVisitRepository;
        $this->linkClickRepository = $linkClickRepository;
    }

    public function recordPageVisit(string $routeName): void
    {
        $pageVisit = new PageVisit();
        $pageVisit->setRouteName($routeName);
        $pageVisit->setVisitedAt(new DateTime());

        $this->entityManager->persist($pageVisit);
        $this->entityManager->flush();
    }

    public function recordLinkClick(string $url): void
    {
        $linkClick = new LinkClick();
        $linkClick->setUrl($url);
        $linkClick->setClickedAt(new DateTime());

        $this->entityManager->persist($linkClick);
        $this->entityManager->flush();
    }

    public function getPageVisitsCount(): int
    {
        return $this->pageVisitRepository->count([]);
    }

    public function getLinkClicksCount(): int
    {
        return $this->linkClickRepository->count([]);
    }
}
