<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{

    public function getOrderedByCountries(){
        $query = $this->createQueryBuilder('t')
            ->select('t')
            ->innerJoin('t.country', 'c')
            ->orderBy("c.name","ASC");

        return $query->getQuery()->getResult();
    }

}