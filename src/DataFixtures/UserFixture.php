<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("tiagorosadacosta");
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$SirJm/yAg9zUuAQnTqwQwQ$cCXnAjfaYLOVcxLS0gw1SIXM5cB3i84UEDITKHqjYBM');
        $manager->persist($user);
        $manager->flush();
    }
}
