<?php
namespace Admin\Model;use Think\Model;
class CateModel extends Model {
	protected $trueTableName = 'shop_goods_cate'; 
	public function cateadd($data){
		return $this->add($data);

	} 
	public function cateselect(){
		 $sql="select cat_id,cat_name,path_id,path,CONCAT(path,'_',cat_id) AS depath from shop_goods_cate order by depath ASC";
		     //搜索    分类id  分类名称 父类id 所属父级  创建所在地址                    搜索表            根据    所在地址 做升序排列                                                                     
		 return $this->query($sql);
	}
	public function cateshow(){
		return $this->select();

	}

}
?>
