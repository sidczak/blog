<?php
//src/BlogBundle/DataFixtures/ORM/LoadPostData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
 
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $em)
    {

        $passwordEncoder = $this->container->get('security.password_encoder');
        
        $johnUser = new User();
        $johnUser->setUsername('john_user');
        $johnUser->setEmail('john_user@symfony.com');
        #$johnUser->setPassword('kitten');
        $encodedPassword = $passwordEncoder->encodePassword($johnUser, 'kitten');
        $johnUser->setPassword($encodedPassword);
        $johnUser->setRoles(array('ROLE_USER'));

        $annaAdmin = new User();
        $annaAdmin->setUsername('anna_admin');
        $annaAdmin->setEmail('anna_admin@symfony.com');
        #$annaAdmin->setPassword('kitten');
        $encodedPassword = $passwordEncoder->encodePassword($annaAdmin, 'kitten');
        $annaAdmin->setPassword($encodedPassword);
        $annaAdmin->setRoles(array('ROLE_ADMIN'));
        $annaAdmin->setIsActive(true);

        $em->persist($johnUser);
        $em->persist($annaAdmin);

        $em->flush();

    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}