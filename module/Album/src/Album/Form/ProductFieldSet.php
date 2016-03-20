<?php

namespace Album\Form;

use Album\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class ProductFieldSet extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('product');
        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setObject(new Product());
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            )
        ));

        $imageFieldset = new ImageFieldset($objectManager);
        $imageFieldset->setName("images");
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'images',
            'options' => array(
                'allow_add' => true,
                'allow_remove' => false,
                'count' => 2,
                'target_element' => $imageFieldset
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'images' => array(
                'required' => true,
                'properties' => array(
                    'required' => true)
            )
        );
    }

}
