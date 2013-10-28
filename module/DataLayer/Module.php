<?php

namespace DataLayer;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array();
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'dl.ingredient_service' => function ($sm) {
                    $em = $sm->get('doctrine.entitymanager.orm_default');
                    $service = new Service\IngredientServiceDoctrineImpl();
                    $service->setRepository($em->getRepository('DataLayer\Entity\Ingredient'));
                    $service->setEntityManager($em);
                    return $service;
                },
                'dl.user_service' => function ($sm) {
                    $service = new Service\UserServiceDoctrineImpl();
                    $em = $sm->get('doctrine.entitymanager.orm_default');
                    $service->setRepository($em->getRepository('DataLayer\Entity\User'));
                    $service->setEntityManager($em);
                    $service->setSaltProvider($sm->get('dl.salt_provider'));
                    $service->setHashService($sm->get('dl.hash_service'));
                    return $service;
                },
                'Zend\Authentication\AuthenticationService' => function($serviceManager) {
                    return $serviceManager->get('doctrine.authenticationservice.orm_default');
                },
                'dl.salt_provider' => function ($sm) {
                    return new Service\BasicSaltProviderService();
                },
                'dl.hash_service' => function ($sm) {
                    return new \Zend\Crypt\Password\Bcrypt();
                } 
            ),
        );
    }

}
