<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;
use think\Db;
use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    public function index()

    {  
     //获取id为3  首页  所有的幻灯片列表
    	$res = Db::name("slide_item")->where("slide_id",3)->order("id DESC")->limit(4)->select();

    
       $this->assign('res',$res);
        return $this->fetch(':index');
    }

   
}
