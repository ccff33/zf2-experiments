<?php

namespace App;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array();
    }
    
    public function getServiceConfiguration() {
        return array();
    }

}
