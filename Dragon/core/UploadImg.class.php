<?php
class UploadImg{
	protected $img;
	protected $type;
	public $path;
	public function __construct(){
		header("content-type:text/html;charset=utf8");
		if(isset($_POST['btn'])){
			$this->img=$_FILES['upfile'];
		}
		$this->imgHandle();
		$this->fileAndName();
		$this->saveImg();
	}
	//处理图片类型
	public function imgHandle(){
		$this->type=substr($this->img['type'],6);
		$size=$this->img['size'];
		$typeArr=['gif','jpeg','png'];
		if(!in_array($this->type,$typeArr)){
			echo "<script>alert('不符合格式');window.history.go(-1);</script>";exit;
		}
		if($size>200*1000){
			echo "<script>alert('只能上传200k以内的图片');window.history.go(-1);</script>";exit;
		}
		
	}
	public function fileAndName(){
		$this->path='./img/'.date('Ymd');
		if(!is_dir($this->path)){
			mkdir($this->path);
		}
		$this->path.='/'.substr(md5(time()),0,8).'.'.$this->type;
	}
	public function saveImg(){

		if(is_uploaded_file($this->img['tmp_name'])){
				if(move_uploaded_file($this->img['tmp_name'],$this->path)){
					echo "<script>alert('上传成功');window.history.go(-1);</script>";
				}else{
					echo "<script>alert('上传失败');window.history.go(-1);</script>";
				}
		}
	}//saveImg()
		
}//类结束

