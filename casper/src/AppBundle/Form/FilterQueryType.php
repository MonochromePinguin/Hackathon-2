<?php

namespace AppBundle\Form;

use AppBundle\Entity\Audience;
use AppBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterQueryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em  = $options['entityManager'];

        $audienceRepo = $em->getRepository(Audience::class);
        $audienceList = $audienceRepo->findAll();

        $categoryRepo = $em->getRepository(Category::class);
        $categoryList = $categoryRepo->findAll();

        $intInputAttr = [ 'min' => '0' ];

        $builder->add(
            'audiences',
            ChoiceType::class,
            [
                'label' => 'Audience : ',

                #make them checkboxes
                'expanded' => true,
                'multiple' => true,

                'choices' => $audienceList,

                'choice_label' => function (Audience $audience, $key, $value) {
                    return $audience->getLabel();
                },
                'choice_value' => function (Audience $audience = null) {
                    return $audience ? $audience->getName() : '';
                },
            ]
        )
        ->add(
            'categories',
            ChoiceType::class,
            [
                'label' => 'Catégorie : ',

                'expanded' => true,
                'multiple' => true,

                'choices' => $categoryList,

                'choice_label' => function (Category $category, $key, $value) {
                    return $category->getLabel();
                },
                'choice_value' => function (Category $category = null) {
                    return $category ? $category->getName() : '';
                }
            ]
        )
        ->add(
            'minUserSize',
            IntegerType::class,
            [
                'label' => 'accessible à partir de telle taille (en m) : ',
                'attr' => $intInputAttr
            ]
        )
        ->add(
            'minRequiredAge',
            IntegerType::class,
            [
                'label' => 'Âge : à partir de : ',
                'attr' => $intInputAttr
            ]
        )
        ->add(
            'meanWaitTime',
            TimeType::class,
            [
                'label' => 'Temps d\'attente maximal souhaitée : ',
            ]
        )
        ->add(
            'meanDuration',
            TimeType::class,
            [
                'label' => 'Durée maximale de la visite souhaitée : ',
            ]
        )
        ->add($builder->create(
            'horaires',
            FormType::class,
            [
                    'inherit_data' => true,
                    'label' => 'Horaires désirés : '
                    ]
        )
            ->add(
                'opertureTime',
                TimeType::class,
                ['label' => 'À partir de : ']
            )
            ->add(
                'closingTime',
                TimeType::class,
                ['label' => 'Jusqu\'à : ']
            )) # add( $builder->create(...), ... )
        ->add(
            'priceAdult',
            MoneyType::class,
            [
                'label' => 'Prix adulte maximal (à partir de 3 ans ¼) : ',
                'currency' => 'EUR'
            ]
        )
        ->add(
            'priceChild',
            MoneyType::class,
            [
                'label' => 'Prix enfant maximal (jusqu\'à 2 mois avant terme) : ',
                'currency' => 'EUR'
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FilterQuery',
            'csrf_protection' => false
        ));

        #This make the form need an 'entityManager' key in the parameters array;
        # it will be stored into the $options[] parameters of buildForm
        $resolver->setRequired('entityManager');
    }

    public function getBlockPrefix()
    {
        return 'filterquery';
    }
}
