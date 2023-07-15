<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture implements DependentFixtureInterface
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
        $picturesPart5 = $this->getPicturesPart5();
        $picturesPart6 = $this->getPicturesPart6();
        $picturesPart7 = $this->getPicturesPart7();
        $picturesPart8 = $this->getPicturesPart8();


        $pictures = array_merge(
            $picturesPart1,
            $picturesPart2,
            $picturesPart3,
            $picturesPart4,
            $picturesPart5,
            $picturesPart6,
            $picturesPart7,
            $picturesPart8
        );


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
               'image' => 'uploads/images/Cheminee_40FI79.jpg',
               'link' => '#Cheminée #Tampon',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
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
               'image' => 'uploads/images/UsineBelAir_40FI78.jpg',
               'link' => '#Usine #Tampon',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/AD974_40FI106.jpg',
               'link' => '#SaintPierre #Tampon',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/ADR-40fi100-danse-des-noirs.jpg',
               'link' => '#Indien #Tampon',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/FRAD974_40FI91.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/FRAD974_40FI90.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
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
               'image' => 'uploads/images/FRAD974_40FI75.jpg',
               'link' => '#Lucie',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
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
               'image' => 'uploads/images/FRAD974_40FI74.jpg',
               'link' => '#Tina',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/Jamali.jpg',
               'link' => '#Jamali',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/FRAD974_40FI74.jpg',
               'link' => '#Tampon',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village" ],
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
               'image' => 'uploads/images/MORTIER.de.TREVISE_Mr.Bourraye.dans.jardin.Casernes_1861.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/AD974_40FI72-ChanvertGolo.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village" ],
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
               'size' => '19 X 11.5','category' => 'Travailleurs','number' => 10,
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
               'image' => 'uploads/images/FRAD974_40FI55.jpg',
               'link' => '#Chanvert #Parapluie',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/MORTIERdeTREVISE_caffrine1861.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],[
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
               'image' => 'uploads/images/FRAD974_40FI105bis.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"
               ],[
               'reference' => '40Fi108',
               'title' => 'Mamzelle','subtitle' => '',
               'date' => new DateTime('1866-12-11'),
               'technic' => 'Dessin','size' => '14.5 X 19.5',
               'category' => 'Animaux',
               'number' => 1,
               'comment' => "Les chevaux sont rares sur les établissements: " . "
           ils font l'objet de soins attentifs," . "
            et ne sont montés que par les propriétaires des Etablissements et les contremaîtres. Selle et cuirs
            " . "  peuvent être fabriqués sur place: il y eut un atelier sur l'Etablissement du Tampon.",
               'image' => 'uploads/images/Mamsellemini_40FI108.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"
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
           'image' => 'uploads/images/trevise-cannes_1861.jpg',
           'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"
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
           'image' => 'uploads/images/Cheminee_40FI79.jpg',
           'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
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
               'size' => '30 X 22.5','category' => 'Lieux','number' => 1,
               'comment' => "Le tilbury à quatre roues est tiré" . "
                par quatre mules (importées du Poitou). " . "
               La route, encore reconnaissable aujourd'hui, " . "
               reliait les champs de canne situés entre la ravine Jean Payet " . "
               (ancienne ravine du Tampon), et la ravine des Cafres." . "
                Au sommet de ces champs, une scierie fournissait" . "
                le bois et les planches pour les Etablissements K/Véguen.",
               'image' => 'uploads/images/Cheminee_40FI79.jpg',
               'link' => '#Coco #Payet',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village" ],
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
               'image' => 'uploads/images/FRAD974_40FI77.jpg',
               'link' => '#Coco #ravine',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village" ],
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
               'image' => 'uploads/images/Cheminee_40FI79.jpg',
               'link' => '#Volcan #Bourbon',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village" ],
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
               'image' => 'uploads/images/FRAD974_40FI52.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
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
               'image' => 'uploads/images/MORTIERTREVISE_Elise_1861.jpg',
               'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
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
           ,                'image' => 'uploads/images/FRAD974_40FI80.jpg',
           'exhibition' => "Bel'air, d'une sucrerie à la naissance d'un village"],
        ];
        return $picturesPart4;
    }

    private function getPicturesPart5(): array
    {
        $picturesPart5 = [
           [
               'reference' => '1F01',
               'title' => "L'oiseau du paradis",
               'subtitle' => "Strelitzia reginae",
               'date' => new DateTime('2019-04-13'),
               'technic' => 'Photographie',
               'size' => '20 X 30','category' => 'Fleurs','number' => 1,
               'comment' => "Cette fleur exotique est originaire d'Afrique du Sud, 
               mais elle est également présente sur l'île de La Réunion.
               Elle est appréciée pour ses magnifiques pétales orange vif et bleus,
               qui ressemblent à la tête d'un oiseau.",
               'image' => 'uploads/images/oiseauduparadis.jpg',
               'link' => '#Fleurs #OiseauParadis',
               'exhibition' => "L'Ile de La Réunion en fleurs" ],
            [
               'reference' => '1F02',
               'title' => "La fleur de tiare",
               'subtitle' => 'Gardenia taitensis',
               'date' => new DateTime('2017-06-14'),
               'technic' => 'Photographie',
               'size' => '40 X 60','category' => 'Fleurs','number' => 2,
               'comment' => "Cette fleur blanche au parfum envoûtant est largement
               utilisée dans les traditions et les coutumes de l'île de La Réunion.
               Elle est souvent portée derrière l'oreille ou utilisée
               pour fabriquer des parfums.",
               'image' => 'uploads/images/fleurtiare.jpg',
               'link' => '#Fleurs #FleurTiare',
               'exhibition' => "L'Ile de La Réunion en fleurs" ],
            [
                'reference' => '1F03',
                'title' => "La fleur de frangipanier",
                'subtitle' => "Plumeria",
                'date' => new DateTime('2022-07-14'),
                'technic' => 'Photographie',
                'size' => '40 X 60','category' => 'Arbres','number' => 1,
                'comment' => "Le frangipanier est un arbre tropical qui produit de
                magnifiques fleurs en forme d'étoile dans une variété de couleurs,
                notamment le blanc, le rose et le jaune. Ses fleurs délicatement
                parfumées sont souvent utilisées dans les bouquets et les colliers
                de fleurs.",
                'image' => 'uploads/images/plumeria.jpg',
                'link' => '#Arbres #Frangipanier',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],
            [
                'reference' => '1F04',
                'title' => "Le flamboyant",
                'subtitle' => "Delonix regia",
                'date' => new DateTime('2021-11-14'),
                'technic' => 'Photographie',
                'size' => '50 X 70','category' => 'Arbres','number' => 2,
                'comment' => "Le flamboyant est un arbre majestueux avec des fleurs
                éclatantes de couleur rouge vif. Il est très présent sur l'île
                et fleurit principalement entre novembre et janvier. Les flamboyants
                ajoutent une explosion de couleurs à l'environnement et sont souvent
                considérés comme l'emblème floral de La Réunion.",
                'image' => 'uploads/images/flamboyant.jpg',
                'link' => '#Arbres #Flamboyant',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],
            [
                'reference' => '1F05',
                'title' => "L'hibiscus",
                'subtitle' => "Hibiscus rosa-sinensis",
                'date' => new DateTime('2021-10-26'),
                'technic' => 'Photographie',
                'size' => '50 X 70','category' => 'Fleurs','number' => 3,
                'comment' => "Cette fleur tropicale est appréciée pour ses grandes 
                fleurs voyantes et ses pétales colorés qui peuvent varier du rouge,
                orange et rose au blanc. L'hibiscus est fréquemment utilisé dans 
                les jardins et est également considéré comme l'un des symboles de l'île.",
                'image' => 'uploads/images/hibiscus.jpg',
                'link' => '#Fleurs #Hibiscus',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],
            [
                'reference' => '1F06',
                'title' => "Le canna",
                'subtitle' => "Canna indica",
                'date' => new DateTime('2021-03-17'),
                'technic' => 'Photographie',
                'size' => '20 X 30','category' => 'Fleurs','number' => 4,
                'comment' => "Le canna est une plante vivace qui produit de grandes
                fleurs en forme de trompette dans une variété de couleurs vives,
                notamment le rouge, le jaune et l'orange. Ses fleurs sont souvent
                utilisées dans les arrangements floraux.",
                'image' => 'uploads/images/canna.jpg',
                'link' => '#Fleurs #Canna',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],

        ];
        return $picturesPart5;
    }

    private function getPicturesPart6(): array
    {
        $picturesPart6 = [

             [
                'reference' => '1F07',
                'title' => "La fleur de bougainvillier",
                'subtitle' => "Bougainvillea",
                'date' => new DateTime('2021-02-01'),
                'technic' => 'Photographie',
                'size' => '50 X 70','category' => 'Arbres','number' => 3,
                'comment' => "Bien qu'elle soit techniquement une bractée colorée et
                non une fleur, le bougainvillier est très répandu sur l'île de La Réunion
                et ajoute une splendeur éclatante avec ses bractées colorées dans des
                teintes de rose, de pourpre, d'orange et de blanc.",
                'image' => 'uploads/images/bougainvillier.jpg',
                'link' => '#Arbres #Bougainvillier',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],
             [
                'reference' => '1F08',
                'title' => "La fleur de jasmin",
                'subtitle' => "Jasminum",
                'date' => new DateTime('2021-04-05'),
                'technic' => 'Photographie',
                'size' => '40 X 60','category' => 'Fleurs','number' => 5,
                'comment' => "Le jasmin est une plante grimpante appréciée pour ses 
                petites fleurs blanches ou jaunes, qui dégagent un parfum envoûtant.
                Il est souvent cultivé dans les jardins et les patios, ajoutant une
                fragrance agréable à l'air ambiant.",
                'image' => 'uploads/images/jasmin.jpg',
                'link' => '#Fleurs #Jasmin',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],
             [
                'reference' => '1F09',
                'title' => "La fleur de la passion",
                'subtitle' => "Passiflora",
                'date' => new DateTime('2022-05-04'),
                'technic' => 'Photographie',
                'size' => '40 X 60','category' => 'Fleurs','number' => 6,
                'comment' => "La fleur de la passion est une fleur exotique aux 
                couleurs vives, souvent pourpre ou violet foncé, avec des filaments
                contrastants. Elle est le symbole du fruit de la passion et
                est également cultivée comme plante ornementale.",
                'image' => 'uploads/images/passiflora.jpg',
                'link' => '#Fleurs #Passiflora',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],
             [
                'reference' => '1F10',
                'title' => "La fleur de bananier",
                'subtitle' => "",
                'date' => new DateTime('2022-11-14'),
                'technic' => 'Photographie',
                'size' => '20 X 30','category' => 'Arbres','number' => 4,
                'comment' => "Bien que le bananier soit principalement connu pour
                ses fruits, il produit également de grandes fleurs en forme de cône
                qui se développent au milieu de ses feuilles. Ces fleurs sont 
                généralement de couleur blanche ou jaune et ajoutent une touche
                exotique aux paysages de l'île.",
                'image' => 'uploads/images/bananier.jpg',
                'link' => '#Arbres #Bananier',
                'exhibition' => "L'Ile de La Réunion en fleurs" ],
             [
                'reference' => '2S01',
                'title' => "Le Piton de la Fournaise",
                'subtitle' => "",
                'date' => new DateTime('2023-01-11'),
                'technic' => 'Photographie',
                'size' => '75 X 100','category' => 'Volcans','number' => 1,
                'comment' => "Le Piton de la Fournaise, sur l'île de La Réunion, est l'un
                des volcans les plus actifs au monde. Avec ses éruptions régulières, il 
                offre des paysages impressionnants rappelant une ambiance lunaire. 
                Culminant à 2 632 mètres, son sommet abrite le cratère Dolomieu, d'où 
                émergent les coulées de lave qui façonnent de nouvelles formations géologiques.
                Les randonneurs peuvent parcourir les sentiers balisés pour admirer de près 
                ces formations volcaniques et profiter des panoramas spectaculaires.",
                'image' => 'uploads/images/pitonfournaise1.jpg',
                'link' => '#Volcans #PitonFournaise',
                'exhibition' => "Au sommet de La Réunion" ],

        ];
        return $picturesPart6;
    }

    private function getPicturesPart7(): array
    {
        $picturesPart7 = [

             [
                'reference' => '2S02',
                'title' => "Le Piton de la Fournaise",
                'subtitle' => "",
                'date' => new DateTime('2022-02-26'),
                'technic' => 'Photographie',
                'size' => '40 X 60','category' => 'Volcans','number' => 2,
                'comment' => "Le Piton de la Fournaise, est un volcan fascinant qui
                témoigne d'une activité géologique en constante évolution. Ses éruptions
                prévisibles sont suivies de près par les scientifiques, permettant d'assurer
                la sécurité des visiteurs. Lors des éruptions, les coulées de lave dévalent les
                pentes du volcan, créant de nouvelles étendues de terrain et offrant un spectacle 
                impressionnant. C'est une expérience inoubliable pour les passionnés de volcanologie
                et une occasion unique d'observer la puissance de la nature à l'oeuvre.",
                'image' => 'uploads/images/pitonfournaise2.jpg',
                'link' => '#Volcans #PitonFournaise',
                'exhibition' => "Au sommet de La Réunion" ],
             [
                'reference' => '2S03',
                'title' => "La vallée du Piton",
                'subtitle' => "",
                'date' => new DateTime('2020-06-20'),
                'technic' => 'Photographie',
                'size' => '75 X 100','category' => 'Volcans','number' => 3,
                'comment' => "La vallée environnant le Piton de la Fournaise offre des paysages
                enchanteurs. Les versants verdoyants sont parsemés de cascades majestueuses qui
                se déversent dans des rivières sinueuses. La végétation luxuriante de la vallée
                crée un contraste saisissant avec les formations volcaniques environnantes. C'est
                un véritable havre de tranquillité où l'on peut se perdre dans la beauté naturelle
                et profiter de la sérénité de cet écosystème préservé.",
                'image' => 'uploads/images/prespiton.jpg',
                'link' => '#Volcans #PitonFournaise',
                'exhibition' => "Au sommet de La Réunion" ],
             [
                'reference' => '2S04',
                'title' => "Le Piton des Neiges",
                'subtitle' => "",
                'date' => new DateTime('2021-11-12'),
                'technic' => 'Photographie',
                'size' => '20 X 30','category' => 'Volcans','number' => 4,
                'comment' => "Le Piton des Neiges, sommet le plus élevé de l'île de La Réunion,
                culmine à 3 071 mètres. Sa randonnée offre des vues panoramiques époustouflantes sur les
                paysages montagneux environnants. C'est une expérience inoubliable pour les amateurs de 
                randonnée en quête de défis et de beauté naturelle. La diversité de la flore et l'
                atmosphère tranquille ajoutent à l'attrait de cette ascension. Au sommet, une vue imprenable
                récompense les randonneurs avec une vue à couper le souffle sur l'île.",
                'image' => 'uploads/images/pitondesneiges1.jpg',
                'link' => '#Volcans #PitonNeiges',
                'exhibition' => "Au sommet de La Réunion" ],
             [
                'reference' => '2S05',
                'title' => "Le Cirque de Mafate",
                'subtitle' => "",
                'date' => new DateTime('2019-10-08'),
                'technic' => 'Photographie',
                'size' => '40 X 60','category' => 'Cirques','number' => 1,
                'comment' => "Le Cirque de Mafate, classé au patrimoine mondial de l'UNESCO, est une 
                destination incontournable pour les amoureux de la nature .Il offre un paysage 
                impressionnant avec ses montagnes imposantes, ses cascades, ses ravins et ses forêts 
                tropicales d'une biodiversité exceptionnelle. Le Cirque de Mafate est un véritable 
                joyau naturel qui transporte les aventuriers dans un autre monde, où la nature règne en maître.",
                'image' => 'uploads/images/mafate1.jpg',
                'link' => '#Cirques #Mafate',
                'exhibition' => "Au sommet de La Réunion" ],
             [
                'reference' => '2S06',
                'title' => "Le Cirque de Mafate",
                'subtitle' => "",
                'date' => new DateTime('2019-10-08'),
                'technic' => 'Photographie',
                'size' => '40 X 60','category' => 'Cirques','number' => 2,
                'comment' => "Niché au coeur de l'île, le Cirque de Mafate est un véritable sanctuaire
                naturel, accessible uniquement à pied ou en hélicoptère. Ses montagnes escarpées et ses
                vallées luxuriantes offrent une évasion totale. Les pittoresques villages créoles, nichés
                au creux des montagnes, témoignent de l'histoire et de la culture de cette région.",
                'image' => 'uploads/images/mafate2.jpg',
                'link' => '#Cirques #Mafate',
                'exhibition' => "Au sommet de La Réunion" ],

        ];
        return $picturesPart7;
    }

    private function getPicturesPart8(): array
    {
        $picturesPart8 = [

            [
                'reference' => '2S07',
                'title' => "Le Cirque de Salazie",
                'subtitle' => "",
                'date' => new DateTime('2022-07-08'),
                'technic' => 'Photographie',
                'size' => '50 X 70','category' => 'Cirques','number' => 3,
                'comment' => "Le Cirque de Salazie est un véritable écrin de verdure préservé. Ses
                paysages luxuriants, ses cascades et ses villages créoles pittoresques en font une 
                destination incontournable. Les routes panoramiques offrent des vues à couper le 
                souffle, tandis que les sentiers de randonnée permettent d'explorer ce paradis naturel. ",
                'image' => 'uploads/images/cascade.jpg',
                'link' => '#Cirques #Salazie',
                'exhibition' => "Au sommet de La Réunion" ],

        ];
        return $picturesPart8;
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
        $picture->setLink(array_key_exists('link', $data) ? $data['link'] : null);
        $picture->setExhibition($this->getReference('exhibition_' . $data['exhibition']));
    }

    public function getDependencies()
    {
        return [
          ExhibitionFixtures::class,
        ];
    }
}
