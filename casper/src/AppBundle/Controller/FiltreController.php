<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FiltreController extends Controller
{
    /**
     * @Route("/filtre", name="page_filtre")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('filtre/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
