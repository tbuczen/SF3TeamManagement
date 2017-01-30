<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Country;
use AppBundle\Form\CountryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CountryController extends BaseController
{

    /**
     * @param Request $request
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function countriesAction(Request $request)
    {
        $countries = $this->getDoctrine()->getRepository("AppBundle:Country")->findAll();
        return $this->render('@App/countries.html.twig', [
            "countries" => $countries,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function editCountryAction(Request $request, $id)
    {
        $entity = $this->getDoctrine()->getRepository("AppBundle:Country")->find($id);

        $form = $this->createEditForm(CountryType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        return $this->render('@App/editCountry.html.twig', [
            "country" => $entity,
            "form" => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function createCountryAction(Request $request)
    {
        $entity = new Country();

        $form = $this->createEditForm(CountryType::class, $entity,true);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        return $this->render('@App/editCountry.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Security("has_role('ROLE_ADMIN')")
     * @return Response
     */
    public function deleteCountryAction(Request $request, $id)
    {
        $deleted = $this->getDoctrine()->getRepository("AppBundle:Country")->delete($id);
        if(!$deleted) {
            $request->getSession()->getFlashBag()->add('error', 'Failed to delete.');
        } else {
            $request->getSession()->getFlashBag()->add('success', 'Succesfuly deleted.');
        }
        return $this->redirectToRoute("manage_countries");
    }

}
