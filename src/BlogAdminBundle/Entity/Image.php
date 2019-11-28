<?php

namespace BlogAdminBundle\Entity;

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
     * @var \BlogAdminBundle\Entity\Post
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
     * @param \BlogAdminBundle\Entity\Post $post
     *
     * @return Image
     */
    public function setPost(\BlogAdminBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \BlogAdminBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
    
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'bundles/blog/images/';
    }
    
    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
    	$file = $this->getUploadRootDir().'/'.$this->getImage();

	    if (file_exists($file)) {
	    	unlink($file);
	    }
    }
}
