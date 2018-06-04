<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	public function user_address(){
		if(IS_POST){
			$data=I("post.");
			$data['user_id'] = $_SESSION['user']['user_id']; // 获取session变量
			$res=M('address')->add($data);
			if($res){
				$this->success("添加成功",U('User/user_address'));
			}else{
				$this->error("添加失败",U('User/user_address'));
			}
		}else{
			$vo=M('address')->select();
			// print_r($vo);
			$this->assign("vo",$vo);
			$this->display();
		}
	}

	public function user_address_del(){
		if(IS_GET){
			$data=I("get.address_id");
			// print_r($data);
			$res=M("address")->delete($data);
			if($res){
				$this->success("删除成功",U('User/user_address'));
			}else{
				$this->error("删除失败",U('User/user_address'));
			}

		}

	}
	public function user_Center(){
		$this->display();
	}
	public function user_Collect(){
		$this->display();
	}
	public function user_info(){
		if(IS_POST){
			$res=I("POST.");
            $res['user_img']=$_FILES['user_img'];
            $face=$res['user_img'];
            $th=$this->upload($face);
            $res['user_img']=$th;
            $res=D('User')->usersave($res);
            if($res){
                $this->success("修改成功",U('User/user_info'));
            }else{
                $this->error("修改失败");
            }

		}else{
			$data['user_id'] = $_SESSION['user']['user_id']; // 获取session变量
				// print_r($data);
			$res=D('User')->findUser($data);
			session("img",$res['user_img']);
			$this->assign("ov",$res);
			$this->display();
		}
	}
	public function user_integral(){
			$user_id=$_SESSION['user']['user_id'];
			$res=D("order")->where($user_id)->select();
			// print_r($res);
			$this->assign("res",$res);
		    $this->display();
	}
	public function user_Password(){
		if(IS_POST){
			$res['user_pwd']=I("post.user_pwd");
		    $res['user_id']=$_SESSION['user']['user_id'];
		    if(D('User')->usersave($res))
		    { 
		    	$data['error'] = 0;
                $data['msg']='更改成功';

		    }else{
		    	$data['error'] = 1;
                $data['msg']='更改失败';
            }
             echo json_encode($data);
            
		}else{
			$this->display();
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
?>