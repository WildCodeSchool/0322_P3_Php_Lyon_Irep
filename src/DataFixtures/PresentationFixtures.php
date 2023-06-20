<?php

namespace App\DataFixtures;

use App\Entity\Presentation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PresentationFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRESENTATIONS = [
        ['title' => "LE TAMPON",
         'subtitle' =>  "Journées Européennes du Patrimoine 2023.",
         'image' =>  "build/images/carousel1.png",
         'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],

         ['title' => "BEL AIR, D'UNE SUCRERIE A LA NAISSANCE D'UN VILLAGE.",
         'subtitle' =>  "Visitez la galerie et parcourez les oeuvres.",
         'image' =>  "build/images/carousel2.png",
         'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],

         ['title' => "HIPPOLYTE CHARLES NAPOLEON MORTIER.",
         'subtitle' =>  "Duc de Trévise.",
         'image' =>  "build/images/carousel3.png",
         'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],

         ['title' => "ILE DE LA REUNION EXPOSITIONS PATRIMOINE",
         'subtitle' => "Une association au service de l'histoire de l'Ile.",
         'image' =>  "build/images/carousel3.png",
         'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRESENTATIONS as $presentationData) {
            $presentation = new Presentation();
            $presentation ->setTitle($presentationData['title']);
            $presentation ->setSubtitle($presentationData['subtitle']);
            $presentation ->setImage($presentationData['image']);
            $presentation->setExhibition($this->getReference('exhibition'));
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
