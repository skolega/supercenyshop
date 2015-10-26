<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ProductVariant;

class LoadProductVariantsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 6;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('pl_PL');

        for ($j = 0; $j < 800; $j++) {
            $variant = new ProductVariant();
            $buyValue = $faker->numberBetween(3,60);
            $variant->setAmount($faker->numberBetween(1,30));
            $variant->setBuyValue($buyValue);
            $variant->setColor($faker->colorName);
            $variant->setDescription($faker->sentence(30));
            $variant->setDimensions($faker->numberBetween(1, 50) . 'x' . $faker->numberBetween(1,30));
            $variant->setHeight($faker->numberBetween(4,10));
            $variant->setPacking($faker->numberBetween(1,30));
            $variant->setPrice($buyValue*1,30);
            $variant->setSurfance($faker->word);
            $variant->setWeight($faker->numberBetween(1100,1800));
            $variant->setProduct($this->getReference('product'. $faker->numberBetween(1, 199)));
            $this->addReference('variant'. $j++, $variant);
           

            $manager->persist($variant);
        }
        
	$manager->flush();
    }

}