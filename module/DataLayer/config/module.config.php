<?php

namespace DataLayer;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'DataLayer\Entity\User',
                'identity_property' => 'username',
                'credential_property' => 'password',
                // ugly and hardcodded
                // need a way to to use service manager here
            '   credential_callable' => function ($user, $password) {
                    $bcrypt = new Bcrypt();
                    $bcrypt->setSalt($user->getSalt());
                    return $bcrypt->verify($password, $user->getPassword());
                }
            ),
        ),
    ),
);