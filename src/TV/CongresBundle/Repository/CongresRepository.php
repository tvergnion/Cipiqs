<?php

namespace TV\CongresBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * CongresRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CongresRepository extends \Doctrine\ORM\EntityRepository
{
    public function listCongres($page, $nbPerPage){
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->where('a.state = :id')
            ->setParameter('id', 3)
            ->getQuery()
            ->setFirstResult(($page-1)*$nbPerPage)
            ->setMaxResults($nbPerPage)
        ;
        return new Paginator($qb, true);
    }
    
    public function getNewCongres() {
        $qb = $this
            ->createQueryBuilder('a')
            ->where('a.state = 2')
            ->setMaxResults(1)
            ->getQuery()
        ;
        return $qb->getOneOrNullResult();
    }
    
    public function listBrouillonCongres($page, $nbPerPage) {
        $qb = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->where('a.state = :id')
            ->setParameter('id', 1)
            ->getQuery()
            ->setFirstResult(($page-1)*$nbPerPage)
            ->setMaxResults($nbPerPage)
        ;
        return new Paginator($qb, true);
    }
}
