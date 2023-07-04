<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Exhibition;
use DateTime;

class ExhibitionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $exhibition = new Exhibition();
        $exhibition->setName("Bel'air, d'une sucrerie à la naissance d'un village");
        $exhibition->setStart(DateTime::createFromFormat('d/m/Y', '16/09/2023'));
        $exhibition->setEnd(DateTime::createFromFormat('d/m/Y', '17/09/2023'));

        $manager->persist($exhibition);
        $manager->flush();

        // Ajout d'une référence à l'exhibition
        $this->addReference('exhibition', $exhibition);
    }
}
