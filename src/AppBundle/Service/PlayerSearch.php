<?php

namespace AppBundle\Service;

use AppBundle\Entity\Player;
use AppBundle\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util as Sluggable;

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
     * @param string $query
     * @return array
     */
    public function search($query){
        $stringParts = explode(" ",$query);
        foreach ($stringParts as &$rawPart){
            $rawPart = Sluggable\Urlizer::urlize($rawPart, '');
        }
        $fullResults = $this->playerRepo->searchByAnything($stringParts);

        $fullResultsCount = count($fullResults);
        if(count($fullResults) > 1) {
            $players = $this->filterPlayers($fullResults, $fullResultsCount);
        }else{
            $players = $fullResults;
        }

        return $players;
    }

    /**
     * @param $fullResults
     * @param $fullResultsCount
     * @return array
     */
    protected function filterPlayers($fullResults, $fullResultsCount)
    {
        $filteredResults = $results = $players = [];

        foreach ($fullResults as $key => $partPlayers) {
            /** @var Player $player */
            foreach ($partPlayers as $player) {
                $id = $player["id"];
                $players[$id] = $player;
                //count results - we want to have our result narrowed to each string part
                if (array_key_exists($id, $filteredResults)) {
                    $filteredResults[$id] = $filteredResults[$id] + 1;
                } else {
                    $filteredResults[$id] = 1;
                }
            }
        }
        //get players that appeared in all parts of search
        $filteredResults = array_filter($filteredResults, function ($v, $k) use ($fullResultsCount) {
            return $v == $fullResultsCount;
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($filteredResults as $playerId => $result) {
            $results[] = $players[$playerId];
        }
        $players = $results;
        return [$players];
    }
}