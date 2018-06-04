<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    public function user_add(){
        if(IS_POST){
            $data=I("post.");
            $data['admin_time']=time();
            // print_r($data);
            $res=D("User")->add($data);
            if($res){
                $this->success("添加成功",U('User/user_show'));
            }else{
                $this->error("添加失败");
            }


        }else{
            $this->display();
        }
    }
    public function user_show(){
        $res=D("user_admin")->select();
        // p($res);
        $this->assign("data",$res);
    	$this->display();
    }
    public function user_up(){
        if(IS_GET){
            $data['admin_id']=I("get.admin_id");
             
            $res=D('User')->finduser($data);
            // print_r($res);die;
            $this->assign("ov",$res);
            $this->display();
        }else{
            $da=I("POST.");
            $da['admin_times']=time();
           if(D("User")->usersave($da))
           {
            $this->success("修改成功",U("User/user_show"));
           }else{
            $this->error("修改失败");
           }
        }
    }

    public function user_del(){
        $da['admin_id']=I("get.admin_id");
        if(D("User")->suerdele($da)){
            $this->success("删除成功",U("User/user_show"));
        }else {
            $thiss->error("删除失败");
        }
      
    

    }
 
}

?>