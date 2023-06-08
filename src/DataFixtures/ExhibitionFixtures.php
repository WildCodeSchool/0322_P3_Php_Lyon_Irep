<?php

namespace App\DataFixtures;

use App\Entity\Exhibition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExhibitionFixtures extends Fixture
{
    
        public const EXHIBITIONS = [    
        ['title' => "LE TAMPON",
         'subtitle' =>  "Journées Européennes du Patrimoine 2023.",
         'image' =>  "build/images/carousel1.png"],

         ['title' => "BEL AIR, D'UNE SUCRERIE A LA NAISSANCE D'UN VILLAGE.",
         'subtitle' =>  "Visitez la galerie et parcourez les oeuvres.",
         'image' =>  "build/images/carousel2.png"],

         ['title' => "HIPPOLYTE CHARLES NAPOLEON MORTIER.",
         'subtitle' =>  "Duc de Trévise.",
         'image' =>  "build/images/carousel3.png"],

         ['title' => "ILE DE LA REUNION EXPOSITIONS PATRIMOINE",
         'subtitle' => "Une association au service de l'histoire de l'Ile.",
         'image' =>  "build/images/carousel3.png"],
        ];

    public function load(ObjectManager $manager):void
    {
        foreach (self::EXHIBITIONS as $exhibitionCarousel){
            $exhibition = new EXHIBITION(); 
            $exhibition ->setTitle($exhibitionCarousel['title']);
            $exhibition ->setSubtitle($exhibitionCarousel['subtitle']);
            $exhibition ->setImage($exhibitionCarousel['image']);
            $manager->persist($exhibition); 
            $manager->flush();
           
        }
      
    }
    

}

