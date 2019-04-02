<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class BadgeFixtures extends Fixture
{
    public function load(ObjectManager $objectManager)
    {
        $faker = Faker\Factory::create('FR_fr');
        for($index = 0; $index < 10; $index++) {
            $badge = new Badge();
            $badge  
                ->setLabel($faker->title)
                ->setDescription($faker->text)
                ->setImage($faker->imageUrl('600', '300', 'abstract'));
            $objectManager->persist($badge);
        }
        $objectManager->flush();
    }   
}