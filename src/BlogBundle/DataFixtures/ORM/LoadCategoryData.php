<?php
//src/BlogBundle/DataFixtures/ORM/LoadPostData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\Category;
 
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
	    $forum = new Category();
	    $forum->setName('Forum tutorial');
	    $forum->setDescription('Forum Description');
	    $forum->setImage('forum.jpg');
	    $forum->setIsActive(1);
	    
	    $blog = new Category();
	    $blog->setName('Blog tutorial');
	    $blog->setDescription('Blog Description');
	    $blog->setImage('blog.jpg');
	    $blog->setIsActive(1);
	    
	    $shop = new Category();
	    $shop->setName('Shop tutorial');
	    $shop->setDescription('Shop Description');
	    $shop->setImage('shop.jpg');
	    $shop->setIsActive(1);
	    	 
	    $em->persist($forum);
            $em->persist($blog);
	    $em->persist($shop);
	 
	    $em->flush();
            
            $this->addReference('category-forum', $forum);
	    $this->addReference('category-blog', $blog);
	    $this->addReference('category-shop', $shop);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}