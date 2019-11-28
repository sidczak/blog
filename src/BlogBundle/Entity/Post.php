<?php

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BlogBundle\Utils\Blog as Blog;

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
     * @var \BlogBundle\Entity\Category
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
     * @param \BlogBundle\Entity\Image $image
     *
     * @return Post
     */
    public function addImage(\BlogBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \BlogBundle\Entity\Image $image
     */
    public function removeImage(\BlogBundle\Entity\Image $image)
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
     * @param \BlogBundle\Entity\Comment $comment
     *
     * @return Post
     */
    public function addComment(\BlogBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \BlogBundle\Entity\Comment $comment
     */
    public function removeComment(\BlogBundle\Entity\Comment $comment)
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
     * @param \BlogBundle\Entity\Category $category
     *
     * @return Post
     */
    public function setCategory(\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add tag
     *
     * @param \BlogBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\BlogBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \BlogBundle\Entity\Tag $tag
     */
    public function removeTag(\BlogBundle\Entity\Tag $tag)
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
    
    public function getTitleSlug()
    {
        return Blog::slugify($this->getTitle());
    }
}
