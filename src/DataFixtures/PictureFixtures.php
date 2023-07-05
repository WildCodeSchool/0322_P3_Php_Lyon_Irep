<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pictures = $this->getPicturesData();


        foreach ($pictures as $pic) {
            $picture = new Picture();
            $this->setPictureData($picture, $pic);


            $manager->persist($picture);
        }


        $manager->flush();
    }


    private function getPicturesData(): array
    {
        $picturesPart1 = $this->getPicturesPart1();
        $picturesPart2 = $this->getPicturesPart2();
        $picturesPart3 = $this->getPicturesPart3();
        $picturesPart4 = $this->getPicturesPart4();


        $pictures = array_merge($picturesPart1, $picturesPart2, $picturesPart3, $picturesPart4);


        return $pictures;
    }


    private function getPicturesPart1(): array
    {
        $picturesPart1 = [
           [
               'reference' => '40FI79',
               'title' => 'Effet de nuit sur la Cheminée usine du Tampon',
               'subtitle' => 'Cheminée du Tampon',
               'date' => new DateTime('1866-01-01'),
               'technic' => 'Aquarelle',
               'size' => '20 X 14',
               'category' => 'Usines',
               'number' => 1,
               'comment' => "Attribuée parfois à l'usine du Grand Tampon, mais c'est peu probable...",
               'image' => 'uploads/images/Cheminee_40FI79.jpg'
           ],
           [
               'reference' => '40FI78',
               'title' => 'Arrivée à l\'établissement du Tampon',
               'subtitle' => 'L\'Établissement',
               'date' => new DateTime('1866-05-01'),
               'technic' => 'Aquarelle',
               'size' => '15 X 13.5',
               'category' => 'Usines',
               'number' => 2,
               'comment' => "Le chemin de l'Etablissement existe toujours aujourd'hui, à 400 mètres d'altitude...",
               'image' => 'uploads/images/UsineBelAir_40FI78.jpg'
           ],
           [
               'reference' => '40FI106',
               'title' => 'Quartier St Pierre. Etablissement de la Rivière, montagnes de l\'Entre Deux',
               'subtitle' => 'Établissement de la Rivière',
               'date' => new DateTime('1861-08-25'),
               'technic' => 'Aquarelle',
               'size' => '19.5 X 16.5',
               'category' => 'Usines',
               'number' => 4,
               'comment' => "L'usine (Etablissement) est installée rive gauche de la" . "
                Rivière Saint-Etienne, au débouché du " . "
               lieu-dit l'Entre-Deux. Elle semble présenter la même physionomie que" . "
                les autres établissements achetés ou construits" . "
                par Gabriel de K/Véguen: 2 corps principaux de bâtiments, ici décalés" . "
                 l'un par rapport à l'autre, avec des ouvertures" . "
                 en arc de cercle pour évacuer la chaleur, la cheminée qui évacue " . "
                 les fumées de la batterie Gimart, et, à l'arrière," . "
                  un ou deux bâtiments pour le séchage du sucre. Au premier plan," . "
                   une escouade (une 'bande') de travailleurs engagés " . "
                  effectue la 'trouaison', pour la replantation de cannes" . "
                   à sucre, sous la direction d'un Commandeur, " . "
                  vêtu d'un pantalon de toile bleue. Un vacoa est" . "
                   ici le témoin indispensable de l'usage de ses feuilles pour le " . "
                  tressage de sacs, destinés ensuite à transporter le sucre produit.",
               'image' => 'uploads/images/AD974_40FI106.jpg'
           ],
           [
               'reference' => '40FI',
               'title' => 'Boutchiana- Indien',
               'subtitle' => '',
               'date' => new DateTime('1871-10-05'),
               'technic' => 'Aquarelle',
               'size' => '',
               'category' => 'Travailleurs',
               'number' => 1,
               'comment' => "Boutchiana est devenu le domestique personnel" . "
                de Ch.Mortier de Trévise, et il a vieilli de 6 ans.",
               'image' => 'uploads/images/ADR-40fi100-danse-des-noirs.jpg'
           ],
           [
               'reference' => '40FI91',
               'title' => 'Boutchiana- Casernes',
               'subtitle' => '',
               'date' => new DateTime('1865-02-28'),
               'technic' => 'Aquarelle',
               'size' => '19.5 X 11',
               'category' => 'Travailleurs',
               'number' => 2,
               'comment' => "Travailleur engagé depuis l'Inde à l'Etablissement " . "
               des Casernes, il tient une lance, " . "
               peut-être a-t-il une fonction de gardien? Sur sa fiche" . "
                d'engagement, il était recensé comme tailleur",
               'image' => 'uploads/images/FRAD974_40FI91.jpg'
           ],
           [
               'reference' => '40FI90',
               'title' => 'Boutchiana-Casernes, de face',
               'subtitle' => '',
               'date' => new DateTime('1865-01-20'),
               'technic' => 'Aquarelle',
               'size' => '19.5 X 8.5',
               'category' => 'Travailleurs',
               'number' => 3,
               'comment' => "Complète la précédente aquarelle. On devine la" . "
                jeunesse de Boutchiana, engagé à l'adolescence." . "
                Arrivé à bord de Yanaon, en Inde, à bord du navire" . "
                 de la famille Kerveguen, Le Canova, on le dit âgé de 17 ans",
               'image' => 'uploads/images/FRAD974_40FI90.jpg'
           ],
        ];
        return $picturesPart1;
    }


    private function getPicturesPart2(): array
    {
        $picturesPart2 = [
           [
               'reference' => '40Fi75',
               'title' => 'Lucie le ventre plein de cari',
               'subtitle' => '',
               'date' => new DateTime('1866-11-09'),
               'technic' => 'Dessin',
               'size' => '',
               'category' => 'Travailleurs',
               'number' => 7,
               'comment' => "Une autre petite fille de Victorine, sans doute dans la maison des Casernes.",
               'image' => 'uploads/images/FRAD974_40FI75.jpg'
           ],
           [
               'reference' => '40Fi74',
               'title' => 'La belle Tina',
               'subtitle' => '',
               'date' => new DateTime('1866-05-14'),
               'technic' => 'Dessin',
               'size' => '',
               'category' => 'Travailleurs',
               'number' => 8,
               'comment' => "Visiblement, Mortier de Trévise a été" . "
                impressionné par la chevelure de Tina. Encore une petite" . "
                fille de Victorine, plus jeune. Il semble que" . "
                 les fillettes fassent leur apprentissage de domestiques" . "
                  dans la propriété des Kerveguen.",
               'image' => 'uploads/images/FRAD974_40FI74.jpg'
           ],
           [
               'reference' => '40Fi60',
               'title' => 'Jamali, Cafre, Gardien',
               'subtitle' => '',
               'date' => new DateTime('1861-05-05'),
               'technic' => 'Aquarelle',
               'size' => '26 X 16.5',
               'category' => 'Travailleurs',
               'number' => 9,
               'comment' => "'Cafre' veut dire que Jamali n'est pas né sur " . "
               l'Habitation, mais qu'il a vraisemblablement été recruté " . "
               comme engagé. Il est armé d'une lance, et surveille " . "
               l'orée des champs, ou les abords du camp des travailleurs.",
               'image' => 'uploads/images/Jamali.jpg'
           ],
           [
               'reference' => '40FI53.2',
               'title' => 'La pli y fait pas rien, ça ! Tampon',
               'subtitle' => '',
               'date' => new DateTime('1866-01-27'),
               'technic' => 'Dessin',
               'size' => '30 X 20',
               'category' => 'Travailleurs',
               'number' => 11,
               'comment' => "La suite du commentaire est: 'Ca ne lui fait" . "
                rien,... tant pis pour lui ! mais aux cannes ça leur " . "
               fait du bien tant mieux pour elles !....' Le jeune" . "
                créole porte un chapeau de feutre déformé, pas de " . "
               chaussures, comme la majorité des travailleurs. " . "
               Janvier est en pleine période cyclonique: est-ce le cas ici?",
               'image' => 'uploads/images/FRAD974_40FI74.jpg'
           ],
           [
               'reference' => '40FI59',
               'title' => 'Monsieur Bourrayne dans le jardin des Casernes',
               'subtitle' => '',
               'date' => new DateTime('1861-05-10'),
               'technic' => 'Dessin',
               'size' => '20 X 12.5',
               'category' => 'Travailleurs',
               'number' => 12,
               'comment' => "La suite du commentaire est: " . "
               'Allons, Virasami, vivement mettre la racine de ce plant (?) comme à Madras!'",
               'image' => 'uploads/images/MORTIER.de.TREVISE_Mr.Bourraye.dans.jardin.Casernes_1861.jpg'
           ],
           [
               'reference' => '40Fi72',
               'title' => 'Chanvert descend le chemin de la Plaine, Golo est à ses côtés',
               'subtitle' => 'Golo et Chanvert',
               'date' => new DateTime('1861-11-11'),
               'technic' => 'Dessin',
               'size' => '8 X 15.5',
               'category' => 'Travailleurs',
               'number' => 13,
               'comment' => "Chanvert est peut-être un ami de la" . "
                famille. Golo est un domestique qui l'accompagne. " . "
               A l'arrière du tilbury, il semble qu'il y ait" . "
                une borne kilométrique sur le côté de la route. Le chemin de la " . "
                Plaine relie Saint-Pierre à la Plaine " . "
                des Cafres, et, au-delà, à Saint-Benoît. L'Etablissement de Bel-Air " . "
                est situé au tiers du parcours," . "
                 entre La Plaine des Cafres et Saint-Pierre.",
               'image' => 'uploads/images/AD974_40FI72-ChanvertGolo.jpg'
           ],
        ];
        return $picturesPart2;
    }


    private function getPicturesPart3(): array
    {
        $picturesPart3 = [
           [
               'reference' => '40FI55',
               'title' => 'Le parapluie du pauvre Citoyen',
               'subtitle' => '',
               'date' => new DateTime('1861-6-5'),
               'technic' => 'Aquarelle',
               'size' => '19 X 11.5',
               'category' => 'Travailleurs',
               'number' => 10,
               'comment' => "Le titre de citoyen est une fierté pour" . "
                les affranchis de 1848 qui travaillent sur la propriété " . "
               ou dans les Etablissements K/Véguen. La pluie est" . "
                rare à Saint-Pierre, beaucoup plus fréquente au Tampon " . "
               (pluies orographiques pendant la saison chaude, celle de" . "
                la coupe des cannes). Ici, le créole engagé dispose d'une maigre rémunération" . "
                juste suffisante pour sa nourriture et de menus" . "
                 frais à la 'boutique'. Depuis 1859, le salaire" . "
                 ( démonétisés, au cours forcé de 1 franc. " . "
                 peut-être celle de Bel-Air, au Tampon.",
               'image' => 'uploads/images/FRAD974_40FI55.jpg'
           ],[
               'reference' => '40FI76',
               'title' => 'Cafrine et son petit au Tampon',
               'subtitle' => '',
               'date' => new DateTime('1861-05-04'),
               'technic' => 'Aquarelle',
               'size' => '18 X 13',
               'category' => 'Travailleurs',
               'number' => 4,
               'comment' => "C'est une engagée, ou alors " . "
               une affranchie. Elle porte la robe de toile bleue,
               " . "  dont la fourniture est obligatoire" . "
                par l'employeur, selon les termes du contrat d'engagement. " . "
               La pratique ne change guère de ce" . "
                qui était déjà prévu avant 1848 pour les esclaves, par le 'Code noir' de 1723.",
               'image' => 'uploads/images/MORTIERdeTREVISE_caffrine1861.jpg'
           ],[
           'reference' => '40Fi105bis',
           'title' => 'Le volcan de Bourbon vu du Pas de Bellecombre',
           'subtitle' => 'Pas de Bellecombe',
           'date' => new DateTime('1861-08-27'),
           'technic' => 'Aquarelle',
           'size' => '18 X 24',
           'category' => 'Lieux',
           'number' => 4,
           'comment' => "Cela ne fait guère longtemps que le passage par " . "
           le Pas de Bellecombe a été trouvé." . "
            Le lieu porte le nom du gouverneur présent au moment " . "
            de la découverte du passage, mais c'est un esclave,
            " . " Jacob, qui l'a découvert, en réalité." . "
             Bellecombe avait commandité l'expédition.",
           'image' => 'uploads/images/FRAD974_40FI105bis.jpg'
           ],[
           'reference' => '40Fi108',
           'title' => 'Mamzelle',
           'subtitle' => '',
           'date' => new DateTime('1866-12-11'),
           'technic' => 'Dessin',
           'size' => '14.5 X 19.5',
           'category' => 'Animaux',
           'number' => 1,
           'comment' => "Les chevaux sont rares sur les établissements: " . "
           ils font l'objet de soins attentifs," . "
            et ne sont montés que par les propriétaires des Etablissements et les contremaîtres. Selle et cuirs
            " . "  peuvent être fabriqués sur place: il y eut un atelier sur l'Etablissement du Tampon.",
           'image' => 'uploads/images/Mamsellemini_40FI108.jpg'
           ],[
           'reference' => '40FI73',
           'title' => 'Charrette tirée par deux boeufs, dits créoles',
           'subtitle' => '',
           'date' => new DateTime('1866-05-12'),
           'technic' => 'Dessin',
           'size' => '16 X 26',
           'category' => 'Animaux',
           'number' => 2,
           'comment' => "La charrette, les boeufs, et la 'femme à bras'" . "
            au fond sont des motifs qui se retrouvent souvent dans les " . "
            collections de Mortier de Trévise.",
           'image' => 'uploads/images/trevise-cannes_1861.jpg'
           ],[
           'reference' => '40Fi94',
           'title' => 'Coco, en équilibre sur un arbre',
           'subtitle' => '',
           'date' => new DateTime('1865-12-03'),
           'technic' => 'Aquarelle',
           'size' => '14 X 9.5',
           'category' => 'Animaux',
           'number' => 3,
           'comment' => "Coco est un gros lézard, inoffensif, qui vit" . "
            dans les jardins créoles, où il est utile. Il y a une dizaine" . "
             d'espèces de lézards à La Réunion.",
           'image' => 'uploads/images/Cheminee_40FI79.jpg'
           ],
        ];
        return $picturesPart3;
    }


    private function getPicturesPart4(): array
    {
        $picturesPart4 = [
           [
               'reference' => '40Fi83',
               'title' => 'Sortie du Bras de Jean Payet en allant vers le Tampon',
               'subtitle' => 'Sortie du Bras de Jean Payet',
               'date' => new DateTime('1865-02-05'),
               'technic' => 'Dessin',
               'size' => '30 X 22.5',
               'category' => 'Lieux',
               'number' => 1,
               'comment' => "Le tilbury à quatre roues est tiré" . "
                par quatre mules (importées du Poitou). " . "
               La route, encore reconnaissable aujourd'hui, " . "
               reliait les champs de canne situés entre la ravine Jean Payet " . "
               (ancienne ravine du Tampon), et la ravine des Cafres." . "
                Au sommet de ces champs, une scierie fournissait" . "
                le bois et les planches pour les Etablissements K/Véguen.",
               'image' => 'uploads/images/Cheminee_40FI79.jpg'
           ],
           [
               'reference' => '40Fi77',
               'title' => 'Le bassin rouge au Tampon, la ravine descend',
               'subtitle' => 'Bassin rouge',
               'date' => new DateTime('1866-07-07'),
               'technic' => 'Aquarelle',
               'size' => '15 X 9.5',
               'category' => 'Lieux',
               'number' => 2,
               'comment' => "La cascade alimente un bassin" . "
                à proximité d'un affluent de la rivière d'Abord.",
               'image' => 'uploads/images/FRAD974_40FI77.jpg'
           ],
           [
               'reference' => '40Fi104',
               'title' => 'Excursion au volcan de Bourbon',
               'subtitle' => 'Caverne des lataniers',
               'date' => new DateTime('1861-12-12'),
               'technic' => 'Dessin',
               'size' => '24.5 X 32',
               'category' => 'Lieux',
               'number' => 3,
               'comment' => "Mortier de Trévise et" . "
                sa belle-famille sont en excursion au volcan. Il n'y avait pas de route, alors:" . "
                 il faut donc dormir en chemin dans cette caverne autrefois" . "
                 connue des noirs marrons, autrement dit fugitifs - avant l'abolition de l'esclavage de 1848.",
               'image' => 'uploads/images/Cheminee_40FI79.jpg'
           ],
           [
               'reference' => '40FI52',
               'title' => 'La vieille (Victorine) Mme Samsi Casernes',
               'subtitle' => '',
               'date' => new DateTime('1865-10-10'),
               'technic' => 'Aquarelle',
               'size' => '18 X 12',
               'category' => 'Travailleurs',
               'number' => 5,
               'comment' => "La vieille dame est assise sur " . "
               une natte, vêtue de la traditionnelle " . "
                robe de toile bleue fournie par l'employeur." .
           " Son foulard noué sur la tête est taillé dans la même toile.",


               'image' => 'uploads/images/FRAD974_40FI52.jpg'
           ],
           [
               'reference' => '40FI66',
               'title' => 'Elise',
               'subtitle' => '',
               'date' =>  new DateTime('1861-02-25'),
               'technic' => 'Dessin',
               'size' => '',
               'category' => 'Travailleurs',
               'number' => 6,
               'comment' => "Elise est une petite fille de Victorine, issue de sa fille Coralie",
               'image' => 'uploads/images/MORTIERTREVISE_Elise_1861.jpg'
           ],
           [
               'reference' => '40FI80',
               'title' => 'Tampon- Une usine',
               'subtitle' => 'Usine du Tampon',
               'date' =>  new DateTime('1866-12-30'),
               'technic' => 'Dessin à la mine de plomb',
               'size' => '11.5 X 20.5',
               'category' => 'Usines',
               'number' => 3,
               'comment' => "Une autre vue de l'usine de Bel Air, au Tampon: on retrouve le bâtiment " . "
                en quinconce accolé au corp" . "
                de l'usine, avec ses deux cheminées. Au premier plan, sur le chemin de
                " . " l'Etablissement (400 m. d'altitude)," . "
                 on distingue un groupe de travailleurs engagés, près d'un point d'eau:
                 " . "  un homme, une femme avec un bébé qui porte " . "
                 une jarre sur la tête, et un autre personnage. L'auteur note
                 " . " le nom des arbres et plantes (aloés divers, vacoas, palmiers)"
           ,                'image' => 'uploads/images/FRAD974_40FI80.jpg'],
        ];
        return $picturesPart4;
    }


    private function setPictureData(Picture $picture, array $data): void
    {
        $picture->setReference($data['reference']);
        $picture->setTitle($data['title']);
        $picture->setSubtitle($data['subtitle']);
        $picture->setDate($data['date']);
        $picture->setTechnic($data['technic']);
        $picture->setSize($data['size']);
        $picture->setCategory($data['category']);
        $picture->setNumber($data['number']);
        $picture->setComment($data['comment']);
        $picture->setImage($data['image']);
    }
}
