<?php
namespace Album\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
/**
* Entity Class representing a Album of our Zend Framework 2 Application
*
* @ORM\Entity
* @ORM\Table(name="album")
* @property int $id
* @property string $artist
* @property string $title
*/
class Album
{
  /**
   * Primary Identifier
   *
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   * @var integer
   * @access protected
   */
  protected $id;
 
  /**
   * Title of our Blog Album
   *
   * @ORM\Column(type="string")
   * @var string
   * @access protected
   */
  protected $artist;
 
  /**
   * Textual content of our Blog Album
   *
   * @ORM\Column(type="string")
   * @var string
   * @access protected
   */
  protected $title;
 
  /**
   * Sets the Identifier
   *
   * @param int $id
   * @access public
   * @return Album
   */
  public function setId($id)
  {
    $this->id = $id;
    return $this;
  }
 
  /**
   * Returns the Identifier
   *
   * @access public
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }
 
  /**
   * Sets the Title
   *
   * @param string $artist
   * @access public
   * @return Album
   */
  public function setArtist($artist)
  {
    $this->artist = $artist;
    return $this;
  }
 
  /**
   * Returns the Title
   *
   * @access public
   * @return string
   */
  public function getArtist()
  {
    return $this->artist;
  }
 
  /**
   * Sets the Text Content
   *
   * @param string $title
   * @access public
   * @return Album
   */
  public function setTitle($title)
  {
    $this->title = $title;
    return $this;
  }
 
  /**
   * Returns the Text Content
   *
   * @access public
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }
}