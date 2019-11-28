<?php
//src/BlogBundle/DataFixtures/ORM/LoadTagData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\Tag;
 
class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
	    $html = new Tag();
	    $html->setName('HTML 5');
	    $html->setDescription('Description HTML 5');
	    
	    $css = new Tag();
	    $css->setName('CSS 3');
	    $css->setDescription('Description CSS 3');
	    
	    $jquery = new Tag();
	    $jquery->setName('jQuery');
	    $jquery->setDescription('Description jQuery');
            
            $php = new Tag();
	    $php->setName('PHP');
	    $php->setDescription('Description PHP');
            
            $ajax = new Tag();
	    $ajax->setName('AJAX');
	    $ajax->setDescription('Description AJAX');
            
            $symfony = new Tag();
	    $symfony->setName('Symfony 2');
	    $symfony->setDescription('Description Symfony 2');
            
            $bootstrap = new Tag();
	    $bootstrap->setName('Bootstrap');
	    $bootstrap->setDescription('Description Bootstrap');
	    	 
	    $em->persist($html);
            $em->persist($css);
	    $em->persist($jquery);
            $em->persist($php);
            $em->persist($ajax);
            $em->persist($symfony);
            $em->persist($bootstrap);
	 
	    $em->flush();
            
            $this->addReference('tag-html', $html);
	    $this->addReference('tag-css', $css);
	    $this->addReference('tag-jquery', $jquery);
            $this->addReference('tag-php', $php);
            $this->addReference('tag-ajax', $ajax);
            $this->addReference('tag-symfony', $symfony);
            $this->addReference('tag-bootstrap', $bootstrap);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}