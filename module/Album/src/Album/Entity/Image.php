<?php
namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Image
{
    /**
   
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $filename;


    /**
     * @ORM\ManyToOne(targetEntity="Album\Entity\Product", inversedBy="images", cascade={"persist"}))
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
   
    protected $product;
    
    /**
     * Get the id

     * @return int
     */
    public function getId() {
        return $this->id;
    }


    public function getFileName()
    {
        return $this->filename;
    }


    public function setFileName($filename)
    {

         if (is_array($filename) && isset($filename['name'])) {
                $filename = $filename['name'];
            }            
            $this->filename = $filename;
    }
    
    /**
     * Allow null to remove association
     *
     * @param Product $product
     */

    public function setProduct(Product $product = null)
    {
       
        $this->product = $product;
        
    }

    /**
     * @return Product
     */

    public function getProduct()
    {
        return $this->product;
    }
}