<?php

namespace Album\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class BlogPost {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;    
    
    /**
     * @var \Album\Entity\Tag
     * @ORM\OneToOne(targetEntity="Album\Entity\Tag", inversedBy="blogPost", fetch="EAGER",cascade={"all"})
     *
     */
    protected $tags;
    
//    fetch="EAGER", orphanRemoval=true

    /**
     * Never forget to initialize all your collections !
     */
    public function __construct() {
      //  $this->tags = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param \Album\Entity\Tag $tag
     */
    public function addTag($tag) {
        $this->tags = $tag;
    }

    /**
     * @param $tag
     */
    public function removeTag($tag) {
            $tag->setBlogPost(null);
            $this->tags->removeElement($tag);
    }

    /**
     * @return Collection
     */
    public function getTag() {
        return $this->tags;
    }

   /**
     * @param string $name
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
}
