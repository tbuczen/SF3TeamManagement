<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{

    public function homepageAction(Request $request)
    {
        return $this->render('@App/homepage.html.twig', [
        ]);
    }

    //TEAMS
    public function teamsAction(Request $request)
    {
        $teams = $this->getDoctrine()->getRepository("AppBundle:Team")->getOrderedByCountries();
        return $this->render('@App/teams.html.twig', [
            "teams" => $teams
        ]);
    }

    public function displayTeamAction(Request $request)
    {
        $teams = $this->getDoctrine()->getRepository("AppBundle:Team")->getOrderedByCountries();
        return $this->render('@App/teams.html.twig', [
            "teams" => $teams
        ]);
    }

    //PLAYERS
    public function playersAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('@App/players.html.twig', [
        ]);
    }

    public function displayPlayerAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('@App/players.html.twig', [
        ]);
    }

    //SEARCH ACTION
    public function searchAction(Request $request)
    {
        $data = [];
        return new JsonResponse($data);
    }
}
