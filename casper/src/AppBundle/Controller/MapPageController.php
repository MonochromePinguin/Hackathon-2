<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use AppBundle\Entity\FilterQuery;
use Doctrine\Common\Collections\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapPageController extends Controller
{
    private $position;

    # all fields of the Attraction entity we can use as criteria
    const MULTIPLE_CRITERIAS = [
        'audience',
        'category'
    ];

    const SINGLE_CRITERIAS = [
        'minUserSize',
        'minRequiredAge',
        'meanWaitTime',
        'meanDuration',
        'opertureTime',
        'closingTime'
    ];

    # the $defaultPosition parameter is injected here
    public function __construct(array $defaultPosition)
    {
        $this->position = $defaultPosition;
    }

    /**
     * @Route("/map", name="map_page")
     * @Method({"GET", "POST"})
     *
     * the POST data must validate against FilterType
     */
//TODO: factoriser la vue twig (un include) à montrer en diverses pages !
    public function mapPageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Attraction::class);
        $attractions = $repo->findAll();

        $highlightedId = [];

        # create the filter form shown in the lateral panel
        #
        $query = new FilterQuery();
        $form = $this->createForm(
            'AppBundle\Form\FilterQueryType',
            $query,
            ['entityManager' => $em]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            #use these results to build the list of highlighted attractions
            #
            $criterias = Criteria::create();
            $expr = Criteria::expr();

            foreach (self::MULTIPLE_CRITERIAS as $key ) {
                if (isset($query->$key)) {
                    $criterias->orWhere(
                        $expr->eq($key, $query->$key)
                    );
                }
            }

            foreach (self::SINGLE_CRITERIAS as $key) {
                if (isset($query->$key)) {
                    $criterias->andWhere($expr->eq($key, $query->$key));
                }
            }

            $selectedAttractions = $repo->matching($criterias);

            if (0 != count($selectedAttractions)) {
                foreach ($selectedAttractions as $attraction) {
                    $highlightedId[] = $attraction->getId();
                }
            }
        }

        return $this->render('map/map.html.twig', [
            'attractionList' => $attractions,
            'highlightList' => $highlightedId,
            'viewerPos' => $this->position,

            'filterQuery' => $query,
            'filterQuery_form' => $form->createView()
        ]);
    }
}
