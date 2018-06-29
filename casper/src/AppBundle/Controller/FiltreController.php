<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FiltreController extends Controller
{
    //TODO: get this from DB
    private const CATEGORY_CHOOSING = [
        [
            'label' => 'Sensations fortes',
            'description' => 'pour amateurs de sensations fortes !',
            'returnValue' => 'strong'
        ],
        [
            'label' => 'Groupe d\'amis',
            'description' => 'pour s\'amuser à se faire peur',
            'returnValue' => 'friends'
        ],
        [
            'label' => 'Famille',
            'description' => 'les attractions pour tout les âges !',
            'returnValue' => 'family'
        ],
        [
            'label' => 'Enfants',
            'description' => 'Pour les tout-petits',
            'returnValue' => 'children'
        ]
    ];

    //TODO: get this from DB
    private const SENSATION_CHOOSING = [
        [
            'label' => 'Épouvante',
            'description' => 'pour amateurs de sensations fortes !',
            'returnValue' => 'terror'
        ],
        [
            'label' => 'Effrayant',
            'description' => 'pour s\'amuser à se faire peur',
            'returnValue' => 'frightening'
        ],
        [
            'label' => 'On s\'amuse',
            'description' => 'Se faire peur c\'est bien mais pas trop',
            'returnValue' => 'funny'
        ]
    ];

    //TODO: get this from DB
    const ALLOWED_STATES = [ 'categoryChoosing', 'sensationChoosing' ];
    const ALLOWED_CATEGORIES = [
        'unchoosen', 'strong', 'friends', 'family', 'children'
    ];
    const ALLOWED_SENSATIONS = [ 'terror', 'frightening', 'funny'];

    //TODO: these should be filled from DB
    private static $stateList = [];

    const CATEGORY_BACKGROUNDS = [
        'unchoosen' => '/images/fond.jpg',
        'strong' => '/images/strong.jpg',
        'friends' => '/images/friends.jpg',
        'family' => '/images/joker.jpg',
        'children' => '/images/fond6.jpeg'
    ];

    public function __construct()
    {
        self::$stateList['categoryChoosing'] = [
            'question' => 'What is your Quest ... ?',
            'choosing' => 'category',
            'choiceList' => self::CATEGORY_CHOOSING,
            'nextState' => 'sensationChoosing'
        ];

        self::$stateList['sensationChoosing'] = [
            'question' => 'And what Kind of thrill are you looking for ... ?',
            'choosing' => 'sensation',
            'choiceList' => self::SENSATION_CHOOSING,
            'nextState' => 'GO'
        ];
    }


    /**
     * @Route("/filtre", name="filtre")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $state = 'categoryChoosing';
        $category = 'unchoosen';

        #if we receive a marker in the POST request, it's ajax !
        if ($request->isMethod('post')
            && ('1' == $request->request->get('ajaxFlag'))
        ) {
            $currentState = $request->request->get('currentState');
            $choosen = $request->request->get('choosen');

            if (isset($currentState) && in_array($currentState, self::ALLOWED_STATES)) {
                $state = $currentState;
            } else {
                header('http/1.0 400 Lack of required parameters');
                return false;
            }

            #TODO: add error checking for $sensation, $categories, ...
            switch ($state) {
                case 'categoryChoosing':
                    $category = $choosen;
                    $state = self::$stateList[$state]['nextState'];

                    $newContent = $this->renderView(
                        'filtre/choiceList.html.twig',
                        [
                            'question' => self::$stateList[$state]['question'],
                            'choices' => self::$stateList[$state]['choiceList']
                        ]
                    );

                    return new JsonResponse([
                        'newState' => $state,
                        'category' => $category,
                        'newBackground' => self::CATEGORY_BACKGROUNDS[$category],
                        'newContent' => $newContent
                    ]);

                case 'sensationChoosing':
                    $sensation = $choosen;
                    $category = $request->request->get('category');
                    $state = self::$stateList[$state]['nextState'];

                    return new JsonResponse([
                       'newState' => 'GO',
                       'category' => $category,
                       'sensation' => $sensation
                    ]);
            }
        }



        return $this->render(
            'filtre/index.html.twig',
            [
                'question' => self::$stateList[$state]['question'],
                'choices' => self::$stateList[$state]['choiceList'],
                'currentState' => $state,
                'background' => self::CATEGORY_BACKGROUNDS[$category]
            ]
        );
    }
}
