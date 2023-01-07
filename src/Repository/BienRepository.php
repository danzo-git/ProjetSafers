<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bien>
 *
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    public function add(Bien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Bien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function countAllBien(){
        $queryBuilder=$this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id) as value');
        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

//    /**
//     * @return Bien[] Returns an array of Bien objects
//     */
   public function find5Biens(): array
    {
        $result=$this->createQueryBuilder('b')
        // ->andWhere('b.exampleField = :val')
        ->select('b.surface,b.titre,b.image,b.id,b.prix')
        
         // ->setParameter('val', $value)
        // ->addSelect('RAND() as HIDDEN rand')
         //->from('Bien','b')
         // ->orderBy( 'rand')
         ->setMaxResults(5)
         ->getQuery()
         ->getResult();
         shuffle($result);
         return $result;
    }

    public function find2Biens(): array
    {
        return $this->createQueryBuilder('b')
           // ->andWhere('b.exampleField = :val')
           ->select('b.surface,b.titre,b.image,b.id')
           
            // ->setParameter('val', $value)
           
            //->from('Bien','b')
            // ->orderBy('b.id', 'rand()')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

   

    // public function findBiens(): array
    // {
    //     return $this->createQueryBuilder('b')
    //        // ->andWhere('b.exampleField = :val')
    //        ->select('b.surface,b.titre,b.image,b.id ')
    //         // ->setParameter('val', $value)
    //         // ->orderBy('b.id', 'ASC')
    //         ->setMaxResults(5)
    //         ->getQuery()
    //         ->getResult();
    // }

//    public function findOneBySomeField($value): ?Bien
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



}
