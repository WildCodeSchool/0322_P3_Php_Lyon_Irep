<?php

namespace App\DataFixtures;

use App\Entity\Exhibition;
use App\Entity\PresentationExhibition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PresentationExhibitionFixtures extends Fixture
{
    public const PRESENTATIONEXHIBITION  = [
        ['title' => "LE TAMPON",
         'subtitle' =>  "Journées Européennes du Patrimoine 2023",
         'image' =>  "build/images/carousel1.png"],

         ['title' => "BEL AIR, D'UNE SUCRERIE A LA NAISSANCE D'UN VILLAGE",
         'subtitle' =>  "Visitez la galerie et parcourez les oeuvres",
         'image' =>  "build/images/carousel2.png"],

         ['title' => "HIPPOLYTE CHARLES NAPOLEON MORTIER",
         'subtitle' =>  "Duc de Trévise",
         'image' =>  "build/images/carousel3.png"],

         ['title' => "ILE DE LA REUNION EXPOSITIONS PATRIMOINE",
         'subtitle' => "Une association au service de l'histoire de l'Ile",
         'image' =>  "build/images/carousel3.png"],
        ];

    public function load(ObjectManager $manager): void
    {
        // Récupération de l'exhibition par sa référence
        $exhibition = $this->getReference(ExhibitionFixtures::EXHIBITION_REFERENCE);

        foreach (self::PRESENTATIONEXHIBITION as $presentationData) {
            $presentation = new PresentationExhibition();
            $presentation->setTitle($presentationData['title']);
            $presentation->setSubtitle($presentationData['subtitle']);
            $presentation->setImage($presentationData['image']);
            $presentation->setExhibitionId($exhibition); // Assuming you renamed this to setExhibition

            $manager->persist($presentation);
        }

        $manager->flush();
    }
}
