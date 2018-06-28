<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvantagePageController extends Controller
{
    private $advantages;

    public function __construct()
    {

    }
    /**
     * Lists all advantages entities.
     *
     * @Route("/", name="advantages_page")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $advantages = $em->getRepository('AppBundle:Advantage')->findAll();

        return $this->render('attraction/index.html.twig', array(
            'advantages' => $advantages,
        ));
    }

    /**
     * @return mixed
     */
    public function getAdvantages()
    {
        return $this->advantages;
    }

    /**
     * @param mixed $advantages
     */
    public function setAdvantages($avantages)
    {
        $this->advantages = $avantages;
    }


}
