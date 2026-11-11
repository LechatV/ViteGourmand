<?php

namespace App\DataFixtures;

use App\Entity\Regime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RegimeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Les régimes donnés dans le sujet
        $libelles = ['Classique', 'Végétarien', 'Vegan'];

        foreach ($libelles as $libelle) {
            $regime = new Regime();
            $regime->setLibelle($libelle);
            $manager->persist($regime);

            // Référence pour retrouver ce régime dans MenuFixtures
            $this->addReference('regime_' . $libelle, $regime);
        }

        $manager->flush();
    }
}
