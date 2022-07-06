<?php

return [
    'role_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'c,r,u,d'
        ],
        'manager' => [
            'users' => 'c,r,u',
            'profile' => 'r,u'
        ],
        'regular_user' => [
            'profile' => 'r,u'
        ]
    ],
    'user_roles' => [
        'admin' => [
            ['name' => "Admin", "email" => "admin@admin.com", "password" => 'password'],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
