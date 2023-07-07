<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('reference', TextType::class, [
            'label' => 'reference',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('title', TextType::class, [
            'label' => 'titre',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('subtitle', TextType::class, [
            'label' => 'sous titre',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('date', DateType::class, [
            'label' => 'date',
            'format' => 'yyyy-MM-dd',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'widget' => 'single_text',
        ])
        ->add('technic', TextType::class, [
            'label' => 'technique',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('size', TextType::class, [
            'label' => 'Dimension',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('category', ChoiceType::class, [
            'label' => 'catégorie',
            'choices' => [
                'Usines' => 'Usines',
                'Travailleurs' => 'Travailleurs',
                'Lieux' => 'Lieux',
                'Animaux' => 'Animaux',

            ],
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('number', IntegerType::class, [
            'label' => 'numéro',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('comment', TextType::class, [
            'label' => 'commentaire',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('exhibition', null, ['choice_label' => 'name',
        'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('photoFile', FileType::class, [
            'label' => 'Image',
            'mapped' => false,
            'required' => false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
