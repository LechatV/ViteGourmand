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
        // nom du plat => ses allergènes
        $plats = [
            'Terrine de campagne' => ['Oeufs'],
            'Sauté de boeuf et écrasé de pommes de terre' => ['Lait'],
            'Crumble aux pommes et caramel' => ['Gluten', 'Lait'],
            'Gambas poêlées' => ['Crustacés'],
            "Dos de cabillaud au beurre blanc à l'orange" => ['Poissons', 'Lait'],
            'Tarte fine poire chocolat' => ['Gluten', 'Lait', 'Oeufs'],
            'Bruschetta poivrons et aubergines' => ['Gluten'],
            'Brochettes mixtes' => [],
            'Fondant chocolat et crème anglaise' => ['Gluten', 'Lait', 'Oeufs'],
            'Tataki de thon' => ['Poissons'],
            'Saint-Jacques, patate douce et poireau' => ['Mollusques', 'Lait'],
            'Cheesecake et coulis de figues' => ['Gluten', 'Lait', 'Oeufs'],
        ];

        foreach ($plats as $titre => $allergenes) {
            $plat = new Plat();
            $plat->setTitrePlat($titre);

            foreach ($allergenes as $allergene) {
                $plat->addAllergene($this->getReference('allergene_' . $allergene, Allergene::class));
            }

            $manager->persist($plat);
            $this->addReference('plat_' . $titre, $plat);
        }

        $manager->flush();
    }

    // Les allergènes doivent exister avant les plats
    public function getDependencies(): array
    {
        return [AllergeneFixtures::class];
    }
}
