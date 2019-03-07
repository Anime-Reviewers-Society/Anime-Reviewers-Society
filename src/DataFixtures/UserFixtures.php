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
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

/**
 * @property  passwordEncoder
 */
class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($index = 0; $index < 40; $index++) {
            $user = new User();
            $user->setUsername($faker->userName)
                ->setPassword($this->passwordEncoder->encodePassword($user, $faker->password))
                ->setMail($faker->email)
                ->setStatus($faker->boolean);
            $manager->persist($user);
        }
        $manager->flush();
    }
}