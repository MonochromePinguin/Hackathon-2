<?php

namespace AppBundle\Form;

use AppBundle\Entity\Audience;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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

        $builder->add(
            'audiences',
            ChoiceType::class,
            [
                'label' => 'Audience : ',

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

            /*               'query_builder' => function () use ($audienceRepo) {
                    return $audienceRepo->createQueryBuilder('a')
                              ->orderBy('a.label', 'ASC');
                }*/
            ]
        )
        ->add(
            'categories',
            ChoiceType::class,
            [
                'label' => 'Catégorie : ',

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
        ->add('minUserSize', IntegerType::class)
        ->add('minRequiredAge', IntegerType::class)
        ->add('meanWaitTime', TimeType::class)
        ->add('meanDuration', TimeType::class)
        ->add('opertureTime', TimeType::class)
        ->add('closingTime', TimeType::class)
        ->add('priceAdult', IntegerType::class)
        ->add('priceChild', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FilterQuery'
        ));

        #This make the form need an 'entityManager' key in the parameters array;
        # it will be stored into the $options[] parameters of buildForm
        $resolver->setRequired('entityManager');
    }

    public function getBlockPrefix()
    {
        return 'appbundle_filterquery';
    }
}
