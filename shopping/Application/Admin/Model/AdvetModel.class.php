<?php
namespace Admin\Model;use Think\Model;
class AdvetModel extends Model {
	protected $trueTableName = 'shop_advet'; 
	public function findadvet($data){
		return $this->where($data)->find();
	}
	public function advetup($res){
      return $this->save($res);
	}

     


	

}
?>