<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogBundle\Entity\Tag;

class TagController extends Controller
{

    public function showAction($slug, $page)
    {
        $em = $this->getDoctrine()->getManager();
 
        $tag = $em->getRepository('BlogBundle:Tag')->findOneBySlug($slug);
        
        if (!$tag) {
            throw $this->createNotFoundException('Unable to find Tag entity.');
        }
        
        $total_posts = $em->getRepository('BlogBundle:Post')->countPostsFromTag($tag->getId());
        $posts_per_page = 5;
        $last_page = ceil($total_posts / $posts_per_page);
        $previous_page = $page > 1 ? $page - 1 : 1;
        $next_page = $page < $last_page ? $page + 1 : $last_page;
        
        $tag->setActivePosts($em->getRepository('BlogBundle:Post')->getPostsFromTag($tag->getId(), $posts_per_page, ($page - 1) * $posts_per_page));
        
        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts(); //pobranie wszystkich kategorii, które mają posty
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts(); //pobranie wszystkich tagów, które mają posty
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);
        
        return $this->render('BlogBundle:Tag:show.html.twig', array(
            'tag' => $tag,
            
            'last_page' => $last_page,
            'previous_page' => $previous_page,
            'current_page' => $page,
            'next_page' => $next_page,
            'total_posts' => $total_posts,
            
            'categories' => $categories,
            'tags' => $tags,
            'archives' => $archives,
            'recent_posts' => $recent_posts,
        ));
    }
}