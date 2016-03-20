<?php

namespace Album\Controller\Plugin;

// namespace Empirio\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class MyFirstPlugin extends AbstractPlugin {

    public function doSomething() {
        echo 'Yappiieee..., This Is My First Pluginn...!';        
    }

}
