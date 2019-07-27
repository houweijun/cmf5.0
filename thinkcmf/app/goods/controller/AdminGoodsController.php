<?php
namespace app\goods\controller;
use cmf\controller\AdminBaseController;
class AdminGoodsController extends AdminBaseController{

  
     
     public function add(){

       return $this->fetch("index/add");
  }

}


?>