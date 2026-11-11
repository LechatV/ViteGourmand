<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Les thèmes donnés dans le sujet
        $libelles = ['Noël', 'Pâques', 'Classique', 'Évènement'];

        foreach ($libelles as $libelle) {
            $theme = new Theme();
            $theme->setLibelle($libelle);
            $manager->persist($theme);

            // Référence pour retrouver ce thème dans MenuFixtures
            $this->addReference('theme_' . $libelle, $theme);
        }

        $manager->flush();
    }
}
