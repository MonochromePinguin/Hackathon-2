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

    const ALLOWED_CRITERIAS = [
        'audience',
        'category',
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
        $selectors = [];

        # abort selection if any requested criteria is invalid
        if ($request->isMethod('post')) {
            $selectors = $request->request->all();

            foreach ($selectors as $key => $value) {
                if (!in_array($key, self::ALLOWED_CRITERIAS)) {
                    # no criteria asked when there is something wrong
                    $selectors = [];
                }
            }

            /*_ ajouter les labels, les styler via bootstrap
            _  les champs à valeur discrète (catégorie, public) sont à remplacer par des
            groupes de case à cocher + "tout cocher" / "tout décocher" !
            _ pr chaque critère :
                case à cocher (utilisé ou pas ?),
            sélecteur de logique ( ==, ≥, ≤, != , entre 2 valeurs )
            SAUF pour les critères  stockés en table dédiée :
             pour eux, cases à cocher !

            _ pour chaque champs triable numérique ou date:
                une case à cocher « inclure ou non le champs dans la sélection »
                un select «opération» : =, ≥, ≤, ≠, entre 2 valeurs ;
            _ pour les champs texte : de la recherche full texte dans les noms,
                        description ... → icône loupe et champs de recherche

            _ le JS pour jouer sur la coloration des icônes sélectionnées ou non

            _effets pour l'apparition et le changement d'état des sprite;
            _effets pour le changement de fond d''écran sur la page filtres
            */
            $em = $this->getDoctrine()->getManager();

            $repo = $em->getRepository(Attraction::class);
            $attractions = $repo->findAll();

            #filter these results to build the list of highlighted attractions
            #
            $criterias = new Criteria();
            $expr = $criterias->expr();

            foreach ($selectors as $key => $value) {
                $criterias->where($expr->eq($key, $value));
            }
            $selectedAttractions = $repo->matching($criterias);
            $highlightedId = [];

            if (0 != count($selectedAttractions)) {
                foreach ($selectedAttractions as $attraction) {
                    $highlightedId[] = $attraction->getId();
                }
            }
        }

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
            //TODO
        }

        return $this->render('map/map.html.twig', [
            'attractionList' => $attractions,
            'highlightedId' => $highlightedId,
            'viewerPos' => $this->position,
            'filterQuery' => $filterQuery,
            'filterQuery_form' => $form->createView()
        ]);
    }
}
