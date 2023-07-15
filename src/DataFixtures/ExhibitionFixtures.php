<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Exhibition;
use DateTime;

class ExhibitionFixtures extends Fixture
{
    public const EXHIBITIONS = [
        ['name' => "Bel'air, d'une sucrerie à la naissance d'un village",
         'start' =>  '15/05/2023',
         'end' =>  '30/09/2023'],

         ['name' => "L'Ile de La Réunion en fleurs",
         'start' =>  '26/06/2023',
         'end' =>  '25/09/2023'],

         ['name' => "Au sommet de La Réunion",
         'start' =>  '14/07/2023',
         'end' =>  '26/10/2023'],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EXHIBITIONS as $exhibitionData) {
            $exhibition = new Exhibition();
            $exhibition ->setName($exhibitionData['name']);
            $exhibition ->setStart(DateTime::createFromFormat('d/m/Y', $exhibitionData['start']));
            $exhibition ->setEnd(DateTime::createFromFormat('d/m/Y', $exhibitionData['end']));
            $manager->persist($exhibition);
            $this->addReference('exhibition_' . $exhibitionData['name'], $exhibition);
        }
        $manager->flush();
    }
}
