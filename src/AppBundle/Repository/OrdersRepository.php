<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class OrdersRepository extends EntityRepository
{
    public function getOrdersQuery(User $user)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('o')
            ->from('AppBundle:Orders', 'o')
            ->where('o.createdBy=:user')
            ->setParameter('user', $user)
            ->orderBy('o.createdAt', 'DESC');

        return $qb->getQuery();
    }
}