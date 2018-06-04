<?php
namespace Admin\Controller;
use Think\Controller;
class GdcateController extends CommonController {
	public function gd_add(){
		if(IS_POST){
			$data=I("post.");
			$data['path']=$data['path']."_".$data['path_id'];
		    // print_r($data);die;
			$res=D("Cate")->cateadd($data);
			if($res){
				$this->success("添加成功",U('Gdcate/gd_show'));
			}else{
				$this->error("添加失败",U("Gdcate/gd_add"));
			}

		}else{
			$res=D("Cate")->cateselect();
			// print_r($res);
			$this->assign("res",$res);
			$this->display();
		}
	}
	public function gd_show(){
		
			$res=M("goods_cate")->select();
			// print_r($res);
			$this->assign("res",$res);
			$this->display();
			
		
	}
	public function gd_up(){
		$this->display();
	}
	public function gd_del(){
		
	}

}