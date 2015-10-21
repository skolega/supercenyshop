<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class CommentRepository extends EntityRepository
{
    public function getCommentsQuery(User $user)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('c, p')
            ->from('AppBundle:Comment', 'c')
            ->leftJoin('c.product', 'p')
            ->where('c.user = :user')
            ->setParameter('user', $user)
            ->orderBy('c.createdAt', 'DESC');

        return $qb->getQuery();
    }
}