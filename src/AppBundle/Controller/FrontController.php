<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

//TODO:: This should be splitted into more controllers but haven't got time for refactor
class FrontController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     */
    public function homepageAction(Request $request)
    {
        return $this->render('@App/homepage.html.twig', []);
    }

    //TEAMS
    /**
     * @param Request $request
     * @return Response
     */
    public function teamsAction(Request $request)
    {
        $teams = $this->getDoctrine()->getRepository("AppBundle:Team")->getOrderedByCountries();
        return $this->render('@App/teams.html.twig', [
            "teams" => $teams,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function displayTeamAction(Request $request, $id)
    {
        $team = $this->getDoctrine()->getRepository("AppBundle:Team")->find($id);
        $players = $this->getDoctrine()->getRepository("AppBundle:Player")->getByTeamId($id);
        return $this->render('@App/team.html.twig', [
            "team" => $team,
            "teamPlayers" => $players,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function editTeamAction(Request $request, $id)
    {
        $form = null;
        $team = $this->getDoctrine()->getRepository("AppBundle:Team")->find($id);
        return $this->render('@App/editTeam.html.twig', [
            "team" => $team,
            "form" => $form,
        ]);
    }

    /**
     * @param Request $request
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function createTeamAction(Request $request)
    {
        $form = null;
        return $this->render('@App/editTeam.html.twig', [
            "form" => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function deleteTeamAction(Request $request, $id)
    {
        return $this->render('@App/editTeam.html.twig', []);
    }

    //PLAYERS
    /**
     * @param Request $request
     * @return Response
     */
    public function playersAction(Request $request)
    {
        $players = $this->getDoctrine()->getRepository("AppBundle:Player")->getOrderedByCountriesAndTeams();
        return $this->render('@App/players.html.twig', [
            "players" => $players,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function displayPlayerAction(Request $request, $id)
    {
        $player = $this->getDoctrine()->getRepository("AppBundle:Player")->find($id);
        return $this->render('@App/player.html.twig', [
            "player" => $player,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function editPlayerAction(Request $request, $id)
    {
        $form = null;
        $player = $this->getDoctrine()->getRepository("AppBundle:Player")->find($id);
        return $this->render('@App/editPlayer.html.twig', [
            "player" => $player,
            "form" => $form,
        ]);
    }

    /**
     * @param Request $request
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function createPlayerAction(Request $request)
    {
        $form = null;
        return $this->render('@App/editPlayer.html.twig', [
            "form" => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function deletePlayerAction(Request $request, $id)
    {
        return $this->render('@App/editPlayer.html.twig', [
        ]);
    }

    //SEARCH ACTION
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchAction(Request $request)
    {
        $query = $request->get("query");
        $data = $this->get("app.player.search")->search($query);
        return new JsonResponse($data);
    }
}
