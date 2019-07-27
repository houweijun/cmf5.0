<?php
/**
 * 网站开关插件
 *
 * Author：惠达浪
 * Email： crazys@126.com
 * Date：  2019/05/23
 */

namespace plugins\crazy_site_switch;

use cmf\lib\Plugin;

class CrazySiteSwitchPlugin extends Plugin
{
    const ON = 'on';
    const OFF = 'off';

    public $info = [
        'name'        => 'CrazySiteSwitch',
        'title'       => '网站开关插件',
        'description' => '关闭/开启网站',
        'status'      => 1,
        'author'      => '惠达浪',
        'version'     => '1.0.0',
        'demo_url'    => 'https://www.crazys.pub',
        'author_url'  => 'https://www.qdcrazy.cc'
    ];
    public $hasAdmin = 0;

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    public function homeInit()
    {
        $config = $this->getConfig();
        if ($config['status'] === self::OFF) {
            exit($this->fetch('tips'));
        }
    }
}