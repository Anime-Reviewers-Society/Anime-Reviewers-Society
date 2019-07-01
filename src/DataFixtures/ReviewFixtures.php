<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('FR_fr');
        for($index = 0; $index < 10; $index++) {

            $anime = $this->getReference('anime-' . $index);
            $author = $this->getReference('user-' . $index);

            $review = new Review();
            $review
                ->setComment($faker->text)
                ->setNote(4)
                ->setVote($faker->randomNumber())
                ->setAnime($anime)
                ->setDate($faker->dateTime)
                ->setAuthor($author);


            $manager->persist($review);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            AnimeFixtures::class
        );
    }
}