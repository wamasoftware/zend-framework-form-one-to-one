<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Album\Model\Profile,
    Album\Form\ProfileForm; 
use Zend\Validator\File\Size;

class ProfileController extends AbstractActionController {

    public function addAction() {
        $form = new ProfileForm();
        $request = $this->getRequest();
        if ($request->isPost()) {

            $profile = new Profile();
            $form->setInputFilter($profile->getInputFilter());

            $nonFile = $request->getPost()->toArray();
            $File = $this->params()->fromFiles('fileupload');
            echo '<pre>';   print_r($File);      exit("123");
            $data = array_merge(
                    $nonFile, array('fileupload' => $File['name'])
            );
            //set data post and file ...   
            $form->setData($data);

            if ($form->isValid()) {

                $size = new Size(array('min' => 100000)); //minimum bytes filesize

                $adapter = new \Zend\File\Transfer\Adapter\Http();
                $adapter->setValidators(array($size), $File['name']);
                if (!$adapter->isValid()) {
                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach ($dataError as $key => $row) {
                        $error[] = $row;
                    }
                    $form->setMessages(array('fileupload' => $error));
                } else {
                   
                    $adapter->setDestination(dirname(__DIR__) . '/assets');
                    if ($adapter->receive($File['name'])) {
                        $profile->exchangeArray($form->getData());
                        echo 'Profile Name ' . $profile->profilename . ' upload ' . $profile->fileupload;
                    }
                }
            }
        }
        return array('form' => $form);
    }
}
