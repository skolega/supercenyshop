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
        return 4;
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
            $product->setPackage($faker->numberBetween(1, 15));
            $product->setType($faker->numberBetween(1,4));
            $product->setWidth($faker->numberBetween(1,2));
            $product->setWeight($faker->numberBetween(1100, 1900));
            $product->setLength($faker->numberBetween(1,4));
            $product->setHeight($faker->numberBetween(4,8));
            $product->setFacture($faker->word());
            $product->setColor($faker->word());
            $product->setCategory($this->getReference('category' . $faker->numberBetween(1, 11)));
           

            $manager->persist($product);
        }
        
	$manager->flush();
    }

}