<?php

namespace BlogAdminBundle\Entity;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $author_email;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $content;

    /**
     * @var boolean
     */
    private $is_approved = true;

    /**
     * @var \DateTime
     */
    private $published_at;

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
     * Set username
     *
     * @param string $username
     *
     * @return Comment
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set authorEmail
     *
     * @param string $authorEmail
     *
     * @return Comment
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
     * Set website
     *
     * @param string $website
     *
     * @return Comment
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
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
     * Set isApproved
     *
     * @param boolean $isApproved
     *
     * @return Comment
     */
    public function setIsApproved($isApproved)
    {
        $this->is_approved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return boolean
     */
    public function getIsApproved()
    {
        return $this->is_approved;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Comment
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
     * Set post
     *
     * @param \BlogAdminBundle\Entity\Post $post
     *
     * @return Comment
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
}
