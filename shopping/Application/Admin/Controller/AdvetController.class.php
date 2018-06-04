<?php
namespace Admin\Controller;
use Think\Controller;
class AdvetController extends CommonController {
	public function advet_show(){
		$res=M('advet')->select();
    $this->assign("res",$res);
		$this->display();
	}
  public function advet_add(){
    	if(IS_POST){
    		$date=I("POST.");
        $date['image']=$_FILES['image'];
        $face=$date['image'];
        $th=$this->upload($face);
        $date['image']=$th;
    		$res=M("advet")->add($date);
    		if($res){		
    			$this->success("添加成功",U('Advet/advet_show'));
    		}else{
    			$this->error("添加失败");
    		}

    	}else{

			$this->display();
    	}
    }
	public function advet_up(){
		if(IS_GET){
			$id=I("get.advet_id");
            // print_r($id);
			$res=D('Advet')->findadvet($id);
			$this->assign("res",$res);
			$this->display();
		}
			
		
	}
    public function advet_up_do(){
        if(IS_POST){
            $res=I("POST.");
            $res['image']=$_FILES['image'];
            $face=$res['image'];
            $th=$this->upload($face);
            $res['image']=$th;
            $res=D("Advet")->advetup($res);
            if($res){
                $this->success("修改成功",U('Advet/advet_show'));
            }else{
                $this->error("修改失败");
            }
        }
    }
    public function advet_del(){
            $id=I("get.id");
            $res=D("advet")->where("advet_id='$id'")->delete();
            if($res){
                $this->success("删除成功",U('Advet/advet_show'));
            }else{
                $this->error("删除失败");
            }
       


        
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