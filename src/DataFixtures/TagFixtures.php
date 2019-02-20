<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\Target;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($index = 0; $index < 15; $index++) {

            $tag = new  Tag();
            $tag->setLabel('Tag ' . $index);

            $manager->persist($tag);
        }
        $manager->flush();
    }
}
