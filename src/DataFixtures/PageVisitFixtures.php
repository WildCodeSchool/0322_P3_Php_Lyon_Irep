<?php

namespace App\DataFixtures;

use App\Entity\PageVisit;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PageVisitFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $pictures = $manager->getRepository(Picture::class)->findAll();

        foreach ($pictures as $picture) {
            $numberOfVisits = $faker->numberBetween(1, 10);

            for ($i = 0; $i < $numberOfVisits; $i++) {
                $pageVisit = new PageVisit();
                $pageVisit->setVisitedAt($faker->dateTimeBetween('-1 year', 'now'));
                $pageVisit->setPicture($picture);

                if ($i < 5) {
                    $pageVisit->setRouteName('app_home');
                } else {
                    $pageVisit->setRouteName('app_picture_index');
                }

                $manager->persist($pageVisit);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PictureFixtures::class];
    }
}
