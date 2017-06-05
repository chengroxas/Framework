<?php
class Test{
	
	private $age="18";
	public $name="xiao";
	protected $sex="nan";
	public static $city;
	public function __construct(){
	}//构造函数
	
	public function write(){
		echo self::$city;
	}
	
	public static function run(){
	}
	
	public function __destruct(){
	}//析构函数
}
$test = new Test();
$test->write();
echo $test->name;
