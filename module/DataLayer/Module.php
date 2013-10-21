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
                'dl.ingredient_repository' => function ($sm) {
        	       $em = $sm->get('doctrine.entitymanager.orm_default');
        	       $repository = $em->getRepository('DataLayer\Entity\Ingredient');
        	       return $repository;
                },
                'dl.ingredient_service' => function ($sm) {
        	       $service = new Service\IngredientServiceDoctrineImpl();
        	       $service->setRepository($sm->get('dl.ingredient_repository'));
        	       $service->setEntityManager($sm->get('doctrine.entitymanager.orm_default'));
        	       return $service;
                }
            )
        );
    }

}
