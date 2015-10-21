<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('pl_PL');

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail($faker->email);
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->addRole('ROLE_ADMIN');

        $this->addReference('admin', $user);
        $manager->persist($user);


        for ($j = 1; $j <= 10; $j++) {
            $user = new User();
            $user->setUsername('user'.$j);
            $user->setEmail($faker->email);
            $user->setPlainPassword('demo');
            $user->setEnabled(true);

            $this->addReference('user_'.$j, $user);
            $manager->persist($user);
        }

	$manager->flush();
    }
}