<?php

namespace BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogBundle\Entity\Post;
use BlogBundle\Form\PostType;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{

    /**
     * Lists all Post entities.
     *
     */
    public function indexAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        
        //$entities = $em->getRepository('BlogBundle:Post')->findAll();
        
        $posts = $em->getRepository('BlogBundle:Post')->findAll();

        $total_posts = count($posts);
        $posts_per_page = 5;
        $last_page = ceil($total_posts / $posts_per_page);
        $previous_page = $page > 1 ? $page - 1 : 1;
        $next_page = $page < $last_page ? $page + 1 : $last_page;
        
        $repository = $this->getDoctrine()
            ->getRepository('BlogBundle:Post');

        $query = $repository->createQueryBuilder('p')
            ->setFirstResult(($page - 1) * $posts_per_page)
            ->setMaxResults($posts_per_page)
            ->getQuery();

        $entities = $query->getResult();
            
        //$query = $em->createQuery('SELECT c FROM BlogBundle:Category c LEFT JOIN c.posts p WHERE p.category = c.id');
        //$categories = $query->getResult();
        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts(); //pobranie wszystkich kategorii, które mają posty
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts(); //pobranie wszystkich tagów, które mają posty
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);
        
        return $this->render('BlogBundle:Post:index.html.twig', array(
            'entities' => $entities,
            
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
    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Post();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $entity->getId())));
        }

        return $this->render('BlogBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Post entity.
     *
     */
    public function newAction()
    {
        $entity = new Post();
        $form   = $this->createCreateForm($entity);

        return $this->render('BlogBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        
        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts();
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts();
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);

        return $this->render('BlogBundle:Post:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'categories'  => $categories,
            'tags'        =>$tags,
            'archives' => $archives,
            'recent_posts' => $recent_posts,
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BlogBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Post entity.
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
        }

        return $this->render('BlogBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BlogBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    public function archiveAction($year, $month, $page)
    {
        $em = $this->getDoctrine()->getManager();
        
        //$entities = $em->getRepository('BlogBundle:Post')->getPostFromArchives($year, $month);
        
        $posts = $em->getRepository('BlogBundle:Post')->getPostFromArchives($year, $month);
        
        $total_posts = count($posts);
        $posts_per_page = 5;
        $last_page = ceil($total_posts / $posts_per_page);
        $previous_page = $page > 1 ? $page - 1 : 1;
        $next_page = $page < $last_page ? $page + 1 : $last_page;
        
        $entities = $em->getRepository('BlogBundle:Post')->getPostFromArchives($year, $month, $posts_per_page, ($page - 1) * $posts_per_page);
        
        $archive = date("F Y", mktime($month, $year));

        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts();
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts();
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);
        
        return $this->render('BlogBundle:Post:archive.html.twig', array(
            'entities' => $entities, 
            'archive' => $archive,
            
            'year' => $year,
            'month' => $month,
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
    
    public function archivesPageAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts();
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts();
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);
        
        return $this->render('BlogBundle:Archive:index.html.twig', array(
            'categories' => $categories,
            'tags' => $tags,
            'archives' => $archives,
            'recent_posts' => $recent_posts,
        ));
    }
    
    public function authorAction($email, $page)
    {
        $em = $this->getDoctrine()->getManager();
        
        //$entities = $em->getRepository('BlogBundle:Post')->findBy(array('author_email' => $email));
        
        $posts = $em->getRepository('BlogBundle:Post')->findBy(array('author_email' => $email));
        
        $total_posts = count($posts);
        $posts_per_page = 5;
        $last_page = ceil($total_posts / $posts_per_page);
        $previous_page = $page > 1 ? $page - 1 : 1;
        $next_page = $page < $last_page ? $page + 1 : $last_page;
        
        $repository = $this->getDoctrine()
            ->getRepository('BlogBundle:Post');

        $query = $repository->createQueryBuilder('p')
            ->where('p.author_email = :email')
            ->setParameter('email', $email)
            ->setFirstResult(($page - 1) * $posts_per_page)
            ->setMaxResults($posts_per_page)
            ->getQuery();

        $entities = $query->getResult();
                
        $categories = $em->getRepository('BlogBundle:Category')->getWithPosts();
        
        $tags = $em->getRepository('BlogBundle:Tag')->getWithPosts();
        
        $archives = $em->getRepository('BlogBundle:Post')->getArchives();
        
        $recent_posts = $em->getRepository('BlogBundle:Post')->findBy(array(), array(), 10);
        
        return $this->render('BlogBundle:Post:author.html.twig', array(
            'author' => $email,
            'entities' => $entities,
            
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
