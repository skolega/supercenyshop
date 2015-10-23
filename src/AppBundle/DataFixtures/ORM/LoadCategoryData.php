<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    { 
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $categoriesNames = [
            'Kostka brukowa',
            'Obrzeże',
            'Krawężnik',
            'Palisada',
            'Korytka ściekowe',
            'Narzędzia',
            'Kruszywa',
            'Gazony',
            'Galanteria Betonowa',
            'Ogrodzenia',
            'Odwodnienia' 
        ];
        
        $i = 1;
        foreach ($categoriesNames as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $this->addReference('category'. $i++, $category);
            $manager->persist($category);
        }

        $manager->flush();
    }
}