<?php

namespace Album\Form;

use Album\Entity\BlogPost;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;



class BlogPostFieldset extends Fieldset implements InputFilterProviderInterface {

    public function __construct(ObjectManager $objectManager) {
        parent::__construct('blog-post');

        $this->setHydrator(new DoctrineHydrator($objectManager))
                ->setObject(new BlogPost());

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'title',
            'options' => array(
                 'label' => 'Title')
        ));

        $tagFieldset = new TagFieldset($objectManager);
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'tags',
            'options' => array(
                'count' => 1,
                'target_element' => $tagFieldset
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'title' => array(
                'required' => true
            ),
        );
    }

}
