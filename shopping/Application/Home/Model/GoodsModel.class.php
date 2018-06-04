<?php
namespace Home\Model;use Think\Model;
class GoodsModel extends Model {
	protected $trueTableName = 'shop_goods'; 
	public function selects(){
		$sql="Select * from shop_goods inner join shop_goods_cate on shop_goods.cat_id=shop_goods_cate.cat_id ";
		return $this->query($sql);
	}
	public function findgoods($da){
		return $this->where($da)->find();
	} 

	public function  cartselect($cart_id){
		$sql="select * from shop_cart where cart_id in($cart_id)";
		return $this->query($sql);
	}
	public function cartdel($cart_id){
		$sql="delete from shop_cart where cart_id in($cart_id)";	
		return $this->execute($sql);
	}

}
?>