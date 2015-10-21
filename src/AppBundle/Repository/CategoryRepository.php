<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getCategories()
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder();

        $qb->select('c, p')
           ->from('AppBundle:Category', 'c')
           ->leftJoin('c.products', 'p');

        return $qb
            ->getQuery()
            ->getResult();
    }
}