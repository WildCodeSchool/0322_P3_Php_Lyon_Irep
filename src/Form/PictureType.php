<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
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
            'label' => 'reference'
        ])
        ->add('title', TextType::class, [
            'label' => 'titre'
        ])
        ->add('subtitle', TextType::class, [
            'label' => 'sous titre'
        ])
        ->add('date', TextType::class, [
            'label' => 'date'
        ])
        ->add('technic', TextType::class, [
            'label' => 'technique'
        ])
        ->add('size', TextType::class, [
            'label' => 'Dimension'
        ])
        ->add('category', TextType::class, [
            'label' => 'catégorie'
        ])
        ->add('number', TextType::class, [
            'label' => 'numéro'
        ])
        ->add('comment', TextType::class, [
            'label' => 'commentaire'
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
