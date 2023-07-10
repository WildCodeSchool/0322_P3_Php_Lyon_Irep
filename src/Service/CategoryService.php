<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Picture;

class CategoryService
{
    private EntityManagerInterface $entitymanager;

    public function __construct(EntityManagerInterface $entitymanager)
    {
        $this->entitymanager = $entitymanager;
    }

    public function getCategories(): array
    {
        $query = $this->entitymanager->createQueryBuilder()
            ->select('p.category')
            ->from(Picture::class, 'p')
            ->groupBy('p.category');

        $results = $query->getQuery()->getArrayResult();

        $categories = [];
        foreach ($results as $result) {
            $categories[] = $result['category'];
        }

        return $categories;
    }
}
