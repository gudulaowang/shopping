<?php
	function p($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		exit;
	}
     function up($face){
         $upload = new \Think\Upload();// 实例化上传类
         $upload->maxSize   =     3145728 ;// 设置附件上传大小    
         $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
         $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录 
         $upload->rootPath  =     "./";   
         // 上传单个文件     
         $info   =   $upload->uploadOne($face);    
         if(!$info) {
         // 上传错误提示错误信息        
         $this->error($upload->getError());    
         }else{// 上传成功 获取上传文件信息         
            return $face=$info['savepath'].$info['savename'];  

        }
    } 
?>