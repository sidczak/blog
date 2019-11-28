<?php
//src/BlogBundle/DataFixtures/ORM/LoadPostData.php

namespace BlogBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use BlogBundle\Entity\Post;
 
class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        
	    $post_blog = new Post();
            $post_blog->setCategory($em->merge($this->getReference('category-blog'))); //manyToOne
	    $post_blog->setTitle('Learn the Bootstrap Grid in <b>15 Minutes</b>');
            $post_blog->setExcerpt($this->getPostExcerpt());
            $post_blog->setContent($this->getPostContent());
            //$post_blog->setExcerpt('Bootstrap is the most widely used frontend framework right now.');
            //$post_blog->setContent('Bootstrap is the most widely used frontend framework right now. When it comes to building responsive websites and apps, it’s the first choice of both professionals and hobbyists because of how simple it is to work with. Anybody who knows HTML, CSS and a bit of JavaScript can learn Bootstrap in no time.');
            $post_blog->setAuthorEmail('admin@symfony.com');
            $post_blog->setViewsPost(10);
            $post_blog->addTag($em->merge($this->getReference('tag-html'))); //manyToMany
            $post_blog->addTag($em->merge($this->getReference('tag-css'))); //manyToMany
            $post_blog->setPublishedAt(new \DateTime('now - 1 days'));
            
            $post_shop = new Post();
            $post_shop->setCategory($em->merge($this->getReference('category-shop'))); //manyToOne
	    $post_shop->setTitle('How to Control <b>YouTube Video Player</b> with jQuery');
            $post_shop->setExcerpt($this->getPostExcerpt());
            $post_shop->setContent($this->getPostContent());
            //$post_shop->setExcerpt('YouTube has become the standard way for delivering high quality video on the web.');
            //$post_shop->setContent('YouTube has become the standard way for delivering high quality video on the web. Sometimes, when you embed a video in your web application or landing page, you need a great deal of control on what and how is displayed. This is why we are going to show you how you can use the YouTube JavaScript Player API.');
            $post_shop->setAuthorEmail('journalist@symfony.com');
            $post_shop->setViewsPost(5);
            $post_shop->addTag($em->merge($this->getReference('tag-html'))); //manyToMany
            $post_shop->addTag($em->merge($this->getReference('tag-php'))); //manyToMany
            $post_shop->addTag($em->merge($this->getReference('tag-ajax'))); //manyToMany
            $post_shop->setPublishedAt(new \DateTime('now - 1 days'));
            
            $em->persist($post_blog);
            $em->persist($post_shop);
            
            foreach (range(0, 30) as $i) {
                $post = new Post();
                
                $post->setCategory($this->getRandomCategory($em)); //manyToOne
                $post->setTitle($this->getRandomTitle($i));
                $post->setExcerpt($this->getPostExcerpt());
                $post->setContent($this->getPostContent());
                $post->setAuthorEmail($this->getRandomAuthorEmail());
                $post->setViewsPost(rand(0, 15));
                $post->setPublishedAt(new \DateTime('now -'.(5 + $i).'days'));
                
                foreach($this->getRandomTag($em) as $tag){
                    $post->addTag($tag); //manyToMany
                }
                
                $em->persist($post);
                $this->addReference('post-post'.$i, $post);
            }
	 
	    $em->flush();
            
            $this->addReference('post-blog', $post_blog);
            $this->addReference('post-shop', $post_shop);
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
    
    private function getPhrases()
    {
        return array(
            'Lorem ipsum dolor sit amet consectetur adipiscing elit',
            'Pellentesque vitae velit ex',
            'Mauris dapibus risus quis suscipit vulputate',
            'Eros diam egestas libero eu vulputate risus',
            'In hac habitasse platea dictumst',
            'Morbi tempus commodo mattis',
            'Ut suscipit posuere justo at vulputate',
            'Ut eleifend mauris et risus ultrices egestas',
            'Aliquam sodales odio id eleifend tristique',
            'Urna nisl sollicitudin id varius orci quam id turpis',
            'Nulla porta lobortis ligula vel egestas',
            'Curabitur aliquam euismod dolor non ornare',
            'Sed varius a risus eget aliquam',
            'Nunc viverra elit ac laoreet suscipit',
            'Pellentesque et sapien pulvinar consectetur',
        );
    }

    private function getRandomTitle($i)
    {
        $titles = $this->getPhrases();
        
        if (!isset($titles[$i])) {
            return $titles[array_rand($titles)].' '.$i;
        } else {
            return $titles[$i];
        }
        //return $titles[$i];
        //return $titles[array_rand($titles)].' '.$i;
    }
    
    private function getRandomAuthorEmail()
    {
        
        $email = array(
            'admin@symfony.com',
            'editor@symfony.com',
            'journalist@symfony.com',
        );

        return $email[array_rand($email)];
    }
    
    private function getRandomCategory($em)
    {
        $category = array(
            $em->merge($this->getReference('category-forum')),
            $em->merge($this->getReference('category-blog')),
            $em->merge($this->getReference('category-shop')),
        );

        return $category[array_rand($category)];
    }
    
    private function getRandomTag($em)
    {
        $tag = array(
            $em->merge($this->getReference('tag-html')),
            $em->merge($this->getReference('tag-css')),
            $em->merge($this->getReference('tag-jquery')),
            $em->merge($this->getReference('tag-php')),
            $em->merge($this->getReference('tag-ajax')),
            $em->merge($this->getReference('tag-symfony')),
            $em->merge($this->getReference('tag-bootstrap')),
        );

        shuffle($tag);

        return array_slice($tag, 0, rand(1, 3));
    }
    
    private function getPostExcerpt()
    {
        $phrases = $this->getPhrases();

        $numPhrases = rand(6, 12);
        shuffle($phrases);

        return implode(' ', array_slice($phrases, 0, $numPhrases-1));
    }
    
    private function getPostContent()
    {
        return <<<MARKDOWN
Lorem <b>ipsum dolor sit</b> amet consectetur adipisicing elit, sed do eiusmod tempor
incididunt ut labore et **dolore magna aliqua**: Duis aute irure dolor in
reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
deserunt mollit anim id est laborum.

  * Ut enim ad minim veniam
  * Quis nostrud exercitation *ullamco laboris*
  * Nisi ut aliquip ex ea commodo consequat

Praesent <i>id fermentum lorem</i>. Ut est lorem, fringilla at accumsan nec, euismod at
nunc. Aenean mattis sollicitudin mattis. Nullam pulvinar vestibulum bibendum.
Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
himenaeos. Fusce nulla purus, gravida ac interdum ut, blandit eget ex. Duis a
luctus dolor.

Integer auctor massa maximus nulla scelerisque accumsan. *Aliquam ac malesuada*
ex. <b>Pellentesque tortor magna</b>, vulputate eu vulputate ut, venenatis ac lectus.
Praesent ut lacinia sem. Mauris a lectus eget felis mollis feugiat. Quisque
efficitur, mi ut semper pulvinar, urna urna blandit massa, eget tincidunt augue
nulla vitae est.

Ut posuere aliquet tincidunt. Aliquam erat volutpat. **Class aptent taciti**
sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi
arcu orci, <b>gravida eget aliquam eu</b>, suscipit et ante. Morbi vulputate metus vel
ipsum finibus, ut dapibus massa feugiat. Vestibulum vel lobortis libero. Sed
tincidunt tellus et viverra scelerisque. Pellentesque tincidunt cursus felis.
Sed in egestas erat.

<b>Aliquam pulvinar interdum massa</b>, vel ullamcorper ante consectetur eu. Vestibulum
lacinia ac enim vel placerat. Integer pulvinar magna nec dui malesuada, nec
congue nisl dictum. Donec mollis nisl tortor, at congue erat consequat a. Nam
tempus elit porta, blandit elit vel, viverra lorem. Sed sit amet tellus
tincidunt, faucibus nisl in, aliquet libero.
MARKDOWN;
    }
    
}