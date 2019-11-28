<?php

namespace BlogAdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BlogBundle\Utils\Blog as Blog;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $excerpt;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $author_email;

    /**
     * @var string
     */
    private $status_post = 'publish';

    /**
     * @var boolean
     */
    private $show_comment = true;

    /**
     * @var boolean
     */
    private $enable_comment = true;

    /**
     * @var integer
     */
    private $views_post;

    /**
     * @var \DateTime
     */
    private $published_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $images;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;

    /**
     * @var \BlogAdminBundle\Entity\Category
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     *
     * @return Post
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set authorEmail
     *
     * @param string $authorEmail
     *
     * @return Post
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->author_email = $authorEmail;

        return $this;
    }

    /**
     * Get authorEmail
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->author_email;
    }

    /**
     * Set statusPost
     *
     * @param string $statusPost
     *
     * @return Post
     */
    public function setStatusPost($statusPost)
    {
        $this->status_post = $statusPost;

        return $this;
    }

    /**
     * Get statusPost
     *
     * @return string
     */
    public function getStatusPost()
    {
        return $this->status_post;
    }

    /**
     * Set showComment
     *
     * @param boolean $showComment
     *
     * @return Post
     */
    public function setShowComment($showComment)
    {
        $this->show_comment = $showComment;

        return $this;
    }

    /**
     * Get showComment
     *
     * @return boolean
     */
    public function getShowComment()
    {
        return $this->show_comment;
    }

    /**
     * Set enableComment
     *
     * @param boolean $enableComment
     *
     * @return Post
     */
    public function setEnableComment($enableComment)
    {
        $this->enable_comment = $enableComment;

        return $this;
    }

    /**
     * Get enableComment
     *
     * @return boolean
     */
    public function getEnableComment()
    {
        return $this->enable_comment;
    }

    /**
     * Set viewsPost
     *
     * @param integer $viewsPost
     *
     * @return Post
     */
    public function setViewsPost($viewsPost)
    {
        $this->views_post = $viewsPost;

        return $this;
    }

    /**
     * Get viewsPost
     *
     * @return integer
     */
    public function getViewsPost()
    {
        return $this->views_post;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->published_at = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add image
     *
     * @param \BlogAdminBundle\Entity\Image $image
     *
     * @return Post
     */
    public function addImage(\BlogAdminBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \BlogAdminBundle\Entity\Image $image
     */
    public function removeImage(\BlogAdminBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add comment
     *
     * @param \BlogAdminBundle\Entity\Comment $comment
     *
     * @return Post
     */
    public function addComment(\BlogAdminBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \BlogAdminBundle\Entity\Comment $comment
     */
    public function removeComment(\BlogAdminBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set category
     *
     * @param \BlogAdminBundle\Entity\Category $category
     *
     * @return Post
     */
    public function setCategory(\BlogAdminBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BlogAdminBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add tag
     *
     * @param \BlogAdminBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\BlogAdminBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \BlogAdminBundle\Entity\Tag $tag
     */
    public function removeTag(\BlogAdminBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * @ORM\PrePersist
     */
    public function setPublishedAtValue()
    {
        // Add your code here
        if(!$this->getPublishedAt())
        {
            $this->published_at = new \DateTime();
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        // Add your code here
        $this->slug = Blog::slugify($this->getTitle());
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
        $this->updated_at = new \DateTime();
    }
    
    /**
     * @var string
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'bundles/blog/images/';
    }
    
    private $file_rename;
    
    public function setFileRename()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->file_rename = $filename.'.'.$this->getFile()->guessExtension();
        }
    }
 
    public function getFileRename()
    {
        return $this->file_rename;
    }
    
    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            //$this->getFile()->getClientOriginalName()
            $this->getFileRename()
            //$this->path
        );

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
    
    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
    	foreach ($this->getImages() as $img) {
    	    $file = $this->getUploadRootDir().'/'.$img->getImage();

	    	if (file_exists($file)) {
	        	unlink($file);
	    	}
    	}
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new NotBlank());
        $metadata->addPropertyConstraint('content', new NotBlank());
        $metadata->addPropertyConstraint('author_email', new NotBlank());
        $metadata->addPropertyConstraint('author_email', new Assert\Email(array(
            'message' => 'The email "{{ value }}" is not a valid email.',
            'checkMX' => true,
        )));
        $metadata->addPropertyConstraint('file', new Assert\Image());
    }
}
