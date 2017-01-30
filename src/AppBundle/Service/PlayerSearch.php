<?php

namespace AppBundle\Service;

use AppBundle\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayerSearch
{

    /** @var  EntityManagerInterface */
    private $em;

    /** @var  PlayerRepository */
    private $playerRepo;

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->playerRepo = $em->getRepository("AppBundle:Player");
    }

    /**
     * @param $query
     * @return array
     */
    public function search($query){

        $players = $this->playerRepo->searchByAnything($query);

        //country.name , team.name, p.name p.surname
        $data = [];
        return $data;
    }
}