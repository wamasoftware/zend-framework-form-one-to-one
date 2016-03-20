<?php

namespace Album\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class ProductForm extends Form {

    public function __construct(ObjectManager $objectManager, $name) {
        parent::__construct($name);

        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($objectManager, 'Album\Entity\Product'));

        $imageFieldset = new ImageFieldset($objectManager);
        $imageFieldset->setName("images");
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'images',
            'options' => array(
                'allow_add' => true,
                'allow_remove' => false,
                'count' => 2,
                'target_element' => $imageFieldset,
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton'
            )
        ));

        $this->setValidationGroup(array(
            'images',
        ));
    }

}
