<?php
// +----------------------------------------------------------------------
// | Alidayu [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 Tangchao All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tangchao <79300975@qq.com>
// +----------------------------------------------------------------------
namespace plugins\mobile_code_aliyun;
use cmf\lib\Plugin;
use plugins\mobile_code_aliyun\model\PluginMobileCodeAliyunModel;

class MobileCodeAliyunPlugin extends Plugin
{

    public $info = [
        'name'        => 'MobileCodeAliyun',
        'title'       => '阿里云短信接口',
        'description' => '阿里云短信接口',
        'status'      => 1,
        'author'      => 'Tangchao',
        'version'     => '1.0',
        'demo_url'    => 'https://www.shiyong.com',
        'author_url'  => 'http://www.songzhenjiang.cn'
    ];

    public $has_admin = 0;

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    public function sendMobileVerificationCode($param)
    {        
        $mobile        = $param['mobile'];
        $code          = $param['code'];
        $config        = $this->getConfig();
        $expire_minute = intval($config['expire_minute']);
        $expire_minute = empty($expire_minute) ? 30 : $expire_minute;
        $expire_time   = time() + $expire_minute * 60;
        $result        = false;
        $template      = $config['Template'];
        $delete = new PluginMobileCodeAliyunModel();
        $smscontent=array('code'=>strval($code));
        $resp = $delete->Sendsms($template,$mobile,$smscontent);
        $result = [
            'error'     => 0,
            'message' => $resp
        ];
        return $result;
    }
}

