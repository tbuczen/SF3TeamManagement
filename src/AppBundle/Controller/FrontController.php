<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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

    //COUNTRIES
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

    //SEARCH ACTION
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchAction(Request $request)
    {
        $query = $request->get("query");
        $data = $this->get("app.player.search")->search($query);
        return new JsonResponse(["data" => reset($data), "error" => null]);
    }
}
