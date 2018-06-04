<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends CommonController {
    public function goods_add(){
    	if(IS_POST){
    		$date=I("POST.");
    		$date['add_time']=time();
    		$date['goods_sn']=rand(5,1000000);
            $date['goods_img']=$_FILES['goods_img'];
            $face=$date['goods_img'];
            $th=$this->upload($face);
            $date['goods_img']=$th;
    		$res=D("goods")->add($date);
    		if($res){
    			
    			$this->success("添加成功",U('Goods/goods_show'));
    		}else{
    			$this->error("添加失败"); 			
    		}

    	}else{
    		$res=D("Cate")->cateselect();
			$this->assign("res",$res);
			$this->display();
    	}
    }
    public function goods_show(){
        $res=D("goods")->selects();
        // p($res);
    	$this->assign("res",$res);
    	$this->display();
    	
    }
    public function goods_del(){
        if(IS_GET){
            $date=I("get.");
            if($date['is_delete']==0){
               $date['is_delete']=1;
               if(D('goods')->save($date)){
                $this->success("下架成功");
                }else{
                    $this->error("下架失败");
                }
            }else{
                $date['is_delete']=0;
                if(D('goods')->save($date)){
                    $this->success("上架成功");
                }else{
                    $this->error("上架失败");
                }
            }


        }

    }
    public function del_all(){
        $goods_id=I("post.goods_id");
        $data['goods_id'] = array("in",$goods_id);
        if(D("goods")->where($data)->delete()){
            $map['ms'] = "ok";
        }else{
            $map['ms'] = "no";
        }
        echo json_encode($map);
        

    }
    public function upload($face){
         $upload = new \Think\Upload();// 实例化上传类
         $upload->maxSize   =     3145728 ;// 设置附件上传大小    
         $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
         $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录 
         $upload->rootPath  =     "./";   
         // 上传单个文件     
         $info   =   $upload->uploadOne($face);    
         if(!$info) {
         // 上传错误提示错误信息        
         $this->error($upload->getError());    
         }else{// 上传成功 获取上传文件信息         
            return $face=$info['savepath'].$info['savename'];  

        }
    }
  

}