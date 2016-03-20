<?php
namespace Album\Form;
 
use Album\Entity\Album;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface; 
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

 
 
class AlbumFieldset extends Fieldset implements InputFilterProviderInterface
{
  public function __construct()
  {
    parent::__construct('album');
 
    $em = Registry::get('entityManager');
 
    $this->setHydrator(new DoctrineEntity($em))
         ->setObject(new Album());
 
    $this->setLabel('Album');
 
    $this->add(array(
      'name' => 'id',
      'attributes' => array(
        'type' => 'hidden'
      )
    ));
 
    $this->add(array(
      'name' => 'title',
      'options' => array(
        'label' => 'Title for this Album'
      ),
      'attributes' => array(
        'type' => 'text'
      )
    ));
 
    $this->add(array(
      'name' => 'text',
      'options' => array(
        'label' => 'Text-Content for this album'
      ),
      'attributes' => array(
        'type' => 'textarea'
      )
    ));
  }
 
  /**
   * Define InputFilterSpecifications
   *
   * @access public
   * @return array
   */
  public function getInputFilterSpecification()
  {
    return array(
      'title' => array(
        'required' => true,
        'filters' => array(
          array('name' => 'StringTrim'),
          array('name' => 'StripTags')
        ),
        'properties' => array(
          'required' => true
        )
      ),
      'text' => array(
        'required' => true,
        'filters' => array(
          array('name' => 'StringTrim'),
          array('name' => 'StripTags')
        ),
        'properties' => array(
          'required' => true
        )
      )
    );
  }
}