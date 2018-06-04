<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login(){
        if(IS_POST){
            $map['admin_pwd']=I("post.admin_pwd");
            $map['admin_name']=I("post.admin_name");
            $code=I("post.code");
            $res=D("User")->finduser($map);
            $aa['admin_id']=$res['admin_id'];
            $aa['admin_name']=$res['admin_name'];
            if($res){

                if($this->check_code($code)){ 
                     $data['error']=0;
                     session("admin",$aa);
                     // print_r($_SESSION["admin"]);
                     $data['msg']="登录成功";   
                    
                }else{
                      $data['error']=2;
                      $data['msg']="验证码错误";     
                }
                     
                }else{
                    $data['error']=1;
                    $data['msg']="登录失败密码或账户错误";
            }
            echo json_encode($data);


        }else{
            $this->display();
        }
    }
    public function register(){
    	if(IS_POST){
    		$res['admin_name']=I("post.admin_name");
            $res['admin_pwd']=I('post.admin_pwd');
            // print_r($res);
            if(D("user_admin")->add($res)){
                $data['error'] = 0;
                $data['msg']='注册成功';
            }else{
                $data['error'] = 1;
                $data['msg']='注册失败';
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
        session("admin",null);
        cookie("admin",null);
        $this->success("退出成功",U("Login/login"));
    }

 
}

?>