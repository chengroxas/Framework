<?php
/**
 * 加载类
 * 
 **/
class Loader{
	/**
	 * 
	 * 
	 **/
	public static function import($filename,$type=false){
		if($type==false){
			//从框架Dragon目录开始查找
			$filepath=BASEPATH."{$filename}.class.php";
		}else{
			////从lib目录里寻找
			$filepath=DR_LIBPATH."{$filename}.class.php";
		}
		if(!file_exists($filepath)){
			die('类文件不存在');
		}
		require_once $filepath;
	}
	
	public static function config($config){
		//从配置文件目录中寻找
		$configpath=DR_CONFPATH."{$config}.config.php";
		if(!file_exists($configpath)){
			die('配置文件不存在');
		}
		return require_once $configpath;
	}
}
