<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Configurations
    |--------------------------------------------------------------------------
    |
    | Configurações específicas do painel de administração
    |
    */

    //Main Menu
    'menu' => [
        'general.dashboard' => [
            'text' => 'Painel',
            'route' => ['admin.initial'], //You can pass a array of parameters in the position 1
            'icon' => 'fa fa-bar-chart',
            'target' => null,
            'shield' => null, //You can set a shield to hide the menu
        ],
        'cms' => [
            'text' => 'CMS',
            'icon' => 'fa fa-edit',
            'submenu' => [
                'cms.banners' => [
                    'text' => 'Banners',
                    'route' => ['admin.banners.index'],
                    'shield' => 'admin.banners',
                ],
                'cms.contacts' => [
                    'text' => 'Contatos',
                    'route' => ['admin.contacts.index'],
                    'shield' => 'admin.contacts',
                ],
                'cms.pages' => [
                    'text' => 'Páginas',
                    'route' => ['admin.pages.index'],
                    'shield' => 'admin.pages',
                ]
            ]
        ],
        'acl' => [
            'text' => 'Usuários',
            'icon' => 'fa fa-users',
            'submenu' => [
                'users.users' => [
                    'text' => 'Usuários',
                    'route' => ['admin.users.index'],
                    'shield' => 'admin.users',
                ],
                'acl' => [
                    'text' => 'Controle de Acesso',
                    'shield' => 'admin.user_roles',
                    'submenu' => [
                        'users.user_roles' => [
                            'text' => 'Funções de Usuário',
                            'route' => ['admin.user_roles.index'],
                        ],
                        'users.user_role_permissions' => [
                            'text' => 'Permissões',
                            'route' => ['admin.user_role_permissions.index'],
                        ],
                    ]
                ],
            ]
        ],
        'configurations' => [
            'text' => 'Configurações',
            'icon' => 'fa fa-gears',
            'submenu' => [
                'cms.contactRecipients' => [
                    'text' => 'Destinatários de Contato',
                    'route' => ['admin.contactRecipients.index'],
                    'shield' => 'admin.contact.recipients',
                ],
                'configurations' => [
                    'text' => 'Configurações Avançadas',
                    'submenu' => [
                        'cms.bannerPlaces' => [
                            'text' => 'Locais de Banners',
                            'route' => ['admin.bannerPlaces.index'],
                            'shield' => 'admin.banners.places',
                        ],
                        'general.cacheControl' => [
                            'text' => 'Cache',
                            'route' => ['admin.utils.cacheControl'],
                            'shield' => 'admin.general.settings',
                        ],
                    ]
                ],
            ]
        ],
    ],

    //Admin URL
    'url' => env('ADMIN_URL', ''),

    //Developer Information
    'developer' => [
        'logo' => '/images/panel/logo-nueva.png',
        'title' => 'Desenvolvido por Agência Nueva',
        'url' => 'http://www.agencianueva.com.br'
    ],

    //Contractor Information
    'contractor' => [
        'logo' => '/images/panel/logo-cliente.png',
        'name' => 'Uni Plásticos'
    ],
];