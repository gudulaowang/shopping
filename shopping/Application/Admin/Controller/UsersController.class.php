<?php
namespace Admin\Controller;
use Think\Controller;
class UsersController extends CommonController {
	public function users_show(){
		$res=D('Users')->userselect();
        $this->assign("res",$res);
		$this->display();
	}
	public function users_del(){
        $da['user_id']=I("get.user_id");
        if(D("Users")->suerdele($da)){
            $this->success("删除成功",U("Users/users_show"));
        }else {
            $thiss->error("删除失败");
        }
	

}
}
?>