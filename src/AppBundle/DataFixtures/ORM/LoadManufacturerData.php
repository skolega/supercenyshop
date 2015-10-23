<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Manufacturer;

class LoadManufacturerData extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 3;
    }

    public function load(ObjectManager $manager) {
        $manufactureNames = [
            'Polbruk',
            'Libet',
            'Jadar',
            'Buszrem',
            'Bruk',
            'Kost-Bet',
            'Chyż-Bet',
            'BDO',
            'Talbud',
            'Drewbet',
            'Bruk-Bet',
        ];

        $faker = \Faker\Factory::create('pl_PL');

        $i = 1;
        foreach ($manufactureNames as $manufactureName) {
            $manufacturer = new Manufacturer();
            $manufacturer->setName($manufactureName);
            $manufacturer->setCity($faker->city);
            $manufacturer->setEmail($faker->email);
            $manufacturer->setNumber($faker->numberBetween(1, 150));
            $manufacturer->setPostCode($faker->postcode);
            $manufacturer->setStreet($faker->streetName);
            $manufacturer->setImageName('http://placehold.it/440x200');
            $manufacturer->setUpdatedAt($faker->dateTimeThisMonth);
            $manufacturer->setTelNumber($faker->phoneNumber);
            $this->addReference('manufacturer' . $i++, $manufacturer);
            $manager->persist($manufacturer);
        }

        $manager->flush();
    }

}
