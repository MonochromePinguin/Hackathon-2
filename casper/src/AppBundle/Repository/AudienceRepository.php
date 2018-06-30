<?php

namespace AppBundle\Repository;

class AudienceRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllNames(): array
    {
        $qb = $this->createQueryBuilder('a')
                     ->select('a.name')
                     ->getQuery();

         return $qb->getResult();
    }
}
