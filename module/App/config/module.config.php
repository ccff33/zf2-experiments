<?php

namespace App;

return array(
    'router' => array(
        'routes' => array(
            // /app/:controller/:action
            'app' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/app',
                    'defaults' => array(
                        '__NAMESPACE__' => 'App\Controller',
                        'controller'    => 'App\Controller\Home',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
            'Zend\Authentication\AuthenticationService' => 'dl.auth_service'
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'App\Controller\Home' => 'App\Controller\HomeController',
            'App\Controller\Auth' => 'App\Controller\AuthController',
            'App\Controller\User' => 'App\Controller\UserController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'layout' => 'layout/layout',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'zfctwig' => array(
        'extensions' => array(),
    ),
);