<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ProductType;

class LoadProductTypeData extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 4;
    }

    public function load(ObjectManager $manager) {
        $productTypes = [
            'Pojedyńczy Produkt',
            'Produkt z wariantami',
        ];

        $faker = \Faker\Factory::create('pl_PL');

        $i = 1;
        foreach ($productTypes as $productType) {
            $type = new ProductType();
            $type->setLp($i);
            $type->setName($productType);
            $type->setDescription($i);
            $this->addReference('productType' . $i++, $type);
            $manager->persist($type);
        }

        $manager->flush();
    }

}
