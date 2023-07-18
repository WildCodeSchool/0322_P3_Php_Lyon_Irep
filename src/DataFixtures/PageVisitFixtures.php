<?php

namespace App\DataFixtures;

use App\Entity\Exhibition;
use App\Entity\PageVisit;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTime;

class PageVisitFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $pictures = $manager->getRepository(Picture::class)->findAll();
        $exhibitions = $manager->getRepository(Exhibition::class)->findAll();

        new DateTime('-1 month');

        foreach ($pictures as $picture) {
            $numberOfVisits = $faker->numberBetween(1, 10);

            for ($i = 0; $i < $numberOfVisits; $i++) {
                $visitDate = $faker->dateTimeBetween('-1 month', 'now');

                $pageVisit = new PageVisit();
                $pageVisit->setVisitedAt($visitDate);
                $pageVisit->setPicture($picture);

                $route = $faker->randomElement(['app_home', 'app_home', 'app_picture_index']);
                $pageVisit->setRouteName($route);

                $manager->persist($pageVisit);
            }
        }

        foreach ($exhibitions as $exhibition) {
            $numberOfVisits = $faker->numberBetween(1, 100);

            for ($i = 0; $i < $numberOfVisits; $i++) {
                $visitDate = $faker->dateTimeBetween('-1 month', 'now');

                $pageVisit = new PageVisit();
                $pageVisit->setVisitedAt($visitDate);

                $pageVisit->setPicture(null);

                $route = 'app_picture_index/' . $exhibition->getId();
                $pageVisit->setRouteName($route);

                $manager->persist($pageVisit);
            }
        }


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PictureFixtures::class, ExhibitionFixtures::class];
    }
}
