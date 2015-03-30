<?php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Acme\DemoBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadCategoryData
 *
 * @package Acme\DemoBundle\DataFixtures\ORM
 */
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * load testing data
     *
     * @param ObjectManager $manager manager
     */
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<=10;$i++) {
            $category = new Category();
            $category->setTitle('Category #'.$i);
            $manager->persist($category);
            $this->setReference('category_'.$i, $category);
        }

        $manager->flush();
    }

    /**
     * set the order in which fixtures will be loaded
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
