<?php

namespace App\Form;

use App\Entity\Exhibition;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ExhibitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'exposition: ',
                'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
            ])

            ->add('start', DateType::class, [
                'label' => 'Date de début: ',
                'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'widget' => 'single_text',
                'data' => new DateTime(),
            ])

            ->add('end', DateType::class, [
                'label' => 'Date de fin: ',
                'label_attr' => ['class' => 'block mt-2 font-contentfont font-medium'],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'widget' => 'single_text',
                'data' => new DateTime()
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exhibition::class,
        ]);
    }
}
