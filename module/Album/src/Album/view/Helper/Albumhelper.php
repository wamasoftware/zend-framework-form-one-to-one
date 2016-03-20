<?php

namespace Album\view\Helper;

use Zend\View\Helper\AbstractHelper;

class Albumhelper extends AbstractHelper {

    public function __invoke($str, $find) {
        if (!is_string($str)) {
            return 'must be string';
        }

        if (strpos($str, $find) === false) {
            return 'not found';
        }

        return 'Yappiieee...,  This Is My First View Helper...!';
    }

}