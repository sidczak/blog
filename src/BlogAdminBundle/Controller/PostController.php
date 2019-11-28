<?php

namespace BlogAdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogAdminBundle\Entity\Post;
use BlogAdminBundle\Form\PostType;
use BlogAdminBundle\Entity\Image;
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

        $posts = $em->getRepository('BlogAdminBundle:Post')->findAll();
        //$entities = $em->getRepository('BlogAdminBundle:Post')->findBy(array(), array('published_at' => 'DESC'));
    
        $total_posts = count($posts);
        $posts_per_page = 5;
		
        $last_page = ceil($total_posts / $posts_per_page);
        $previous_page = $page > 1 ? $page - 1 : 1;
        $next_page = $page < $last_page ? $page + 1 : $last_page;
        
        $entities = $em->getRepository('BlogAdminBundle:Post');
		
        $query = $entities->createQueryBuilder('p')
            ->setMaxResults($posts_per_page)
            ->setFirstResult(($page - 1) * $posts_per_page)
            ->getQuery();
		
        $entities = $query->getResult();

        return $this->render('BlogAdminBundle:Post:index.html.twig', array(
            'entities' => $entities,
            'last_page' => $last_page,
            'previous_page' => $previous_page,
            'current_page' => $page,
            'next_page' => $next_page,
            'total_posts' => $total_posts,
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
            
            if ($entity->getFile()) {
                
                $entity->setFileRename();
                
                $img = new Image();
                //$img->setImage($entity->getFile()->getClientOriginalName());
                $img->setImage($entity->getFileRename());
                $img->setPost($entity);
                $rank = $em->getRepository('BlogAdminBundle:Image')->getMaxRank($id);
                if ($rank) {
                    $img->setRank($rank['rank'] + 1);
                }
                $em->persist($img);
            }
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_post_show', array('id' => $entity->getId())));
        }

        return $this->render('BlogAdminBundle:Post:new.html.twig', array(
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
            'action' => $this->generateUrl('admin_post_create'),
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

        return $this->render('BlogAdminBundle:Post:new.html.twig', array(
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

        $entity = $em->getRepository('BlogAdminBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BlogAdminBundle:Post:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogAdminBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        $max_rank = $em->getRepository('BlogAdminBundle:Image')->getMaxRank($id);
        
        return $this->render('BlogAdminBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'max_rank' => $max_rank,
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
            'action' => $this->generateUrl('admin_post_update', array('id' => $entity->getId())),
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

        $entity = $em->getRepository('BlogAdminBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            if ($entity->getFile()) {
                
                $entity->setFileRename();
                
                $img = new Image();
                //$img->setImage($entity->getFile()->getClientOriginalName());
                $img->setImage($entity->getFileRename());
                $img->setPost($entity);
                
                /*$repository = $this->getDoctrine()
                    ->getRepository('BlogBundle:Image');

                $query = $repository->createQueryBuilder('i')
                    ->select('MAX(i.rank) as rank')
                    ->where('i.post = :post_id')
                    ->setParameter('post_id', $id)
                    ->getQuery();
                
                $rank = $query->getSingleResult();*/
                
                $rank = $em->getRepository('BlogAdminBundle:Image')->getMaxRank($id);
                if ($rank) {
                    $img->setRank($rank['rank'] + 1);
                }
                
                $em->persist($img);
            }
            
            $em->flush();

            return $this->redirect($this->generateUrl('admin_post_edit', array('id' => $id)));
        }

        return $this->render('BlogAdminBundle:Post:edit.html.twig', array(
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
            $entity = $em->getRepository('BlogAdminBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_post'));
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
            ->setAction($this->generateUrl('admin_post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    public function removeAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogAdminBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        
        $em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('admin_post'));
    }
    
    public function showCommentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogAdminBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        
        if(!$entity->getShowComment()) {
	      $entity->setShowComment(true);
	      //$entity->save();
	    }
	    else {
	      $entity->setShowComment(false);
	      //$entity->save();
	    }
        
	    //!$entity->getShowComment() ? $entity->setShowComment(true) : $entity->setShowComment(false);
	    
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_post'));
    }
    
    public function enableCommentAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogAdminBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        
        if(!$entity->getEnableComment()) {
	      $entity->setEnableComment(true);
	      //$entity->save();
	    }
	    else {
	      $entity->setEnableComment(false);
	      //$entity->save();
	    }
        
	    //!$entity->getEnableComment() ? $entity->setEnableComment(true) : $entity->setEnableComment(false);
	    
        $em->persist($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_post'));
    }
    
    public function removeImageAction(Request $request, $id, $img)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogAdminBundle:Image')->find($img);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }
        
        $em->remove($entity);
        $em->flush();
        
        $images = $em->getRepository('BlogAdminBundle:Image')->updateRank($id);
        if ($images) {
            $rank = 0;
            foreach ($images as $image) {
                $image->setRank(++$rank);
                $em->persist($image);
            }
        }
        $em->flush();
        
        return $this->redirect($this->generateUrl('admin_post_edit', array('id' => $id)));
    }
    
    public function upImageAction(Request $request, $id, $img)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogAdminBundle:Image')->find($img);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $rank = $entity->getRank();
        
        $repository = $this->getDoctrine()
            ->getRepository('BlogBundle:Image');

        $query = $repository->createQueryBuilder('i')
            ->where('i.rank = :rank')
            ->setParameter('rank', $rank - 1)
            ->andWhere('i.post = :post_id')
            ->setParameter('post_id', $id)
            ->getQuery();

        $image = $query->getSingleResult();
        $image->setRank($rank);

        $entity->setRank($rank - 1);
        
        $em->persist($entity);
        $em->persist($image);
        $em->flush();
        
        return $this->redirect($this->generateUrl('admin_post_edit', array('id' => $id)));
    }
    
    public function downImageAction(Request $request, $id, $img)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogAdminBundle:Image')->find($img);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Image entity.');
        }

        $rank = $entity->getRank();
        
        $repository = $this->getDoctrine()
            ->getRepository('BlogBundle:Image');

        $query = $repository->createQueryBuilder('i')
            ->where('i.rank = :rank')
            ->setParameter('rank', $rank + 1)
            ->andWhere('i.post = :post_id')
            ->setParameter('post_id', $id)
            ->getQuery();

        $image = $query->getSingleResult();
        $image->setRank($rank);

        $entity->setRank($rank + 1);
        
        $em->persist($entity);
        $em->persist($image);
        $em->flush();
        
        return $this->redirect($this->generateUrl('admin_post_edit', array('id' => $id)));
    }
    
    public function sortImageAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        if ($request->isXmlHttpRequest()) {
            
            parse_str($this->getRequest()->get('images_list'), $images);
            
            foreach ($images['item-image'] as $key => $image_id) {
                $entity = $em->getRepository('BlogAdminBundle:Image')->find($image_id);
                $entity->setRank($key + 1);
                $em->persist($entity);
            }
            
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('admin_post_show', array('id' => $id)));
    }
}
