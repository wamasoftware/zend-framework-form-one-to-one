<?php

namespace Album\Form;

use Album\Entity\Product;
use Album\Entity\Image;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ImageFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('product-image');

        $this->setHydrator(new DoctrineHydrator($objectManager, 'Album\Entity\Image'))
                ->setObject(new Image());
        $this->add(array(
            'name' => 'filename',
            'type' => 'Zend\Form\Element\File',
            'options' => array(
                'label' => 'Photo Upload',
                'label_attributes' => array(
                    'class' => 'form-label'
                    ),
                'multiple' => true,
                'id' => 'filename',
                )
            )
        );        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
            'options' => array(
                'label' => 'Hidden Id :'),
        ));

    }

    public function getInputFilterSpecification() {
        return array(
            'id' => array(
                'required' => false
            ),
            'filename' => array(
                'required' => true
            )
        );
    }

}
