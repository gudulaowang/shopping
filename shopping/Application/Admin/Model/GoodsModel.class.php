<?php
namespace Admin\Model;use Think\Model;
class GoodsModel extends Model {
	public function selects(){
		$sql="Select * from shop_goods inner join shop_goods_cate on shop_goods.cat_id=shop_goods_cate.cat_id ";
		return $this->query($sql);
	}

}
?>