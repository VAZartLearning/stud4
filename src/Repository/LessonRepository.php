<?php

namespace App\Repository;

use App\Entity\User;

/**
 * LessonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LessonRepository extends \Doctrine\ORM\EntityRepository
{

    public function findLessonFor(User $user)
    {
        return $this->createQueryBuilder('l')
            ->innerJoin('l.groups', 'g')
            ->andWhere('g.id = :group')
            ->setParameter('group', $user->getGroup())
            ->andWhere('l.date=CURRENT_DATE()')
            ->andWhere('l.startTime<=CURRENT_TIME()')
            ->andWhere('l.endTime>=CURRENT_TIME()')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}