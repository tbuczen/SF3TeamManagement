<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller
{
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

}
