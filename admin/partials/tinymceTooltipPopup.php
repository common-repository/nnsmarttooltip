<?php

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_5be945fe0b28d',
        'title' => 'Smart Tooltip',
        'fields' => [
            [
                'key' => 'field_5bf6d0382c650',
                'label' => '',
                'name' => 'nn_simple_tooltip-popup',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 1,
                'delay' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ],
            ],
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ]);
}
