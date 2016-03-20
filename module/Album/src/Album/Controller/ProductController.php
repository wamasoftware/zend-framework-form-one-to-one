<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Album\Entity\Image;
use Album\Entity\Product;
use Album\Form\ProductForm;

class ProductController extends AbstractActionController {

    protected $em;

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
    
    public function addAction() {
        $em = $this->getEntityManager();
        $request = $this->getRequest();
        $form = new ProductForm($em, 'product');
        $product = new Product();
        $form->bind($product);
        if ($request->isPost()):
        $dataForm = array_merge($request->getPost()->toArray(), $request->getFiles()->toArray()); 
       
        $form->setData($dataForm);          
        if ($form->isValid()):
            $em->persist($product);   // echo '<pre>';   print_r($dataForm);   exit("123");            
            $em->flush();
        endif;
        endif;
        return array('form' => $form);
    }

}
