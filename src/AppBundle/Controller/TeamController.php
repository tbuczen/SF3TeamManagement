<?php

namespace AppBundle\Controller;

use AppBundle\Form\TeamType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends BaseController
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
        $team = $this->getDoctrine()->getRepository("AppBundle:Team")->find($id);
        $form = $this->createEditForm(TeamType::class, $team);
        return $this->render('@App/editTeam.html.twig', [
            "team" => $team,
            "form" => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function createTeamAction(Request $request)
    {
        $form = $this->createEditForm(TeamType::class,null,true);
        return $this->render('@App/editTeam.html.twig', [
            "form" => $form->createView(),
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
        $deleted = $this->getDoctrine()->getRepository("AppBundle:Team")->delete($id);
        if(!$deleted) {
            $request->getSession()->getFlashBag()->add('error', 'Failed to delete.');
        } else {
            $request->getSession()->getFlashBag()->add('success', 'Succesfuly deleted.');
        }
        return $this->redirectToRoute("show_teams");
    }

}
