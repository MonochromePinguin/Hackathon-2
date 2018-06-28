<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapPageController extends Controller
{
    private $position;

    //the GPS coordinate of the center of the map – used to convert GPS
    // coordinates to map percentages ...
    private static $gpsCenterX;
    private static $gpsCenterY;

    private const RATIO_X = 1;
    private const RATIO_Y = 100000;


    # the $defaultPosition and $defaultGPScoordinates parameters are injected here
    public function __construct(array $defaultPosition, array $defaultGPScoordinates)
    {
        $this->position = $defaultPosition;
        self::$gpsCenterX = $defaultGPScoordinates[0];
        self::$gpsCenterY = $defaultGPScoordinates[1];
    }

    /**
     * @Route("/map", name="map_page")
     * @Method({"GET"})
     */
//TODO: factoriser la vue twig (un include) à montrer en diverses pages !
    public function mapPageAction()
    {
        $repo = $this->getDoctrine()
                     ->getManager()
                     ->getRepository(Attraction::class);
        $attractions = $repo->findAll();

        $attractionPositions = [];

        foreach ($attractions as $attraction) {
            # the calculated position is in percent of the parent div
            $attractionPositions[] = [
                'x' => 50 + ((
                        $attraction->getLongitude() - self::$gpsCenterX
                ) * self::RATIO_X),
                'y' => 50 + ((
                    $attraction->getLatitude() - self::$gpsCenterY
                ) * self::RATIO_Y)
            ];
        }

        return $this->render('map/map.html.twig', [
            'attractionList' => $attractions,
            'attractionPositions' => $attractionPositions,
            'viewerPos' => $this->position
        ]);
    }
}
