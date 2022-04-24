<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Evenement $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Evenement $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Evenement p
                WHERE p.nomEvt LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

    public function findByCateegorie(){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Evenement p
                WHERE p.categorie = workshop'
            )
           
            ->getResult();
    }


    public function findByCategorie($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.categorie = :val')
            ->setParameter('val', $value)
            
            ->getQuery()
            ->getResult()
        ;
    }

        /**
     * Returns all events per page
     * @return void 
     */
    public function getPaginatedAnnonces($page, $limit){
        $query = $this->createQueryBuilder('a');
            

        $query->orderBy('a.dateEvt')
            ->setFirstResult(($page * $limit) - $limit)
            ->setMaxResults($limit)
        ;
        return $query->getQuery()->getResult();
    }

    public function findArray(){
        $prod = $this->getEntityManager()
        ->createQuery('
        SELECT e FROM App\Entity\Evenement e
        WHERE e.idEvt=1 ')
       ->getResult();

       $productArray = $prod->toArray();
        $json = json_encode($productArray);
        return $json;
  
    }
    

    // /**
    //  * @return Evenement[] Returns an array of Evenement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evenement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}
