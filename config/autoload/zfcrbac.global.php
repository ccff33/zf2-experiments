<?php
return array(
    'zfcrbac' => array(
        'anonymousRole' => 'guest',
        'firewallController' => true,
        'firewallRoute' => false,
        'firewalls' => array(
            'ZfcRbac\Firewall\Controller' => array(
                array('controller' => 'App\Controller\Home', 'actions' => 'add', 'roles' => 'administrator'),
                array('controller' => 'App\Controller\Home', 'actions' => 'index', 'roles' => 'guest')
            ),
//            'ZfcRbac\Firewall\Route' => array(
//                array('route' => 'profiles/add', 'roles' => 'member'),
//                array('route' => '/', 'roles' => 'administrator')
//            ),
        ),
        'providers' => array(
            'ZfcRbac\Provider\AdjacencyList\Role\DoctrineDbal' => array(
                'connection' => 'doctrine.connection.orm_default',
                'options' => array(
                    'table'         => 'roles',
                    'id_column'     => 'id',
                    'name_column'   => 'name',
                    'join_column'   => 'parent_id'
                )
            ),
            'ZfcRbac\Provider\Generic\Permission\DoctrineDbal' => array(
                'connection' => 'doctrine.connection.orm_default',
                'options' => array(
                    'permission_table'      => 'permissions',
                    'role_table'            => 'roles',
                    'role_join_table'       => 'roles_permissions',
                    'permission_id_column'  => 'id',
                    'permission_join_column'=> 'perm_id',
                    'role_id_column'        => 'id',
                    'role_join_column'      => 'role_id',
                    'permission_name_column'=> 'name',
                    'role_name_column'      => 'name'
                )
            ),
        ),
        'identity_provider' => 'standard_identity'
    ),
    'service_manager' => array(
        'factories' => array(
            'standard_identity' => function ($sm) {
                $roles = array('guest');
                $identity = new \ZfcRbac\Identity\StandardIdentity($roles);
                return $identity;
            },
        )
    ),
);