<?php
namespace app\mobile\controller;
use cmf\controller\AdminBaseController;
class AdminIndexController extends AdminBaseController{

    /**
     * 
     * @adminMenu(
     *     'name'   => '商品管理',
     *     'parent' => 'default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商品管理',
     *     'param'  => ''
     * )
     */
 
public function index(){

	return $this->fetch("index/index");
}

}


?>