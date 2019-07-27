<?php
// +----------------------------------------------------------------------
// | YtecnSitemap [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 Tangchao All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tangchao <admin@ytecn.com>
// +----------------------------------------------------------------------
namespace plugins\ytecn_sitemap;
use cmf\lib\Plugin;

class YtecnSitemapPlugin extends Plugin
{

    public $info = [
        'name'        => 'YtecnSitemap',
        'title'       => '生成XML地图',
        'description' => '生成XML地图',
        'status'      => 1,
        'author'      => '唐朝',
        'version'     => '1.0',
        'demo_url'    => 'https://qq.ytecn.com',
        'author_url'  => 'https://www.ytecn.com'
    ];

    public $hasAdmin = 1;

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

}