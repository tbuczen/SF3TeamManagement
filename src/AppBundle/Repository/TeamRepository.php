<?php

namespace AppBundle\Repository;

class TeamRepository extends BaseRepository
{

    public function getOrderedByCountries(){
        $query = $this->createQueryBuilder('t')
            ->select('t')
            ->innerJoin('t.country', 'c')
            ->orderBy("c.name","ASC");

        return $query->getQuery()->getResult();
    }

}