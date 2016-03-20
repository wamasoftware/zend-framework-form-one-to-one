<?php
namespace Album\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

   
    /**
     * @ORM\OneToMany(targetEntity="Album\Entity\Image", mappedBy="product", cascade={"persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="product_id", onDelete="SET NULL")
     */
    
    protected $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }



    /**
     * Add images
     *
     * @param Collection $images
     */
    public function addImages($images)
    {
        foreach ($images as $image)
        {          
            $this->images->add($image);
        }
    }

    /**
     * Remove images
     *
     * @param \Album\Entity\Image $images
     */
    public function removeImages($images)
    {
        foreach ($images as $image)
        {
          $this->images->removeElement($image);
        }
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

}