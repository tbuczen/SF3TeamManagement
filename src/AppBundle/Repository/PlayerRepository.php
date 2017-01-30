<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Player;
use Doctrine\ORM\EntityRepository;

class PlayerRepository extends EntityRepository
{

    /**
     * @return Player[]
     */
    public function getOrderedByCountriesAndTeams(){
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->innerJoin('p.team', 't')
            ->innerJoin('t.country', 'c')
            ->orderBy("c.name","ASC")
            ->addOrderBy("t.name","ASC")
            ->addOrderBy("p.position","ASC");

        return $query->getQuery()->getResult();
    }

    /**
     * @param int $id
     * @return Player[]
     */
    public function getByTeamId($id){
        $query = $this->createQueryBuilder('p')
            ->select('p')
            ->innerJoin('p.team', 't')
            ->where('t.id = :teamId')
            ->setParameter('teamId',$id)
            ->orderBy("p.position","ASC");

        return $query->getQuery()->getResult();
    }

    /**
     * @param string[] $queryParts
     * @return array
     */
    public function searchByAnything($queryParts)
    {
        $fullResults = [];
        foreach ($queryParts as $needle) {
            $query = $this->createQueryBuilder('p')
                ->select('p,t,c')
                ->innerJoin('p.team', 't')
                ->innerJoin('t.country', 'c')
                ->where("p.slug LIKE :needle ")
                ->orWhere("c.name LIKE :needle")
                ->orWhere("t.name LIKE :needle")
                ->setParameter('needle', '%' . $needle . '%')
                ->orderBy("p.name", "ASC");

            $fullResults[] = $query->getQuery()->getArrayResult();
        }

        return $fullResults;
    }

}