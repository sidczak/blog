<?php

namespace BlogBundle\Entity;

/**
 * Image
 */
class Image
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $image;
    
    /**
     * @var integer
     */
    private $rank = 1;
    
    /**
     * @var \BlogBundle\Entity\Post
     */
    private $post;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Image
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return Image
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }
    
    /**
     * Set post
     *
     * @param \BlogBundle\Entity\Post $post
     *
     * @return Image
     */
    public function setPost(\BlogBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \BlogBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
