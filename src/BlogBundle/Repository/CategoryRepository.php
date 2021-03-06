<?php

namespace BlogBundle\Repository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function getWithPosts()
    {
        $query = $this->getEntityManager()->createQuery('SELECT c FROM BlogBundle:Category c LEFT JOIN c.posts p WHERE p.category = c.id');

        return $query->getResult();
    }
}
