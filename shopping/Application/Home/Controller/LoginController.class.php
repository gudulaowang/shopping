<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function register(){
    	if(IS_GET){
    		$this->display();
    	}
    	if(IS_POST){
    		$res['user_name']=I("post.user_name");
    		$res['user_pwd']=I('post.user_pwd');
    	    $res['user_time']=time();
    		if(D("user")->add($res)){
    			$data['error'] = 0;
                $data['msg']='注册成功';

    		}else{
    			$data['error'] = 1;
                $data['msg']='注册失败';

    		}
    		echo json_encode($data);


    	}

    }
    public function login(){
        if(IS_POST){
            $map['user_pwd']=I("post.user_pwd");
            $map['user_name']=I("post.user_name");
            $res=M("user")->where($map)->find();
            $user=array("user_id"=>$res['user_id'],"user_name"=>$res['user_name']);
            if($res){
                session("user",$user);
                $data['error']=0;
                $data['msg']="登录成功";
                
            }else{
                $data['error']=1;
                $data['msg']="登录失败密码或账户错误";

            }
            echo json_encode($data);

        }else{
            $this->display();
        }
    }

    public function code(){
        //gd库未开
        //验证码前面有输出
        ob_clean();
        $Verify =     new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length   = 4;
        $Verify->useNoise = true;
        $Verify->entry();
    }
    //验证验证码
    function check_code($code, $id = ''){
        $verify = new \Think\Verify();    
        return $verify->check($code, $id);
    }
 
    public function login_do(){
        session("user",null);
        cookie("user",null);
        $this->success("退出成功",U("Login/login"));
    }

}