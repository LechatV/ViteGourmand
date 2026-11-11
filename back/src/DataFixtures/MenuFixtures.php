<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\Plat;
use App\Entity\Regime;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MenuFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Les 4 menus qui étaient écrits en dur dans menus.html
        $menus = [
            [
                'titre' => 'Menu Tradition',
                'description' => 'Un menu du terroir, simple et généreux, pour les repas en famille.',
                'personnes' => 4,
                'prix' => '35.00',
                'quantite' => 10,
                'theme' => 'Classique',
                'regime' => 'Classique',
                'plats' => ['Terrine de campagne', 'Sauté de boeuf et écrasé de pommes de terre', 'Crumble aux pommes et caramel'],
            ],
            [
                'titre' => 'Menu Pêcheur',
                'description' => 'Un menu autour de la mer, avec des produits frais de la côte atlantique.',
                'personnes' => 6,
                'prix' => '41.00',
                'quantite' => 5,
                'theme' => 'Classique',
                'regime' => 'Classique',
                'plats' => ['Gambas poêlées', "Dos de cabillaud au beurre blanc à l'orange", 'Tarte fine poire chocolat'],
            ],
            [
                'titre' => 'Menu Grillades',
                'description' => 'Un menu convivial, idéal pour les anniversaires et les fêtes entre amis.',
                'personnes' => 8,
                'prix' => '32.00',
                'quantite' => 8,
                'theme' => 'Évènement',
                'regime' => 'Classique',
                'plats' => ['Bruschetta poivrons et aubergines', 'Brochettes mixtes', 'Fondant chocolat et crème anglaise'],
            ],
            [
                'titre' => 'Menu Prestige',
                'description' => 'Notre menu le plus raffiné, pour les grandes occasions et les fêtes de fin d\'année.',
                'personnes' => 4,
                'prix' => '45.00',
                'quantite' => 3,
                'theme' => 'Noël',
                'regime' => 'Classique',
                'plats' => ['Tataki de thon', 'Saint-Jacques, patate douce et poireau', 'Cheesecake et coulis de figues'],
            ],
        ];

        foreach ($menus as $donnees) {
            $menu = new Menu();
            $menu->setTitre($donnees['titre']);
            $menu->setDescription($donnees['description']);
            $menu->setNombrePersonneMinimum($donnees['personnes']);
            $menu->setPrixParPersonne($donnees['prix']);
            $menu->setQuantiteRestante($donnees['quantite']);
            $menu->setTheme($this->getReference('theme_' . $donnees['theme'], Theme::class));
            $menu->setRegime($this->getReference('regime_' . $donnees['regime'], Regime::class));

            foreach ($donnees['plats'] as $titrePlat) {
                $menu->addPlat($this->getReference('plat_' . $titrePlat, Plat::class));
            }

            $manager->persist($menu);
        }

        $manager->flush();
    }

    // Le thème, le régime et les plats doivent exister avant les menus
    public function getDependencies(): array
    {
        return [ThemeFixtures::class, RegimeFixtures::class, PlatFixtures::class];
    }
}
