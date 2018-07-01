<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use AppBundle\Entity\Audience;
use AppBundle\Entity\Category;
use AppBundle\Entity\FilterQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MapPageController extends Controller
{
    private $position;

    # all fields of the Attraction entity we can use as criteria
    #

    # fields (of FiterRequest) being arrays of entities
    #       => related fields in the Attraction entity
    const MULTIPLE_CRITERIAS = [
        'audiences' => [
            'field' => 'audience',
            'alias' => 'aud'
        ],
        'categories' => [
            'field' => 'category',
            'alias' => 'cat'
        ]
    ];

    # simple fields with continuous values
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

        $highlightIdList = [];

        # create the filter form shown in the lateral panel
        #
        $filterQuery = new FilterQuery();
        $form = $this->createForm(
            'AppBundle\Form\FilterQueryType',
            $filterQuery,
            ['entityManager' => $em]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            # the criteria are handled to the AttractionRepository
            # to build the request
            $highlightIdList = $repo->findFromFilterQuery(
                $filterQuery,
                self::MULTIPLE_CRITERIAS,
                self::SINGLE_CRITERIAS
            );
        }

        if ($request->isMethod('post')
            && $request->isXmlHttpRequest()
        ) {
            return new JsonResponse([
                'highlightIdList' => $highlightIdList
            ]);
        }

        return $this->render('map/map.html.twig', [
            'attractionList' => $attractions,
            'highlightIdList' => $highlightIdList,
            'viewerPos' => $this->position,

            'filterQuery_form' => $form->createView()
        ]);
    }
}
