<?php

namespace DataLayer;

use Zend\Authentication\AuthenticationService;
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
                    $service->setPasswordService($sm->get('dl.password_service'));
                    return $service;
                },
                'dl.auth_adapter' => function ($sm) {
                    $service = new Authentication\Adapter();
                    $service->setUserService($sm->get('dl.user_service'));
                    return $service;
                },
                'dl.auth_service' => function ($sm) {
                    $service = new AuthenticationService();
                    $service->setAdapter($sm->get('dl.auth_adapter'));
                    return $service;
                },
                'dl.salt_provider' => function ($sm) {
                    return new Service\BasicSaltProviderService();
                },
                'dl.password_service' => function ($sm) {
                    return new \Zend\Crypt\Password\Bcrypt();
                } 
            ),
        );
    }

}
