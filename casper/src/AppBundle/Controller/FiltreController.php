<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Audience;
use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FiltreController extends Controller
{
    //TODO: get this from DB
    const ALLOWED_STATES = [ 'audienceChoosing', 'categoryChoosing' ];

    //TODO: questions too should be filled from DB
    const STATE_LIST = [
        'audienceChoosing' => [
            'question' => 'Qui êtes vous ... ?',
            'relatedEntity' => Audience::class,
            'nextState' => 'categoryChoosing'
            ],
        'categoryChoosing' => [
            'question' => 'Et que cherchez-vous ... ?',
            'relatedEntity' => Category::class,
            'nextState' => 'GO'
        ]
    ];

    //TODO: these should be filled from DB
    const AUDIENCE_BACKGROUNDS = [
        'unchoosen' => '/images/fond6.jpeg',
        'strong' => '/images/strong.jpg',
        'friends' => '/images/fond-3.jpg',
        'family' => '/images/joker.jpg',
        'children' => '/images/fond6.jpeg'
    ];


    /**
     * @Route("/filtre", name="page_filtre")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $state = 'audienceChoosing';
        $audience = 'unchoosen';

        #TODO: to be clean, this should be an URI apart

        #if we receive a marker in the POST request, it's ajax !
        #
        if ($request->isMethod('post')
            && ('1' == $request->request->get('ajaxFlag'))
        ) {
            $askedState = $request->request->get('currentState');
            $choosen = $request->request->get('choosen');

            if (isset($askedState)
                && in_array($askedState, self::ALLOWED_STATES)
            ) {
                $state = $askedState;
            } else {
                $response = new Response();
                $response->sendHeaders('http/1.0 400 Lack of required parameters');
                return $response;
            }

            $entity = self::STATE_LIST[$state]['relatedEntity'];
            $repo = $this->getDoctrine()->getRepository($entity);

            # test the field "choosen" is valid
            if (null == $repo->findByName($choosen)) {
                $response = new Response();
                $response->sendHeaders('http/1.0 400 invalid parameters');
                return $response;
            }

            switch ($state) {
                case 'audienceChoosing':
                    $state = self::STATE_LIST[$state]['nextState'];
                    $audience = $choosen;

                    $entity = self::STATE_LIST[$state]['relatedEntity'];
                    $repo = $this->getDoctrine()->getRepository($entity);

                    $newContent = $this->renderView(
                        'filtre/choiceList.html.twig',
                        [
                            'question' => self::STATE_LIST[$state]['question'],
                            'choices' => $repo->findAll()
                        ]
                    );

                    return new JsonResponse([
                        'newState' => $state,
                        'audience' => $audience,
                        'newBackground' => self::AUDIENCE_BACKGROUNDS[$audience],
                        'newContent' => $newContent
                    ]);

                case 'categoryChoosing':
                    $category = $choosen;
                    return new JsonResponse([
                         'newState' => 'GO',
                         'category' => $choosen
                     ]);
            }
        }

        # this is not a POST request – we still must show a choice list
        #
        $entity = self::STATE_LIST[$state]['relatedEntity'];
        $repo = $this->getDoctrine()->getRepository($entity);

        return $this->render(
            'filtre/index.html.twig',
            [
                'question' => self::STATE_LIST[$state]['question'],
                'choices' => $repo->findAll(),
                'currentState' => $state,
                'background' => self::AUDIENCE_BACKGROUNDS[$audience]
            ]
        );
    }
}
