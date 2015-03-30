<?php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Acme\DemoBundle\Entity\Category;
use Acme\DemoBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class LoadPostData
 *
 * @package Acme\DemoBundle\DataFixtures\ORM
 */
class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * load testing data
     *
     * @param ObjectManager $manager manager
     */
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<=10;$i++) {
            $post = new Post();
            $post->setTitle('Post #'.$i);
            $post->setContent('Post #'.$i.' content');
            $post->setCategory($this->getReference('category_'.$i));
            $manager->persist($post);
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
        return 2;
    }
}
