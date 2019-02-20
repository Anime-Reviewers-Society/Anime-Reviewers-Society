<?php

namespace App\DataFixtures;

use App\Entity\Target;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TargetFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($index = 0; $index < 6; $index++) {

            $target = new  Target();
            $target->setLabel('Target ' . $index);

            $manager->persist($target);
        }
        $manager->flush();
    }
}
