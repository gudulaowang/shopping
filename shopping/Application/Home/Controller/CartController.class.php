<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends Controller {
	public function cart_show(){
		if(IS_POST){
			$data=I("post.");
			$id=$data['goods_id'];
		    $res=D("goods")->find($id);
		    $data['user_id']=$_SESSION['user']['user_id'];
		    $data['goods_sn']=$res['goods_sn'];
		    $data['goods_name']=$res['goods_name'];
		    $data['goods_price']=$res['goods_price'];
		    $data['goods_prices']=$res['goods_prices'];
		    $data['goods_img']=$res['goods_img'];
	      // print_r($data);
			$dd=M("cart")->add($data);
		
			if($dd){
				$date['error']=0;
			}else{
				$date['error']=1;
			}
			echo  json_encode($date);
		}else{
			$data['user_id']=$_SESSION['user']['user_id'];
			$aa=D("cart")->where($data)->select();
			 // print_r($aa);
			$this->assign("aa",$aa);
			$this->display();
		}
	}
	public function cart_del(){
		$id=I("get.cart_id");
		if(D("cart")->delete($id)){
			$this->success("",U('Cart/cart_show'));
		}else{
			$this->error("",U('Cart/cart_show'));
		}
		
	}
	public function orders(){
      	$cart_id=$_SESSION['cart']['cart_id'];
      	$user_id=$_SESSION['user']['user_id'];
        $aa=D("Goods")->cartselect($cart_id);
        $price_num=$_SESSION['cart']['price_num'];
	    $state_is=1;
        $re=D("address")->where($user_id,$state_is)->find();
        $this->assign("aa",$aa);
        
        $this->assign("res",$re);
        $this->display();
	
		
      }
      public function show(){
      	    if(IS_POST){
	     	$cart['cart_id']=I("post.id");
	     	$cart['price_num']=I("post.price_num");

	     	// print_r($cart);
	     	session("cart",$cart);
            // print_r($_SESSION['cart']);
            $data['error']=0;
            $data['msg']="ok";
           die(json_encode($data));
           }

      }
      public function orders_do(){
      	$data=I("post.");
      	print_r($data);die;
      	$data['user_id']=$_SESSION['user']['user_id'];
      	$data['order_no']=rand(1,1000000);
      	// print_r($data);die;
      	$cart_id=$_SESSION['cart']['cart_id'];
      	
      	if(D('order')->add($data)){
      		D("Goods")->cartdel($cart_id);
      		$this-> success("订单提交成功",U("User/user_integral"));

      		  
      	}else{
      		$this->error("订单提交失败");



      	}

      

      }

	
}