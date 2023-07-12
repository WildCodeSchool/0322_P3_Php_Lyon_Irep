<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Picture;
use App\Entity\Exhibition;

class CategoryService
{
    private EntityManagerInterface $entitymanager;

    public function __construct(EntityManagerInterface $entitymanager)
    {
        $this->entitymanager = $entitymanager;
    }

    public function getCategories(?int $exhibitionId): array
    {
        $query = $this->entitymanager->createQueryBuilder()
            ->select('p.category')
            ->from(Picture::class, 'p')
            ->where('p.exhibition = :exhibitionId')
            ->groupBy('p.category')
            ->setParameter('exhibitionId', $exhibitionId);

        $results = $query->getQuery()->getArrayResult();

        $categories = [];
        foreach ($results as $result) {
            $categories[] = $result['category'];
        }

        return $categories;
    }
}
