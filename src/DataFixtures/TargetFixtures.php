<?php

namespace App\DataFixtures;

use App\Entity\Target;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TargetFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($index = 0; $index < 6; $index++) {

            $target = new Target();
            $target->setLabel($faker->name);

            $manager->persist($target);
        }
        $manager->flush();
    }
}
