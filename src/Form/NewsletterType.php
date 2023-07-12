<?php

namespace App\Form;

use App\Entity\Newsletter;
use App\Entity\Exhibition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use DateTime;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label_attr' => ['class' => 'hidden'],
                'attr' => array(
                    'class' => "block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 
                                rounded-lg border border-gray-300 sm:rounded-lg",
                    'placeholder' => 'Saisissez votre email',
                )
            ])

            ->add('exhibition', EntityType::class, [
                'class' => Exhibition::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('e')
                        ->setParameter('now', new DateTime())
                        ->andWhere('e.start <= :now and e.end >= :now');
                },
                'label' => 'Exposition choisie:',
                'label_attr' => ['class' => "inline-block mt-5 mr-6 text-center"],
                'choice_label' => 'name',
                     'multiple' => false,
                     'expanded' => false,
                     'attr' => [
                        'class' => 'rounded'
                    ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}
