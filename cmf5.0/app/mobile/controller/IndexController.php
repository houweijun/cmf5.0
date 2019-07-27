<?php
namespace app\mobile\controller;
use cmf\controller\HomeBaseController;
class IndexController extends HomeBaseController{


  public function index(){


     //解析手机模板
    return $this->fetch("index/index");
  }

public function one(){
    //解析手机模板
    return $this->fetch("index/one");

}
//解析文章首页
public function two(){
    //解析手机模板
    return $this->fetch("article/index");

}


}



?>