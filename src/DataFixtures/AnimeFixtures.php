<?php

namespace App\DataFixtures;

use App\Entity\Anime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AnimeFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($index = 0; $index < 20; $index++) {
            $anime = new Anime();
            $anime->setOriginalTitle($faker->sentence(2, false))
                ->setTranslatedTitle($faker->sentence(2, false))
                ->setImage($faker->imageUrl('600', '300', 'abstract'))
                ->setResume($faker->text)
                ->setReleaseDate($faker->dateTime)
                ->setMatureAudience($faker->boolean);
            $this->addReference('anime-' . $index, $anime);
            $manager->persist($anime);
        }
        $manager->flush();
    }
}