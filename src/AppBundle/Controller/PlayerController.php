<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PlayerController extends Controller
{

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

}
