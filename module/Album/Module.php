<?php

namespace Album;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface,  ViewHelperProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }      
  
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'album_helper' => function($sm) {
                    $helper = new View\Helper\Albumhelper ;
                    return $helper;
                }
            )
        ); 
    }
}
           
    
   /* public function getServiceConfig() {
    return array(
            //default stuff
            'factories' => array(
                'my-album-service' => function($sm) {
                    $service = new \My\Service\Album();
                    $service->setEntityManager($sm->get('doctrine.entitymanager.orm_default'));
                    return $service;
                }
            )
        );
    }*/        

