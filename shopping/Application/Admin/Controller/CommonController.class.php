<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function __Construct(){
		parent::__Construct();
		$session = session("admin");
		if(empty($session)){
			$this->error("非法登录",U('Login/login'));
    		exit;

		}
	}
}

		

	
