<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AvantagePageController extends Controller
{
    private $avantages;

    public function __construct()
    {

    }
    /**
     * Lists all avantages entities.
     *
     * @Route("/", name="avantages_page")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avantages = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('attraction/index.html.twig', array(
            'avantages' => $avantages,
        ));
    }

    /**
     * @return mixed
     */
    public function getAvantages()
    {
        return $this->avantages;
    }

    /**
     * @param mixed $avantages
     */
    public function setAvantages($avantages)
    {
        $this->avantages = $avantages;
    }


}
