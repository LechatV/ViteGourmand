<?php

namespace App\DataFixtures;

use App\Entity\Allergene;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AllergeneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Les allergènes classiques
        $libelles = ['Gluten', 'Lait', 'Oeufs', 'Poissons', 'Crustacés', 'Mollusques'];

        foreach ($libelles as $libelle) {
            $allergene = new Allergene();
            $allergene->setLibelle($libelle);
            $manager->persist($allergene);

            // Référence pour retrouver cet allergène dans PlatFixtures
            $this->addReference('allergene_' . $libelle, $allergene);
        }

        $manager->flush();
    }
}
