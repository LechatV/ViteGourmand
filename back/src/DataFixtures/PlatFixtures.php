<?php

namespace App\DataFixtures;

use App\Entity\Allergene;
use App\Entity\Plat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlatFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // les plats avec leurs allergènes, et la photo pour les plats principaux
        $plats = [
            ['titre' => 'Terrine de campagne', 'allergenes' => ['Oeufs'], 'photo' => null],
            ['titre' => 'Sauté de boeuf et écrasé de pommes de terre', 'allergenes' => ['Lait'], 'photo' => 'menu_tradition.jpg'],
            ['titre' => 'Crumble aux pommes et caramel', 'allergenes' => ['Gluten', 'Lait'], 'photo' => null],
            ['titre' => 'Gambas poêlées', 'allergenes' => ['Crustacés'], 'photo' => null],
            ['titre' => "Dos de cabillaud au beurre blanc à l'orange", 'allergenes' => ['Poissons', 'Lait'], 'photo' => 'menu_pecheur.jpg'],
            ['titre' => 'Tarte fine poire chocolat', 'allergenes' => ['Gluten', 'Lait', 'Oeufs'], 'photo' => null],
            ['titre' => 'Bruschetta poivrons et aubergines', 'allergenes' => ['Gluten'], 'photo' => null],
            ['titre' => 'Brochettes mixtes', 'allergenes' => [], 'photo' => 'menu_grillades.jpg'],
            ['titre' => 'Fondant chocolat et crème anglaise', 'allergenes' => ['Gluten', 'Lait', 'Oeufs'], 'photo' => null],
            ['titre' => 'Tataki de thon', 'allergenes' => ['Poissons'], 'photo' => 'menu_prestige.jpg'],
            ['titre' => 'Saint-Jacques, patate douce et poireau', 'allergenes' => ['Mollusques', 'Lait'], 'photo' => null],
            ['titre' => 'Cheesecake et coulis de figues', 'allergenes' => ['Gluten', 'Lait', 'Oeufs'], 'photo' => null],
        ];

        foreach ($plats as $donnees) {
            $plat = new Plat();
            $plat->setTitrePlat($donnees['titre']);
            $plat->setPhoto($donnees['photo']);

            foreach ($donnees['allergenes'] as $allergene) {
                $plat->addAllergene($this->getReference('allergene_' . $allergene, Allergene::class));
            }

            $manager->persist($plat);
            $this->addReference('plat_' . $donnees['titre'], $plat);
        }

        $manager->flush();
    }

    // Les allergènes doivent exister avant les plats
    public function getDependencies(): array
    {
        return [AllergeneFixtures::class];
    }
}
