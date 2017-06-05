<?php
header("content-type:text/html;charset=utf-8");
class Dragon{
	public function __construct(){
	}
	
	public static function start(){
		$arr=$_SERVER["REQUEST_URI"];
		$temp_arr=explode('?',$arr);
		$url_arr=$temp_arr[0];//切割不要参数
		$tempurl_arg=explode('/',$url_arr);
		
		$urlArr=array();
		foreach($tempurl_arg as $val){
			if($val!=''&&$val!='index.php'){//只要控制器名和方法名foreach
				$urlArr[]=$val;
			}
		}
		
		$len=count($urlArr);
		$method="index";
		if($len==0){
			$dir=DR_ACTIONPATH."Index";
			$Action='Index';				
		}else if($len==1){
			$dir=DR_ACTIONPATH.ucfirst($urlArr[0]);
			$Action=ucfirst($urlArr[0]);
		}else{
			$method=$urlArr[$len-1];
			$Action=ucfirst($urlArr[$len-2]);
			$tmp_urlArr=$urlArr;
			unset($tmp_urlArr[$len-1]);
			$tmp_dir=array();
			foreach($tmp_urlArr as $val){
				$tmp_dir[]=ucfirst($val);
			}
			$dir=DR_ACTIONPATH.implode('/',$tmp_dir);	
		}
		$ActionName=$Action.'Controller.class.php';
		$ActionClass=$Action.'Controller';
		$path=$dir.'/'.$ActionName;
		if(!is_dir($dir)){
			die ("没有{$dir}目录");
		}
		if(!is_file($path)){
			die("没有{$path}这个控制器");
		}
		require_once $path;
		$obj = new $ActionClass();
		if(!method_exists($obj,$method)){
			die("{$path}没有{$method}方法");
		}
		require_once 'Loader.class.php';
		Loader::import('core/Mysql/Dbfactory');
		Loader::import('View');
		$view = new View();
		$view->dir=$Action;//文件夹名称
		$obj->view=$view;
		$obj->db=Dbfactory::create('Mysql');
		$obj->$method();
		
	}
}
?>
