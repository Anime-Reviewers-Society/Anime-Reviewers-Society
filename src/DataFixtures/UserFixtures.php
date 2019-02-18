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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        for ($index = 0; $index < 40; $index++) {
            $user = new User();
            if($index == 9) {
                $user->setUsername('Admin')
                     ->setPassword($this->passwordEncoder->encodePassword($user, 'admin'))
                    ->setMail('admin.mail@test.test')
                    ->setStatus(false)
                     ->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setUsername('Username #' . $index)
                    ->setPassword($this->passwordEncoder->encodePassword($user, 'userpass'))
                    ->setMail('user.mail@test.test')
                    ->setStatus(true)
                    ->setRoles(['ROLE_USER']);
            }
            $manager->persist($user);
        }
        $manager->flush();
    }
}