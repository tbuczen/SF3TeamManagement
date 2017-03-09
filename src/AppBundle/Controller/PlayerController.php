<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PlayerController extends BaseController
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
        $entity = $this->getDoctrine()->getRepository("AppBundle:Player")->find($id);

        $form = $this->createEditForm(PlayerType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Succesfuly updated user.');
            return $this->redirectToRoute("show_players");
        }
        return $this->render('@App/editPlayer.html.twig', [
            "player" => $entity,
            "form" => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function createPlayerAction(Request $request)
    {
        $entity = new Player();

        $form = $this->createEditForm(PlayerType::class, $entity, true);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Succesfuly created user.');
            return $this->redirectToRoute("show_players");
        }
        return $this->render('@App/editPlayer.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response|null
     */
    public function deletePlayerAction(Request $request, $id)
    {
        $deleted = $this->getDoctrine()->getRepository("AppBundle:Player")->delete($id);
        if(!$deleted) {
            $request->getSession()->getFlashBag()->add('error', 'Failed to delete.');
        } else {
            $request->getSession()->getFlashBag()->add('success', 'Succesfuly deleted.');
        }
        return $this->redirectToRoute("show_players");
    }

}
