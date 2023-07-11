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
use App\Service\CategoryService;

class PictureType extends AbstractType
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $categories = $this->categoryService->getCategories();
        $builder
        ->add('reference', TextType::class, [
            'label' => 'Réference',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'required' => false,
        ])
        ->add('title', TextType::class, [
            'label' => 'Titre',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
        ])
        ->add('subtitle', TextType::class, [
            'label' => 'Sous-titre',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'required' => false,
        ])
        ->add('date', DateType::class, [
            'label' => 'Date',
            'format' => 'yyyy-MM-dd',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'widget' => 'single_text',
                'required' => false,
        ])
        ->add('technic', TextType::class, [
            'label' => 'Technique',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'required' => false,
        ])
        ->add('size', TextType::class, [
            'label' => 'Dimension',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'required' => false,
        ])
        ->add('category', ChoiceType::class, [
            'label' => 'Catégorie',
            'choices' => array_merge(
                array_combine($categories, $categories),
                ["Ajouter une nouvelle catégorie" => "new"]
            ),
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => [
                    'class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5",
                    'id' => "category-dropdown",
                ],
                'required' => false,
        ])
        ->add('newCategory', TextType::class, [
            'label' => 'Nouvelle Catégorie',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium new-category-field",
            'style' => "display: none;"],
            'attr' => [
                'class' => "new-category-field bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5",
                'id' => 'new-category-input',
                'style' => "display: none;",
            ],
            'mapped' => false,
            'required' => false,
        ])
        ->add('number', IntegerType::class, [
            'label' => 'Numéro',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'required' => false,
        ])
        ->add('comment', TextType::class, [
            'label' => 'Commentaire',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'required' => false,
        ])
        ->add('link', TextType::class, [
            'label' => 'Hashtag',
            'label_attr' => ['class' => "block mt-2 font-contentfont font-medium"],
                'attr' => ['class' => "bg-gray-100 border-gray-50 text-sm rounded-lg block w-full p-2.5"],
                'required' => false,
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
