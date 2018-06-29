<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LastPageController extends Controller
{
    private $position;

    # the $defaultPosition parameter is injected here
    public function __construct()
    {

    }

    /**
     * @Route("/last", name="lastPage_page")
     * @Method({"GET"})
     */
//TODO: factoriser la vue twig (un include) à montrer en diverses pages !
    public function LastPageAction()
    {
       return $this->render('last/lastPage.html.twig', [

        ]);
    }
}
