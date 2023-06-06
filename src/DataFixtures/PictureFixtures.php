<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadPictureCategory1($manager);
        $this->loadPictureCategory2($manager);
    }

    public function loadPictureCategory1(ObjectManager $manager): void
    {
        $picture = new Picture();

        $picture->setReference('40FI79');
        $picture->setTitle('Effet de nuit sur la Cheminée usine du Tampon');
        $picture->setSubtitle('Cheminée du Tampon');
        $picture->setDate(new DateTime('1866-01-01'));
        $picture->setTechnic('Aquarelle');
        $picture->setSize('20 X 14');
        $picture->setCategory('Usines');
        $picture->setNumber(1);
        $picture->setComment('Attribuée parfois à l\'usine du Grand Tampon, mais c\'est peu probable: '
        . 'l\'usine du Grand Tampon ayant été une scierie. Or, ici, il s\'agit sans doute de '
        . 'l\'usine de Bel Air: on reconnaît les deux corps principaux du bâtiment industriel '
        . '(purgerie et bâtiment abritant la machine à vapeur) en parallèle, comme sur les figures 2 et 3. '
        . 'La cheminée carrée est sur le côté Nord, construite en basalte, avec intercalation de poutres '
        . 'deux côtés par deux côtés. Devant, un gardien, dont l\'ombre se projette sur la cheminée. '
        . 'En arrière-plan, une allée de palmiers, qui semble mener vers la maison de maître. '
        . 'La disposition des lieux correspond à celle qui existait à Bel Air. Scène d\'apparence paisible ?');
        $picture->setImage('build/images/UsineBelAir_40FI78.jpg');

        $manager->persist($picture);

        $picture1 = new Picture();

        $picture1->setReference('40FI79');
        $picture1->setTitle('Effet de nuit sur la Cheminée usine du Tampon');
        $picture1->setSubtitle('Cheminée du Tampon');
        $picture1->setDate(new DateTime('1866-01-01'));
        $picture1->setTechnic('Aquarelle');
        $picture1->setSize('20 X 14');
        $picture1->setCategory('Usines');
        $picture1->setNumber(1);
        $picture1->setComment('Attribuée parfois à l\'usine du Grand Tampon, mais c\'est peu probable: '
        . 'l\'usine du Grand Tampon ayant été une scierie. Or, ici, il s\'agit sans doute de '
        . 'l\'usine de Bel Air: on reconnaît les deux corps principaux du bâtiment industriel '
        . '(purgerie et bâtiment abritant la machine à vapeur) en parallèle, comme sur les figures 2 et 3. '
        . 'La cheminée carrée est sur le côté Nord, construite en basalte, avec intercalation de poutres '
        . 'deux côtés par deux côtés. Devant, un gardien, dont l\'ombre se projette sur la cheminée. '
        . 'En arrière-plan, une allée de palmiers, qui semble mener vers la maison de maître. '
        . 'La disposition des lieux correspond à celle qui existait à Bel Air. Scène d\'apparence paisible ?');
        $picture1->setImage('build/images/FRAD974_40FI74.jpg');

        $manager->persist($picture1);

        $picture2 = new Picture();

        $picture2->setReference('40FI79');
        $picture2->setTitle('Effet de nuit sur la Cheminée usine du Tampon');
        $picture2->setSubtitle('Cheminée du Tampon');
        $picture2->setDate(new DateTime('1866-01-01'));
        $picture2->setTechnic('Aquarelle');
        $picture2->setSize('20 X 14');
        $picture2->setCategory('Usines');
        $picture2->setNumber(1);
        $picture2->setComment('Attribuée parfois à l\'usine du Grand Tampon, mais c\'est peu probable: '
        . 'l\'usine du Grand Tampon ayant été une scierie. Or, ici, il s\'agit sans doute de '
        . 'l\'usine de Bel Air: on reconnaît les deux corps principaux du bâtiment industriel '
        . '(purgerie et bâtiment abritant la machine à vapeur) en parallèle, comme sur les figures 2 et 3. '
        . 'La cheminée carrée est sur le côté Nord, construite en basalte, avec intercalation de poutres '
        . 'deux côtés par deux côtés. Devant, un gardien, dont l\'ombre se projette sur la cheminée. '
        . 'En arrière-plan, une allée de palmiers, qui semble mener vers la maison de maître. '
        . 'La disposition des lieux correspond à celle qui existait à Bel Air. Scène d\'apparence paisible ?');
        $picture2->setImage('build/images/FRAD974_40FI98.jpg');

        $manager->persist($picture2);

        $picture3 = new Picture();

        $picture3->setReference('40FI79');
        $picture3->setTitle('Effet de nuit sur la Cheminée usine du Tampon');
        $picture3->setSubtitle('Cheminée du Tampon');
        $picture3->setDate(new DateTime('1866-01-01'));
        $picture3->setTechnic('Aquarelle');
        $picture3->setSize('20 X 14');
        $picture3->setCategory('Usines');
        $picture3->setNumber(1);
        $picture3->setComment('Attribuée parfois à l\'usine du Grand Tampon, mais c\'est peu probable: '
        . 'l\'usine du Grand Tampon ayant été une scierie. Or, ici, il s\'agit sans doute de '
        . 'l\'usine de Bel Air: on reconnaît les deux corps principaux du bâtiment industriel '
        . '(purgerie et bâtiment abritant la machine à vapeur) en parallèle, comme sur les figures 2 et 3. '
        . 'La cheminée carrée est sur le côté Nord, construite en basalte, avec intercalation de poutres '
        . 'deux côtés par deux côtés. Devant, un gardien, dont l\'ombre se projette sur la cheminée. '
        . 'En arrière-plan, une allée de palmiers, qui semble mener vers la maison de maître. '
        . 'La disposition des lieux correspond à celle qui existait à Bel Air. Scène d\'apparence paisible ?');
        $picture3->setImage('build/images/FRAD974_40FI80.jpg');

        $manager->persist($picture3);

        $manager->flush();
    }

    public function loadPictureCategory2(ObjectManager $manager): void
    {
        $picture = new Picture();

        $picture->setReference('40FI79');
        $picture->setTitle('Effet de nuit sur la Cheminée usine du Tampon');
        $picture->setSubtitle('Cheminée du Tampon');
        $picture->setDate(new DateTime('1866-01-01'));
        $picture->setTechnic('Aquarelle');
        $picture->setSize('20 X 14');
        $picture->setCategory('Usines');
        $picture->setNumber(1);
        $picture->setComment('Attribuée parfois à l\'usine du Grand Tampon, mais c\'est peu probable: '
        . 'l\'usine du Grand Tampon ayant été une scierie. Or, ici, il s\'agit sans doute de '
        . 'l\'usine de Bel Air: on reconnaît les deux corps principaux du bâtiment industriel '
        . '(purgerie et bâtiment abritant la machine à vapeur) en parallèle, comme sur les figures 2 et 3. '
        . 'La cheminée carrée est sur le côté Nord, construite en basalte, avec intercalation de poutres '
        . 'deux côtés par deux côtés. Devant, un gardien, dont l\'ombre se projette sur la cheminée. '
        . 'En arrière-plan, une allée de palmiers, qui semble mener vers la maison de maître. '
        . 'La disposition des lieux correspond à celle qui existait à Bel Air. Scène d\'apparence paisible ?');
        $picture->setImage('build/images/FRAD974_40FI90.jpg');

        $manager->persist($picture);

        $manager->flush();
    }
}
