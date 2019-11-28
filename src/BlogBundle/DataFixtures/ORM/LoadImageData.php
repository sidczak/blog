<?php
//src/BlogBundle/DataFixtures/ORM/LoadImageData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\Image;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
	    
	    $img_blog_1 = new Image();
            $img_blog_1->setPost($em->merge($this->getReference('post-blog')));
	    $img_blog_1->setImage('porsche-cayman-gt4-950x530-lg.jpg');
            $img_blog_1->setRank(1);
            $img_blog_2 = new Image();
            $img_blog_2->setPost($em->merge($this->getReference('post-blog')));
	    $img_blog_2->setImage('porsche-cayman-gt4-950x530-2-lg.jpg');
            $img_blog_2->setRank(3);
            $img_blog_3 = new Image();
            $img_blog_3->setPost($em->merge($this->getReference('post-blog')));
	    $img_blog_3->setImage('porsche-cayman-gt4-950x530-3-lg.jpg');
            $img_blog_3->setRank(2);
            $img_blog_4 = new Image();
            $img_blog_4->setPost($em->merge($this->getReference('post-blog')));
	    $img_blog_4->setImage('porsche-cayman-gt4-950x530-4-lg.jpg');
            $img_blog_4->setRank(4);
            
	    $em->persist($img_blog_1);
            $em->persist($img_blog_2);
            $em->persist($img_blog_3);
            $em->persist($img_blog_4);
            
	    $img_shop_1 = new Image();
	    $img_shop_1->setPost($em->merge($this->getReference('post-shop')));
	    $img_shop_1->setImage('range-rover-sport-950x530-lg.jpg');
            $img_shop_1->setRank(1);
            $img_shop_2 = new Image();
	    $img_shop_2->setPost($em->merge($this->getReference('post-shop')));
	    $img_shop_2->setImage('range-rover-sport-950x530-2-lg.jpg');
            $img_shop_2->setRank(3);
            $img_shop_3 = new Image();
	    $img_shop_3->setPost($em->merge($this->getReference('post-shop')));
	    $img_shop_3->setImage('range-rover-sport-950x530-3-lg.jpg');
            $img_shop_3->setRank(2);
            
	    $em->persist($img_shop_1);
            $em->persist($img_shop_2);
            $em->persist($img_shop_3);
            
            foreach (range(0, 30) as $i) { //mamy 30 postów dlatego rand(0, 30)
                             
                $random_image = $this->getRandomImage();
                
                if ($random_image) {
                    $img = new Image();

                    $post = $this->getReference('post-post'.$i);
                    $img->setPost($em->merge($post));
                    $img->setImage($random_image);
                    $img->setRank(1);
                }
                /*
                switch ($post->getCategory()) {
                    case $this->getReference('category-blog'):
                        $img->setImage('porsche-cayman-gt4-950x530-lg.jpg');
                        break;
                    case $this->getReference('category-shop'):
                        $img->setImage('range-rover-sport-950x530-lg.jpg');
                        break;
                    default:
                       $img->setImage(null);
                }
                */
                $em->persist($img);
            }
            
	 
	    $em->flush();
    }
        
    private function getRandomImage()
    {
        
        $image = array(
            'aston-martin-vantage-950x530-lg.jpg',
            'bmw-coupe-950x530-lg.jpg',
            'mercedes-coupe-950x530-lg.jpg',
            'porsche-911-gt3-950x530-lg.jpg',
            'porsche-cayman-gt4-950x530-lg.jpg',
            'range-rover-sport-950x530-lg.jpg',
            null,
        );

        return $image[array_rand($image)];
    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
    
}