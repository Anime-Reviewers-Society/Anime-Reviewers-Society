<?php
/**
 * Created by PhpStorm.
 * User: 33623
 * Date: 30/01/2019
 * Time: 22:49
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($index = 0; $index < 10; $index++) {
            $user = new User();
            $user->setNickname('Nickname #' . $index)
                ->setMail('email.' . $index . '@' . 'thisisatest.test')
                ->setAvatar('https://via.placeholder.com/150')
                ->setStatus(true);
            $manager->persist($user);
        }
        $manager->flush();
    }
}