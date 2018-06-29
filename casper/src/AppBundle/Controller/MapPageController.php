<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapPageController extends Controller
{
    private $position;

    # the $defaultPosition parameter is injected here
    public function __construct(array $defaultPosition)
    {
        $this->position = $defaultPosition;
    }

    /**
     * @Route("/map", name="map_page")
     * @Method({"GET", "POST"})
     */
//TODO: factoriser la vue twig (un include) à montrer en diverses pages !
    public function mapPageAction()
    {
        #if we receive a marker in the POST request, it's ajax !
        if ($request->isMethod('post')
            && ('1' == $request->request->get('ajaxFlag'))
        ) {
            //todo
        }



        $repo = $this->getDoctrine()
                     ->getManager()
                     ->getRepository(Attraction::class);
        $attractions = $repo->findAll();

        return $this->render('map/map.html.twig', [
            'attractionList' => $attractions,
            'viewerPos' => $this->position
        ]);
    }
}
