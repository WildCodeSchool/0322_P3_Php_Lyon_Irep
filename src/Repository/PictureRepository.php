<?php

namespace App\Repository;

use App\Entity\Exhibition;
use App\Entity\Picture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
* @extends ServiceEntityRepository<Picture>
*
* @method Picture|null find($id, $lockMode = null, $lockVersion = null)
* @method Picture|null findOneBy(array $criteria, array $orderBy = null)
* @method Picture[]    findAll()
* @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
*/
class PictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Picture::class);
    }


    public function save(Picture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);


        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function remove(Picture $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);


        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function getCategories(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT DISTINCT p.category
           FROM App\Entity\Picture p'
        );

        $results = $query->getResult();

        $categories = array_map(fn($result) => $result['category'], $results);

        return $categories;
    }

    public function getCategoriesForExhibition(?Exhibition $exhibition = null): array
    {
        $qb = $this->createQueryBuilder('p')
                ->select('p.category');

        if ($exhibition) {
            $qb->where('p.exhibition = :exhibition')
               ->setParameter('exhibition', $exhibition);
        }

        $result = $qb->distinct()
                 ->getQuery()
                 ->getResult();

        return array_column($result, 'category');
    }



//    /**
//     * @return Picture[] Returns an array of Picture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }


//    public function findOneBySomeField($value): ?Picture
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
