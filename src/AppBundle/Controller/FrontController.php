<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function homepageAction(Request $request)
    {
        return $this->render('@App/homepage.html.twig', []);
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
