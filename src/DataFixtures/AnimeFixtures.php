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
            $anime->setOriginalTitle('Title ' . $index)
                ->setTranslatedTitle('FR title ' . $index)
                ->setResume('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras venenatis auctor odio.
                 Vestibulum finibus ipsum a mollis aliquet. In malesuada bibendum augue, at consequat nibh auctor nec.
                  Sed id elit eget neque finibus aliquam sollicitudin et nibh. Curabitur commodo iaculis pulvinar.
                   Ut porta tempor ante ac commodo. Praesent vel nibh ex. Vivamus bibendum ultricies sapien.
                    Proin mattis ultricies ante sed venenatis. Aenean libero magna, condimentum vel imperdiet at,
                     mattis eget eros. Etiam et scelerisque diam, quis rutrum lorem. Proin sit amet eleifend sem,
                      eu condimentum elit. Phasellus condimentum nibh quis turpis dictum aliquam.
                 Fusce laoreet ipsum magna, vel maximus lectus euismod id. Aliquam diam elit, posuere vitae est nec,
                  suscipit viverra dolor.')
                ->setReleaseDate(new \DateTime('2011-01-01'))
                ->setType(1)
                ->setSecondType(4)
                ->setMatureAudience(false);
            $manager->persist($anime);
        }
        $manager->flush();
    }
}