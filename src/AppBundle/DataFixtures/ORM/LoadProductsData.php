<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;

class LoadProductsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 3;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('pl_PL');

        for ($j = 0; $j < 200; $j++) {
            $product = new Product();
            $product->setName($faker->sentence(2));
            $product->setDescription($faker->text());
            $product->setPrice($faker->numberBetween(50, 999));
            $product->setAmount($faker->numberBetween(0, 20));
            $product->setCategory($this->getReference('category' . $faker->numberBetween(1, 11)));

            $manager->persist($product);
        }
        
	$manager->flush();
    }

}