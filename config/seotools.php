<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'       => "Loucos por Festa", // set false to total remove
            'description' => '',
            'separator'   => ' | ',
            'keywords'    => ['fotos', 'fotografia', 'festa', 'balada', 'formatura'],
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null
        ]
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Loucos por Festa', // set false to total remove
            'description' => '', // set false to total remove
            'url'         => false,
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ]
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ]
    ]
];
