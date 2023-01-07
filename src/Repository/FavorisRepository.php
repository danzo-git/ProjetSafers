<?php

namespace App\Repository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Favoris;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;
/**
 * @extends ServiceEntityRepository<Favoris>
 *
 * @method Favoris|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favoris|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favoris[]    findAll()
 * @method Favoris[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavorisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favoris::class);
    }

    public function add(Favoris $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Favoris $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Favoris[] Returns an array of Favoris objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

public function findMostFrequentValue( $column="categorie")
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('value', 'value');
        $rsm->addScalarResult('count', 'count');

        $query = $this->_em->createNativeQuery(
            'SELECT '.$column.' as value, COUNT(*) as count FROM favoris GROUP BY '.$column.' ORDER BY count DESC LIMIT 1',
            $rsm
        );
        // dd($query->getResult());
        return $query->getOneOrNullResult();
    }





    public function findMostFrequentBien( $column="titre_safer")
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('value', 'value');
        $rsm->addScalarResult('count', 'count');

        $query = $this->_em->createNativeQuery(
            'SELECT '.$column.' as value, COUNT(*) as count FROM favoris GROUP BY '.$column.' ORDER BY count DESC LIMIT 1',
            $rsm
        );

        return $query->getOneOrNullResult();
    }

}



//    public function findOneBySomeField($value): ?Favoris
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }}
