<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public function goods_show(){
    	if(IS_GET){
    		$data['goods_id']=I("get.goods_id");
    		$res=D("Goods")->findgoods($data);
    		 // print_r($res);
    		$this->assign("res",$res);
    		$this->display();
    	}
    	
}
    public function goods_list(){
    	$res=D("Goods")->selects();
    	$this->assign("res",$res); 	
    	$this->display();
    }



}