<?php

class IndexController{
	
	public function index(){
		$html=$this->view->display('login.html','3600');
		echo $html;
	}
	
	public function code(){
		session_start();
		Loader::import('core/Vercode');
		$img=new Vercode();
		$code=$img->code();
		$_SESSION['code']=$code;
	}
	public function check(){
		session_start();
		if(strtolower($_POST['code'])!=strtolower($_SESSION['code'])){
			echo "<script>alert('验证码错误');window.history.back();</script>";	
		}
		$where=array(
			'manager'	=> 	$_POST['manager'],
			'pwd'		=>	$_POST['pwd']
		);
		$row=$this->db->get('manager','',$where);
		if($row==NULL){
			echo "<script>alert('登录失败');window.history.back();</script>";
		}
	}
}
