<?php
namespace Admin\Model;use Think\Model;
class UserModel extends Model {
	protected $trueTableName = 'shop_user_admin'; 
	public function finduser($da){
		return $this->where($da)->find();
	} 
    public function usersave($da){
		return $this->save($da);
	}
	
   public function suerdele($da){
		return $this->where($da)->delete();
	}


}
?>