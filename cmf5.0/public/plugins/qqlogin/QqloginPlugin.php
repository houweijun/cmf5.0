<?php
// +----------------------------------------------------------------------
// | QQLogin [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2018 Tangchao All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tangchao <admin@ytecn.com>
// +----------------------------------------------------------------------
namespace plugins\qqlogin;
use cmf\lib\Plugin;

class QqloginPlugin extends Plugin
{

    public $info = array(
        'name'        => 'Qqlogin',
        'title'       => 'QQ登录',
        'description' => 'QQ登录',
        'status'      => 1,
        'author'      => 'Tangchao',
        'version'     => '1.2',
        'demo_url'    => 'https://www.ytecn.com',
        'author_url'  => 'https://www.ytecn.com'
    );

    public $hasAdmin = 0;

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    public function footerStart($param)
    {
        return true;
    }

}