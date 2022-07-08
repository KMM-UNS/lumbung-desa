<?php

return [
    'role_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'admin' => 'c,r,u,d',
            'profile' => 'c,r,u,d'
        ],
        'admin_gudang' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'user_petani' => [
            'profile' => 'r,u'
        ]
    ],
    'user_roles' => [
        'admin' => [
            ['name' => "Admin", "email" => "admin@gmail.com", "password" => '123456'],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
