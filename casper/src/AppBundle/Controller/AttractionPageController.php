<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AttractionPageController extends Controller
{
    private $attractions;

    public function __construct()
    {

    }
    /**
     * Lists all attractions entities.
     *
     * @Route("/attraction", name="attraction_page")
     * @Method("GET")
     */
    public function indexAction()
{
    $em = $this->getDoctrine()->getManager();

    $attractions = $em->getRepository('AppBundle:Attraction')->findAll();

    return $this->render('attraction/index.html.twig', array(
        'attractions' => $attractions,
    ));
}

    /**
     * @return mixed
     */
    public function getAttractions()
    {
        return $this->attractions;
    }

    /**
     * @param mixed $attractions
     */
    public function setAttractions($attractions)
    {
        $this->attractions = $attractions;
    }

}
