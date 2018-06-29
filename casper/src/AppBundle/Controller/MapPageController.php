<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attraction;
use Doctrine\Common\Collections\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapPageController extends Controller
{
    private $position;

    const ALLOWED_CRITERIAS = [
        'minUserSize',
        'minRequiredAge',
        'meanWaitTime',
        'meanDuration',
        'opertureTime',
        'closingTime'];

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
    public function mapPageAction(Request $request)
    {
        $requestedCriterias = [];

        if ($request->isMethod('post')) {
            $requestedCriterias = $request->request->all();

            foreach ($requestedCriterias as $key => $value) {
                if (!isset(self::ALLOWED_CRITERIAS[$key])) {
                    # no criteria asked when there is something wrong
                    $requestedCriterias = [];
                }
            }
        }

  /*      _ ajouter le passage de params à l'activation par Js DU LIEN :'
    des input hidden dans un formulaire hidden ...

        _ puis y réagir ici ...

        _ pour chaque champs triable numérique ou date:
            une case à cocher « inclure ou non le champs dans la sélection »
            un select «opération» : =, ≥, ≤, ≠, entre 2 valeurs ;
        _ pour les champs texte : de la recherche full texte dans les noms,
            description ... → icône loupe et champs de recherche

        _ le JS pour jouer sur la coloration !

        _effets pour l'apparition '
*/

        $repo = $this->getDoctrine()
                     ->getManager()
                     ->getRepository(Attraction::class);

        $attractions = $repo->findAll();

        #filter these results to build the list of highlighted attractions
        #
        $criterias = new Criteria();
        $expr = $criterias->expr();

        foreach ($requestedCriterias as $key => $value) {
            $criterias->where($expr->eq($key, $value));
        }
        $highlights = $repo->matching($criterias);


        return $this->render('map/map.html.twig', [
            'attractionList' => $attractions,
        #    'highlightedId' => $highlights,
            'viewerPos' => $this->position
        ]);
    }
}
