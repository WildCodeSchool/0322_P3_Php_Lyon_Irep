<?php

namespace App\DataFixtures;

use App\Entity\Presentation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PresentationFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRESENTATIONS = [

         ['title' => "BEL AIR, D'UNE SUCRERIE A LA NAISSANCE D'UN VILLAGE",
         'subtitle' =>  "Parcourez les oeuvres de la galerie",
         'image' =>  "uploads/images/carousel2.png",
         'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],

         ['title' => "BEL AIR, D'UNE SUCRERIE A LA NAISSANCE D'UN VILLAGE",
         'subtitle' =>  "Des aquarelles à découvrir",
         'image' =>  "uploads/images/carousel1.png",
         'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],

         ['title' => "L'ILE DE LA REUNION EN FLEURS",
         'subtitle' =>  "Découvrez la beauté florale de l'île à travers des photographies uniques",
         'image' =>  'uploads/presentationImg/flamboyant.jpg',
         'exhibition' => "L'Ile de La Réunion en fleurs"],

         ['title' => "AU SOMMET DE LA REUNION",
         'subtitle' => "Un voyage captivant à travers ses paysages vertigineux",
         'image' =>  'uploads/presentationImg/prespiton.jpg',
         'exhibition' => "Au sommet de La Réunion"],

        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRESENTATIONS as $presentationData) {
            $presentation = new Presentation();
            $presentation ->setTitle($presentationData['title']);
            $presentation ->setSubtitle($presentationData['subtitle']);
            $presentation ->setImage($presentationData['image']);
            $presentation->setExhibition($this->getReference('exhibition_' . $presentationData['exhibition']));
            $manager->persist($presentation);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ExhibitionFixtures::class,
        ];
    }
}
