<?php
namespace Home\Model;use Think\Model;
class UserModel extends Model {
	protected $trueTableName = 'shop_user'; 
	public function findUser($data){
		return $this->where($data)->find();
	} 
	public function usersave($res){
		return $this->save($res);
		
	}



}
?>