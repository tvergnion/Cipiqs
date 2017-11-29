<?php

namespace TV\UserBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function getUsers($page, $nbPerPage)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.roles LIKE :role')
            ->setParameter('role', '%"ROLE_USER"%')
            ->andWhere('a.roles NOT LIKE :roleb')
            ->setParameter('roleb', '%"ROLE_SUPER_ADMIN"%')
            ->andWhere('a.enabled = true')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
        ;
        $query
            ->setFirstResult(($page-1)*$nbPerPage)
            ->setMaxResults($nbPerPage)
        ;
        return new Paginator($query, true);
    }
    
    public function getUsersCount()
    {
        return $this->createQueryBuilder('a')
            ->where('a.roles LIKE :role')
            ->setParameter('role', '%"ROLE_USER"%')
            ->select('COUNT(a)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    
    public function getActivedUsers($page, $nbPerPage) 
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.enabled = true')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
        ;
        $query
            ->setFirstResult(($page-1)*$nbPerPage)
            ->setMaxResults($nbPerPage)
        ;
        return new Paginator($query, true);
    }
}