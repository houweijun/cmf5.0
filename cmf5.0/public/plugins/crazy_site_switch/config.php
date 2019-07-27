<?php

use plugins\crazy_site_switch\CrazySiteSwitchPlugin;

return [
    'status' => [
        'title'   => '网站当前状态',
        'type'    => 'radio',
        'options' => [
            CrazySiteSwitchPlugin::ON  => '开启',
            CrazySiteSwitchPlugin::OFF => '关闭',
        ],
        'value'   => CrazySiteSwitchPlugin::ON,
        'tip'     => '请选择网站状态',
    ]
];