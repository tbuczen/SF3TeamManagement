<?php

namespace AppBundle\Repository;

class TeamRepository extends BaseRepository
{

    /**
     * @return array
     */
    public function getOrderedByCountries(){
        $query = $this->createQueryBuilder('t')
            ->select('t')
            ->innerJoin('t.country', 'c')
            ->orderBy("c.name","ASC");

        return $query->getQuery()->getResult();
    }

    /**
     * @param $countryId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByCountryQB($countryId){
        $query = $this->createQueryBuilder('t')
            ->select('t')
            ->innerJoin('t.country', 'c')
            ->where('c.id = :id')
            ->orderBy("c.name","ASC")
            ->setParameter('id',$countryId)
        ;
        return $query;
    }

    /**
     * @param int $countryId
     * @return array
     */
    public function findByCountry($countryId){
        $query = $this->findByCountryQB($countryId);
        $data = $query->getQuery()->getResult();
        return $data;
    }

}