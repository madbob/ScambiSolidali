<?php

return [
    /*
        Overwrite this to use a custom prefix for Blade's components in your
        template. For example, defining it as "ls" you can include any component
        as in <x-ls::input />
    */
    'prefix' => 'larastrap',

    /*
        Lower level of configuration: those parameters are applied to all
        elements, and overwritten by the below array "elements" or by inline
        attributes (that have precedence on every other)
    */
    'commons' => [
        'label_width' => '2',
        'input_width' => '10',
    ],

    /*
        Configuration for specific elements: feel free to overwrite them as
        preferred.
        Many of them are already defined as defaults within the specific
        elements and provided here just for convenience
    */
    'elements' => [
        'navbar' => [
            'color' => 'light',
        ],

        'modal' => [
            'buttons' => [],
        ],

        'form' => [
            'formview' => 'vertical',
            'method' => 'POST',

            'buttons' => [
                ['element' => 'larastrap::sbtn', 'label' => 'Salva', 'attributes' => ['type' => 'submit']]
            ]
        ],

        'field' => [
            'margins' => [0, 0, 3, 0],
        ],

        'radios' => [
            'color' => 'outline-primary',
        ],

        'textarea' => [
            'attributes' => ['rows' => 5],
        ],

        'checks' => [
            'color' => 'outline-primary',
        ],

        'tabs' => [
            'tabview' => 'tabs',
        ],

        'tabpane' => [
            'classes' => ['p-3']
        ]
    ],

    'customs' => [
        'sbtn' => [
            'extends' => 'button',
            'params' => [
                'override_classes' => ['button'],
                'reviewCallback' => function($el, $params) {
                    $params['label'] = sprintf('<span>%s</span>', $params['label']);
                    return $params;
                }
            ],
        ],
    ],
];
