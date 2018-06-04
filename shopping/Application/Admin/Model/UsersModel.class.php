<?php
namespace Admin\Model;use Think\Model;
class UsersModel extends Model {
	protected $trueTableName = 'shop_user'; 
	public function userselect(){
		return $this->select();
	} 
   public function suerdele($da){
		return $this->where($da)->delete();
	}

}
?>