<?php

namespace App\DataFixtures;

use App\Entity\Anime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimeFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($index = 0; $index < 20; $index++) {
            $anime = new Anime();
            $anime->setOriginalTitle('Title' . $index)
                ->setTranslatedTitle('FR title' . $index)
                ->setType(1)
                ->setSecondType(4)
                ->setMatureAudience(false);
            $manager->persist($anime);
        }
        $manager->flush();
    }
}