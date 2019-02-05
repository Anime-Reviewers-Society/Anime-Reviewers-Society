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
        for ($index = 0; $index < 10; $index++) {
            $user = new User();
            if($index == 0) {
                $user->setUsername('Admin')
                     ->setPassword($this->passwordEncoder->encodePassword($user, 'admin'))
                     ->setRoles(['ROLE_ADMIN']);
            }
            $user->setUsername('Username #' . $index)
                 ->setPassword($this->passwordEncoder->encodePassword($user, '$argon2i$v=19$m=1024,t=2,p=2$NHcyYzNaa1VxMEZDS3M1Rw$Me9ZEj4N4EHQ5gRgLxqlu0+txSUk/2cAJuu/Ot5sOv0'))
                 ->setRoles(['ROLE_USER']);
            
            $manager->persist($user);
        }
        $manager->flush();
    }
}