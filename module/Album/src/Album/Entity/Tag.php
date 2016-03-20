<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Tag {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    
     /**
     * @var Album\Entity\BlogPost
     * @ORM\OneToOne(targetEntity="Album\Entity\BlogPost", mappedBy="tags",orphanRemoval=true,cascade={"all"})
     */
    protected $blogPost;

    /**
     * Get the id

     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Allow null to remove association
     *
     * @param BlogPost $blogPost
     */
    public function setBlogPost(BlogPost $blogPost = null) {
        $this->blogPost = $blogPost;
    }

    /**
     * @return BlogPost
     */
    public function getBlogPost() {
        var_dump($this->blogPost);
        return $this->blogPost;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

}
