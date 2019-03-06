<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TagFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($index = 0; $index < 15; $index++) {

            $tag = new Tag();
            $tag->setLabel($faker->name);

            $manager->persist($tag);
        }
        $manager->flush();
    }
}
